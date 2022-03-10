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
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';

        try {
            $this->pdo = new \PDO($dsn, $user, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        catch(\PDOException $e) {
            die( 'Query failed: ' . $e->getMessage() );
        } 
    }

    public function applyMigrations()
    {        
        $this->createMigrationsTable();
        $this->getAppliedMigrations();
    }

    public function createMigrationsTable()
    {        
        $this->pdo->exec("  CREATE TABLE IF NOT EXISTS migrations (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                migration VARCHAR(255),
                                created_at TIMESTAMP DEFAUL CURRENT_TIMESTAMP
                            ) ENGINE=INNODB;"
                        );
    }

    public function getAppliedMigrations()
    {        
        $statement = $this->pdo->prepare("SELEC migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }
}