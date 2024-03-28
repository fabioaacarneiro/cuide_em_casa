<?php

namespace App\Database;

use Exception;
use PDO;
use PDOException;
use PDOStatement;

/**
 * this class implements methods that manipulate tables on
 * database
 */
class DB
{
    private string $table;

    private array $columns;

    private PDOStatement $statement;

    private PDO $pdo;

    private function __construct(string $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * starts create a table
     *
     * @param  string  $name  name of table
     * @return DB instance of class
     */
    public static function table(string $name): DB
    {
        $newTable = new DB($name);

        return $newTable;
    }

    public function find(int $id)
    {
        $sql = 'SELECT * FROM '.$this->table.' WHERE id = :id;';
        $pdo = Connection::connect();
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch();

        if (! $user) {
            throw new Exception('Usuário com id: '.$id.', não encontrado.');
        }

        return $user;
    }

    /**
     * create a column
     *
     * @param  string  $name  define the name
     * @param  string  $type  define the type
     * @param  int  $length  define length
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance of class
     */
    public function column(string $name, string $type, int $length, bool $nullable = true): DB
    {
        $this->columns[] = [
            'name' => $name,
            'type' => $type,
            'length' => $length,
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type VARCHAR on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function string(string $name, int $length = 255, bool $nullable = true): DB
    {
        $this->columns[] = [
            'type' => 'VARCHAR',
            'name' => $name,
            'length' => $length,
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type PIRMARY KEY AUTO_INCREMENT on database
     *
     * @param  string  $name  name of column
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function primaryKey(string $name): DB
    {
        $this->columns[] = [
            'type' => 'INT AUTO_INCREMENT PRIMARY KEY',
            'name' => $name,
            'length' => '',
            'nullable' => 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type INT on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  length of column, default value is 255
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function int(string $name, int $length = 255, bool $nullable = true): DB
    {
        $this->columns[] = [
            'type' => 'INT',
            'name' => $name,
            'length' => $length,
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type TEXT on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function text(string $name, int $length = 255, bool $nullable = true): DB
    {
        $this->columns[] = [
            'type' => 'TEXT',
            'name' => $name,
            'length' => $length,
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type DATE on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function date(string $name, int $length = 255, bool $nullable = true): DB
    {
        $this->columns[] = [
            'type' => 'DATE',
            'name' => $name,
            'length' => $length,
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type FLOAT on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function float(string $name, int $length = 255, bool $nullable = true): DB
    {
        $this->columns[] = [
            'type' => 'FLOAT',
            'name' => $name,
            'length' => $length,
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * add column type BOOLEAN on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @param  bool  $nullable  define if coluns can receive null value
     * @return DB instance
     */
    public function boolean(string $name, bool $nullable = true): DB
    {
        $this->columns[] = [
            'type' => 'BOOLEAN',
            'name' => $name,
            'length' => '',
            'nullable' => ($nullable) ? 'NULL' : 'NOT NULL',
        ];

        return $this;
    }

    /**
     * create a table if not exists
     */
    public function createTableIfNotExists()
    {
        $columns = implode(', ', array_map(function ($column) {
            $name = $column['name'];
            $type = $column['type'];
            $length = $column['length'];

            return $length = "$name $type ($length)";
        }, $this->columns));

        $sql = 'CREATE TABLE IF NOT EXISTS `'.$this->table.'` ('.$columns.');';
        $sql = str_replace('()', '', $sql);
        $pdo = Connection::connect();

        try {
            $pdo->exec($sql);
        } catch (PDOException $e) {
            throw new PDOException('A Tabela já existe. \n<strong>'.$e->getMessage().'</strong>');
        }
    }

    /**
     * remove table of database if exists
     */
    public function dropTableIfExists()
    {
        $sql = 'DROP TABLE IF EXISTS '.$this->table.';';
        $pdo = Connection::connect();
        $pdo->exec($sql);
    }

    public function create(array $data)
    {

        $columns = implode(', ', array_keys($data));
        $placeholders = ':'.implode(', :', array_keys($data));
        $sql = 'INSERT INTO `'.$this->table.'` ('.$columns.') VALUES ('.$placeholders.');';
        $this->pdo = Connection::connect();
        $this->statement = $this->pdo->prepare($sql);

        foreach ($data as $key => $value) {
            $this->statement->bindParam(':'.$key, $data[$key]);
        }

        return $this;
    }

    public function save()
    {
        try {
            $this->statement->execute();

            $savedData = static::table($this->table)
                ->find($this->pdo->lastInsertId());

            return $savedData;

        } catch (PDOException $e) {
            d('Erro ao inserir o registro: '.$e->getMessage());
        }
    }
}
