
<?php
require_once "../include/dbConfig.inc.php";

class getExistingData 
{   protected function getCVData($firstName, $lastName, $email, $phoneNumber, $applicantID) 
    {   try 
        {   $pdo = $this->dbConnection():

            $query = "SELECT firstName, lastName, email, phoneNumber FROM job_applicant WHERE id =: applicantID";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':applicantID', $applicantID);
            $stmt->execute();

            $cvData = $stmt ->fetchALL(PDO::FETCH_ASSOC);
            {
                catch (PDOExecption $e)
                {
                    echo "feil ved tilkobling: " . $e->getMessage();
                }

            }
        }
    }
}

?>
