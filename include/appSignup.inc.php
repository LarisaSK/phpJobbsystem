<?php
include "../include/session.inc.php";
require_once "../include/dbConfig.inc.php";
include "../classes/appSignup.class.php";
include "../controllers/appSignup.con.php";

//selvNotat: husk å overføre dette til appsignupController istedenfor

//sjekker at brukeren har sendt formen ved hjelp av post metode
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])){


        //tar tak i data fra arbeidsgiver og putter dem inn i variabler som jeg kan sjekke 
        $firstName = htmlentities($_POST["firstName"], ENT_QUOTES, 'UTF-8');
        $lastName = htmlentities($_POST["lastName"], ENT_QUOTES, 'UTF-8');
        $email = htmlentities($_POST["email"], ENT_QUOTES, 'UTF-8');
        $city = htmlentities($_POST["city"], ENT_QUOTES, 'UTF-8');
        $password = htmlentities($_POST["password"], ENT_QUOTES, 'UTF-8');
        $cpassword = htmlentities($_POST["cpassword"], ENT_QUOTES, 'UTF-8');

        //initialiserer appSignup controller klassen fra kontrolleren



$appSignup= new appSignupController($firstName, $lastName, $email, $city,$password, $cpassword);


//validering av input
$appSignup->signupUser(); //signupUser function from the controller

}




 


?>