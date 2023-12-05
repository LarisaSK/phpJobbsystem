<?php
require_once "../include/dbConfig.inc.php";
require_once "../classes/appSignup.class.php";
$appSignup = new appSignup();



class jobPost
{

    //denne funksjonen henter alle stillinger fra position tabell slik at arbeidsgiver
    //kan velge hvilken stilling de utlyser for
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
            $stmt->bindValue(':deadline', $formFields['deadline']->format('Y-m-d'));
            $stmt->bindValue(':startDate', $formFields['startDate']->format('Y-m-d'));
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
                // eller returnerer feilmelding 
                throw new Exception("Greide ikke å legge ut annonsen.");
            }
        } catch (Exception $e) {
      // dersom annonsen ikke lagres vis feilmelding
            return ['success' => false, 'message' => 'Error: ' . $e->getMessage()];
        }
    }

    //denne funksjonen henter ID, Tittlel, stilling og by fra alle annonser i db
 //for å vise i jobPostListView
    public static function ListPublishedJobPosts()
    {
 try {

            $pdo = dbConnection();
            $query = "SELECT jp.jobPostingID, jp.jobTitle, jp.positionName, lt.locationName
            FROM job_posting AS jp
            INNER JOIN location AS lt ON jp.locationID = lt.locationID;
            ";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            // Henter alle annonser som en assosiativ matrise
            $jobPostList = $stmt->fetchAll(PDO::FETCH_ASSOC);
     if($jobPostList){
                return $jobPostList; 
            }
      else {
       
                throw new Exception("Fant ingen jobb annonser.");
            }
} catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public static function DetailedJobPostById($jobPostID){
try {
           //Denne spørringen henter detaljert informasjon om en jobbannonse, 
           //inkludert lokasjonsnavnet, 
           //ved å koble  tabeller jobPosting og location basert på jobbannonse-ID-en.
            $pdo = dbConnection();
            $query = "SELECT jp.*, lt.locationName
            FROM job_posting AS jp
            INNER JOIN location AS lt ON jp.locationID = lt.locationID
            WHERE jp.jobPostingID = :jobPostingID;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':jobPostingID', $jobPostID);
            $stmt->execute();
            // henter hele annonsen som en array
            $jobPost = $stmt->fetch(PDO::FETCH_ASSOC);

           // var_dump($jobPost);
      if($jobPost) { //hvis annonse info ble hentet skal den returneres
                return $jobPost;
              
     } else {
                throw new Exception("Fant ikke jobb annonsen");
            }
} catch (Exception $e) {
            echo "Error: " . $e->getMessage();
           
        }
    }
}
