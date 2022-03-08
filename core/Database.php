<?php
/** User:  FHS Dev */

namespace app\core;

/**
 * Class Database
 *
 *@author FHS Dev <fhsdev@gmail.com>
 *@package app\core
 */
class Database
{

    public \PDO $pdo;
    /**
     * Database constructor
     */
    public function __construct(array $config) 
    {

        $dsn = $config['dns'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        try {
            $this->pdo = new \PDO($dsn, $user, $password);
        }
        catch(\PDOException $e) {
            die( 'Query failed: ' . $e->getMessage() );
        }

        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
}