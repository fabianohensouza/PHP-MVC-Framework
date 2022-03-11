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

        $newMigratrions = [];
        $appliedMigrations = $this->getAppliedMigrations();        
        $files =  scandir(Application::$ROOT_DIR . '/migrations');

        $toApplyMigration = array_diff($files, $appliedMigrations);
        foreach ($toApplyMigration as $migration) {
            if ( $migration !== '.' && $migration !== '..' ) {

                require_once Application::$ROOT_DIR . '/migrations/' . $migration;
                $className = pathinfo($migration, PATHINFO_FILENAME);

                $instance = new $className;
                $this->log("Applying migration $migration");
                $instance->up();
                $this->log("The migration $migration were applied");

                $newMigratrions[] = $migration;
            }
        }

        if (!empty($newMigratrions)) {
            $this->saveMigrations($newMigratrions);
       } else {
           $this->log("All migrations are applied");
       }
    }

    public function createMigrationsTable()
    {        
        $this->pdo->exec("  CREATE TABLE IF NOT EXISTS migrations (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                migration VARCHAR(255),
                                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                            ) ENGINE=INNODB;"
                        );
    }

    public function getAppliedMigrations()
    {        
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migratrions)
    {        
        $registers = implode(",",array_map(fn($m) => "('$m')", $migratrions));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES $registers");
        $statement->execute();
        
    }

    protected function log(string $message)
    {
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL; 
    }
}