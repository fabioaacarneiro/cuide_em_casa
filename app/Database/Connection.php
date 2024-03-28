<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Class thats implement connection with databse
 * with PDO Class
 */ class Connection
{
    /**
     * make a Connection instance and return her $pdo attribute
     *
     * @return PDO instance
     */
    public static function connect(): PDO
    {
        $config = require __DIR__.'/database.php';
        $dsn = $config->dbserver.':host='.$config->host.';dbname='.$config->dbname;

        try {

            $pdo = new PDO($dsn, $config->user, $config->pass);

            return $pdo;

        } catch (PDOException $exc) {
            exit('Erro ao conectar ao bando de dados: '.$exc->getMessage());
        }

    }
}
