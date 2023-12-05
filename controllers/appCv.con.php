<?php
require_once 'appCV.class.php';

/*class CVController {
    public function showCV($userId) {
        $cvModel = new CVModel();
        $cvData = $cvModel->getCVData($userId);

        // Send CV-data til visningen
        require 'view.php';
    }
}

// Eksempel på bruk av kontrolleren
$cvController = new CVController();
$cvController->showCV(1); // Brukerens ID */


 
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    //Henter eksisterende data ved registrering
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        //Lagrer dataene basert på input
        $cvData = array(
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'education' => $education,
            'experience' => $experience,
            'skills' => $skills
        );
            //funksjon som skal lagre dataen i databasen
            saveCVData($cvData);

        //Bekrefter endring av CV
        echo "<h3>Takk, $name! CV-en din er oppdatert.</h3>";
    }

// En funksjon for å lagre CV-dataene
function saveCVData($cvData) 
{
    $filename = 'cv_data.txt';
    file_put_contents($filename, json_encode($cvData), FILE_APPEND);
}
?>