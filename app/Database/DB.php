<?php

namespace App\Database;

use PDO;

/**
 * this class implements methods that manipulate tables on
 * database
 */
class DB
{
    private string $table;

    private array $columns;

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

    /**
     * create a column
     *
     * @param  string  $name  define the name
     * @param  string  $type  define the type
     * @param  int  $length  define length
     * @return DB instance of class
     */
    public function column(string $name, string $type, int $length): DB
    {
        $this->columns[] = [
            'name' => $name,
            'type' => $type,
            'length' => $length,
        ];

        return $this;
    }

    /**
     * add column type VARCHAR on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @return DB instance
     */
    public function string(string $name, int $length = 255): DB
    {
        $this->columns[] = [
            'type' => 'VARCHAR',
            'name' => $name,
            'length' => $length,
        ];

        return $this;
    }

    /**
     * add column type INT on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @return DB instance
     */
    public function int(string $name, int $length = 255): DB
    {
        $this->columns[] = [
            'type' => 'INT',
            'name' => $name,
            'length' => $length,
        ];

        return $this;
    }

    /**
     * add column type TEXT on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @return DB instance
     */
    public function text(string $name, int $length = 255): DB
    {
        $this->columns[] = [
            'type' => 'TEXT',
            'name' => $name,
            'length' => $length,
        ];

        return $this;
    }

    /**
     * add column type DATE on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @return DB instance
     */
    public function date(string $name, int $length = 255): DB
    {
        $this->columns[] = [
            'type' => 'DATE',
            'name' => $name,
            'length' => $length,
        ];

        return $this;
    }

    /**
     * add column type FLOAT on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @return DB instance
     */
    public function float(string $name, int $length = 255): DB
    {
        $this->columns[] = [
            'type' => 'FLOAT',
            'name' => $name,
            'length' => $length,
        ];

        return $this;
    }

    /**
     * add column type BOOLEAN on database
     *
     * @param  string  $name  name of column
     * @param  int  $length  legth of column, default value is 255
     * @return DB instance
     */
    public function boolean(string $name): DB
    {
        $this->columns[] = [
            'type' => 'BOOLEAN',
            'name' => $name,
            'length' => '',
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

        $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->table . '(' . $columns . ')';
        $sql = str_replace('()', '', $sql);
        $pdo = Connection::connect();
        $pdo->exec($sql);
    }

    public function dropTableIfExists()
    {
        $sql = 'DROP TABLE IF EXISTS ' . $this->table . ';';
        $pdo = Connection::connect();
        $pdo->exec($sql);
    }
}
