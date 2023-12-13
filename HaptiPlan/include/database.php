<?php
require_once 'config.php';

class Database {

    public static function connection():PDO
    {
        $servername = SERVERNAME;
        $username = USERNAME;
        $password = PASSWORD;

        try {
            $conn = new PDO("mysql:host=$servername;port=3307;dbname=haptiplan", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }
}

