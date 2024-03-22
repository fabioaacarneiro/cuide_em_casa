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
        $newTable->pdo = Connection::connect();

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
     * create a table if not exists
     */
    public function createTableIfNotExists()
    {
        $columns = implode(', ', array_map(function ($column) {
            $name = $column['name'];
            $type = $column['type'];
            $length = isset($column['length']) ? "($column[length])" : '';

            return "$name $type$length";
        }, $this->columns));

        $sql = 'CREATE TABLE IF NOT EXISTS '.$this->table.'('.$columns.')';

        $this->pdo->exec($sql);
    }
}
