<?php
require_once 'config.php';

class Database {
    
    private $pdo;
    private static $instance;

    private function __construct(){
        $db_string = DB_TYPE.":host=".DB_HOST.";dbname=".DB_DATABASE;
        $this->pdo = new PDO($db_string, DB_USER, DB_PASSWORD);
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($sql, $params = array()){
        $db_statement = $this->pdo->prepare($sql);

        $db_statement->execute($params);

        return $db_statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $sql_params = []) {

        $db_statement = $this->pdo->prepare($sql);

        return $db_statement->execute($sql_params);

    }
}

