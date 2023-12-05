<?php
require_once "../include/dbConfig.inc.php";

class User {
//får ikke hentet skills fra skill Tabell
public static function getAllSkills() {
  try {
        $pdo = dbConnection();

        $query = "SELECT * FROM skill";

        //echo $query; or var_dump($query);

        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        var_dump($result);

        if ($stmt->rowCount() > 0) {
            return $result;
        } else {
            throw new Exception("fant ingen ferdigheter");
        }

    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}


    
}



?>