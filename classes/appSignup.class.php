<?php
require_once "../include/dbConfig.inc.php";


class appSignup  {

    protected function getExistingEmails($email) {
        try {
            $pdo = dbConnection();
    
            // Check if the email exists in either the employer or job_applicant table
            $query = "SELECT email FROM employer WHERE email = :email
                      UNION
                      SELECT email FROM job_applicant WHERE email = :email";
    
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":email", $email);
            
            if (!$stmt->execute()) {
                throw new Exception("Statement execution failed");
            }
    
            return $stmt->rowCount() > 0;
    
        } catch (Exception $e) {
        
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public  function setApplicant($firstName, $lastName, $email, $city, $password) {
        try {
            // Check if the email already exists
            if ($this->getExistingEmails($email)) {
                throw new Exception("Email already exists");
            }
    
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Establish a connection to the database
            $pdo = dbConnection();
    
            // Prepare INSERT query for registration
            $query = "INSERT INTO job_applicant (firstName, lastName, email, applicantLocationID, password) 
                      VALUES (:firstName, :lastName, :email, :applicantLocationID, :password)";
    
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':applicantLocationID', $city);
            $stmt->bindParam(':password', $hashedPassword);
    
            if (!$stmt->execute()) {
                throw new Exception("Statement execution failed");
            }
    
            return $stmt->rowCount() > 0;
    
        } catch (Exception $e) {
      
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

    public static function getAllLocation() {
        try {
            $pdo = dbConnection();

            $query = "SELECT * FROM location";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            if ($stmt->rowCount() > 0) {
                return $result;
            } else {
                throw new Exception("No locations found");
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
