<?php
require_once "../include/dbConfig.inc.php";


class appSignup  {
//denne funksjonen henter emailer som er registrert i db
    protected function getExistingEmails($email) {
try {
            $pdo = dbConnection();
    
            // sjekker i både applicant og employer tabell om emailen eksisterer
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
            // sjekker om email allerede eksisterer
          if ($this->getExistingEmails($email)) {
                throw new Exception("Email already exists"); //hvis ja- får bruker feilmelding
            }                                                     
    
            // Hvis emailen ikke eksisterer beveger vi oss til password hashing
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            // Kobler til db
        $pdo = dbConnection();
    
            // lager prepared query for å unngå SQL injection
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
    
 //her hentes alle byer fra lokasjonstabellen i db for å putte inni dropdown
 //under registrering
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
                throw new Exception("fant ingen byer");
            }

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
