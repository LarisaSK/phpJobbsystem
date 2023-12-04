<?php
require_once "../include/dbConfig.inc.php";
require_once "../classes/appSignup.class.php";
$appSignup = new appSignup();



class jobPost
{
    public static function getAllJobPositions()
    {
        try {
            $pdo = dbConnection();

            $query = "SELECT positionName FROM position";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            if ($stmt->rowCount() > 0) {
                return $result;
            } else {
                throw new Exception("No positions found");
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

//denne funksjonen lagrer jobbannonser i databasen
    public static function saveJobPost($formFields)
    {
        try {
            $pdo = dbConnection();

            //SQL query for å putte fromData inni job_posting-tabellen i db
            $query = "INSERT INTO job_posting (jobTitle,companyName, positionName, employmentType, jobDescription, deadline, startDate, locationID, address) 
                      VALUES (:jobTitle, :companyName, :positionName, :employmentType, :jobDescription, :deadline, :startDate, :locationID, :address)";

            //forbreder  SQL query for å unngå SQL injection
            $stmt = $pdo->prepare($query);

            //binder verdiene i queryen til verdiene i formFields-Array 
            //som jeg definerte i jobPost kontrolleren
            $stmt->bindParam(':jobTitle',  $formFields['jobTitle']);
            $stmt->bindParam(':companyName',  $formFields['companyName']);
            $stmt->bindParam(':positionName', $formFields['positionName']);
            $stmt->bindParam(':employmentType',$formFields['employmentType']);
            $stmt->bindParam(':jobDescription', $formFields['jobDescription']);
            $stmt->bindParam(':deadline', $formFields['deadline']);
            $stmt->bindParam(':startDate', $formFields['startDate']);
            $stmt->bindParam(':locationID', $formFields['city']);
            $stmt->bindParam(':address', $formFields['address']);

            //utfører queryen
            $stmt->execute();

            //henter den nyeste jobPostID-en i tabellen for å bekrefte
            //at den har økt med en
            $lastInsertId = $pdo->lastInsertId();
            if ($lastInsertId > 0) {
                // returner success melding 
                return ['success' => true, 'message' => 'Annonsen er lagt ut.'];
            } else {
                // If not, show an error message
                throw new Exception("Greide ikke å legge ut annonsen.");
            }
        } catch (Exception $e) {
            // If an exception occurs, catch it and return an error message
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

}
