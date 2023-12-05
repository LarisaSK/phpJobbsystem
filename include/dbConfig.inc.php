<?php


//denne funksjonen etablerer koblin med databasen og skal inkluderes i alle 
//spørringer mot databasen
    
function dbConnection() {
    try {
            $dbHost = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "jobbsøkersystem_mysql";

            $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
            
            
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "Connection success!";
            
            return $pdo;
     } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

?>
