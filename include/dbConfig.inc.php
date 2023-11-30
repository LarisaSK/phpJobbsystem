<?php


class Database {
    
    protected function dbConnection() {
    try {
            $dbHost = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "jobbsøkersystem_mysql";

            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
            
            // Set PDO to throw exceptions on errors
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "Connection success!";
            
            return $pdo;
     } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}
?>
