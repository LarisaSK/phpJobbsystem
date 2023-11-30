<?php
require_once "../include/dbConfig.inc.php";
class appLogin  {


public function getApplicant($email, $password) {
    try {
        // Establish a connection to the database
        $pdo = dbConnection();

        // Fetch hashed password from the database based on the provided email
        $query = "SELECT applicantID,firstName, lastName, email, password FROM job_applicant WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':email', $email);

        if (!$stmt->execute()) {
            throw new Exception("spørringen gikk ikke gjennom");
        }

        // her henter vi resultatet av spørringen som en array med navnet result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                   
        if (empty($result)) {  //her sjekkes at dersom array result er tom så skal
                        
        throw new Exception("Emailen er ikke registert hos oss");//vi vise denne feilmeldingen
        }

        //hvis email finnes  gå videre til validering av passord
        $hashedPassword = $result['password'];    //henter ut db passordet som ble returnet i result array
        if (!password_verify($password, $hashedPassword)) { 
            // Password does not match
            throw new Exception("Passordet er ikke riktig");
        }

        // Password matches, return the applicant information
        unset($result['password']); // Remove the hashed password from the result
        return $result;
}
     catch (Exception $e) {
        // Log the exception to a file or another logging mechanism
        error_log("Error: " . $e->getMessage());
        throw $e;

    }
  }
}
?>
