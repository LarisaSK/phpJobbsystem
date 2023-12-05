<?php
require_once "../include/validationFunctions.inc.php";
require_once "../include/errorHandler.inc.php";
require_once "../classes/jobPost.class.php";


//validerer og lagrer jobb annonse
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["publishJobPost"])){



    $formFields = [
        // henter data fra jobPosting form for validering og lagring
        'jobTitle'        => htmlentities($_POST["jobTitle"], ENT_QUOTES, 'UTF-8'),
        'companyName'        => htmlentities($_POST["companyName"], ENT_QUOTES, 'UTF-8'),
        'positionName'    => htmlentities($_POST["positionName"], ENT_QUOTES, 'UTF-8'),
        'jobDescription'   => htmlentities($_POST["jobDescription"], ENT_QUOTES, 'UTF-8'),
        'employmentType'   => htmlentities($_POST["employmentType"], ENT_QUOTES, 'UTF-8'), 
        'deadline'        => DateTime::createFromFormat('Y-m-d',$_POST["deadline"]),// for at datoene skal være i formen 'YYYY-MM-DD 
        'startDate'       => DateTime::createFromFormat('Y-m-d',$_POST["startDate"]),//når jeg oppretter dateTime objekter i isValidDate funksjonen
        'city'             => htmlentities($_POST["city"], ENT_QUOTES, 'UTF-8'),
        'address'          => htmlentities($_POST["address"], ENT_QUOTES, 'UTF-8'),
    ];

 // Validerer bruker input  og viser nødvendige feilmeldinger ved å kalle på funksjoner i 
// validateFunctions og errorHandler (disse er statiske, derfor kan de kalles slik)
if (Validator::areEmptyFields($formFields)) {
    ErrorHandler::checkForError();

} elseif (!Validator::isValidDate($formFields)) {
    ErrorHandler::checkForError();
} else {
    // Hvis skjemaet er riktig utfylt, kall saveJobPost fra modellen
    $jobPostSaved = JobPost::saveJobPost($formFields);

         if ($jobPostSaved['success']) {
        // Vis suksessmelding til arbeidsgiver
        echo $jobPostSaved['message'];
            } else {
        // Vis feilmelding til arbeidsgiver
        echo $jobPostSaved['message'];
        }
    }
}
//kaller på ListPublishedJobPosts funksjonen i jobPost klassen for å vise liste over 
//annonser i jobPostListingView
$jobPostList = jobPost::ListPublishedJobPosts();


//denne GET-metoden startes når jobbsøker trykker på se Detaljer-linken for en annonse
//i jobPostListingView.php
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["jobPostingID"])) {
    // Henter detaljert informasjon om en spesifikk jobbannonse basert på  id
    $jobPostID = $_GET["jobPostingID"];
    $detailedJobPostMethod = JobPost::DetailedJobPostById($jobPostID);

    
}



?>