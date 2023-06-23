<?php 

namespace App\core\db;

use App\core\Application;

class Database {
    public \PDO $pdo;

    public function __construct(array $config){
        $dsn = $config['dsn'] ?? '';
        $user = $config['user'] ?? '';
        $password = $config['password'] ?? '';
        
        $this->pdo = new \PDO($dsn, $user, $password);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function applyMigrations(){
        $this->createMigrationsTable();
        $appliedMigrations = $this->getAppliedMigrations();

        $newMigration = [];

        $files = scandir(Application::$ROOT_DIR.'/migrations');
        $toAppliedMigrations = array_diff($files, $appliedMigrations);
        foreach($toAppliedMigrations as $migration) {
            if($migration === '.' || $migration === '..'){
                continue;
            }

            require_once Application::$ROOT_DIR.'/migrations/'.$migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $instance = new $className;
                $this->log(" Appling Migration $migration");
            $instance->up();
                $this->log(" Applied Migration $migration");
            $newMigration[] = $migration;
        }
        if(!empty($newMigration)){
            $this->saveMigrations($newMigration);
        }else{
            $this->log("All migration are applied");
        }
    }

    public function createMigrationsTable(){
        $this->pdo->exec("CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=INNODB;");
    }

    public function getAppliedMigrations(){
        $statement = $this->pdo->prepare("SELECT migration FROM migrations");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function saveMigrations(array $migration){
        $str = implode(",", array_map(fn($m) => "('$m')", $migration));
        $statement = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES
            $str;
        ");
        $statement->execute();
    }

    public function prepare($sql){
        return $this->pdo->prepare($sql);
    }

    protected function log($message){
        echo '[' . date('Y-m-d H:i:s') . '] - ' . $message . PHP_EOL;
    }
}