<?php

require_once "../include/validationFunctions.inc.php";
require_once "../include/errorHandler.inc.php";
require_once "../classes/user.class.php";


//validerer og sender inn søknad
if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submitApplication"])){
    $formFields = [
        'firstName'          => htmlentities($_POST["firstName"], ENT_QUOTES, 'UTF-8'),
        'lastName'         => htmlentities($_POST["lastName"], ENT_QUOTES, 'UTF-8'),
        'email'            => htmlentities($_POST["email"], ENT_QUOTES, 'UTF-8'),
        'city'               => htmlentities($_POST["city"], ENT_QUOTES, 'UTF-8'),
        'address'          => htmlentities($_POST["address"], ENT_QUOTES, 'UTF-8'),
        'application'      => htmlentities($_POST["application"], ENT_QUOTES, 'UTF-8'),
    ];
    
    
    // Validerer inndata og viser nødvendige feilmeldinger ved å kalle på funksjoner i 
// validateFunctions og errorHandler (disse er statiske, derfor kan de kalles slik)
if (Validator::areEmptyFields($formFields)) {
    ErrorHandler::checkForError();
}
elseif(Validator::fullNameIsValid($formFields)){
    ErrorHandler::checkForError();  
}
elseif(Validator::validateEmail($formFields)){
    ErrorHandler::checkForError();  
   }
   else {
echo "nå må jeg lage set metode for å lagre søknaden i databsen";
   }
}

   



   




?>