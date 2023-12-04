<?php
require_once "../include/validationFunctions.inc.php";
require_once "../include/errorHandler.inc.php";
require_once "../classes/jobPost.class.php";



if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["publishJobPost"])){



    $formFields = [
        // Take data from the job posting form and store them in variables for validation
        'jobTitle'        => htmlentities($_POST["jobTitle"], ENT_QUOTES, 'UTF-8'),
        'companyName'        => htmlentities($_POST["companyName"], ENT_QUOTES, 'UTF-8'),
        'positionName'    => htmlentities($_POST["positionName"], ENT_QUOTES, 'UTF-8'),
        'jobDescription'   => htmlentities($_POST["jobDescription"], ENT_QUOTES, 'UTF-8'),
        'employmentType'   => htmlentities($_POST["employmentType"], ENT_QUOTES, 'UTF-8'), // Assuming you want to store "fullTime" or "partTime"
        'deadline'         => htmlentities($_POST["deadline"], ENT_QUOTES, 'UTF-8'),
        'startDate'        => htmlentities($_POST["startDate"], ENT_QUOTES, 'UTF-8'),
        'city'             => htmlentities($_POST["city"], ENT_QUOTES, 'UTF-8'),
        'address'          => htmlentities($_POST["address"], ENT_QUOTES, 'UTF-8'),
    ];

    //valderer input og viser nødvendige feilmeldinger ved å kalle på funksjoner i 
    //validateFunctions og errorHandler.  (disse er static derfor kan de kalles slik)
if (Validator::areEmptyFields($formFields)){
ErrorHandler::checkForError();
}
else{
//hvis formen er riktig utfylt skal saveJobPost fra modellen 
    $result = JobPost::saveJobPost($formFields); //

if ($result['success']) {
    // viser sucess melding til arbeidsgiver
    echo $result['message'];
} else {
    // viser feilmelding arbeidsgiver
    echo $result['message'];
}
}




}




?>