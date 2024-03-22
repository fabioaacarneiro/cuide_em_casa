<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Class thats implement connection with databse
 * with PDO Class
 */
class Connection
{
    private $pdo;

    /**
     * create a object of Connection and initialize $pdo attribute
     *
     * @params object $config object with connection data
     */
    private function __construct(object $config)
    {

        $dsn = $config->dbserver.':host='.$config->host.';dbname='.$config->dbname;

        try {
            $this->pdo = new PDO($dsn, $config->user, $config->pass);
            echo 'conectado com sucesso';
        } catch (PDOException $exc) {
            exit('Erro ao conectar ao bando de dados: '.$exc->getMessage());
        }
    }

    /**
     * make a Connection instance and return her $pdo attribute
     *
     * @return PDO instance
     */
    public static function connect()
    {
        $config = (object) require_once 'database.php';
        $conn = new Connection($config);

        return $conn->pdo;
    }
}
