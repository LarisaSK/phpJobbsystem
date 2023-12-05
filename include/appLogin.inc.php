<?php
include "../include/session.inc.php";
require_once "../include/dbConfig.inc.php";
include "../classes/appLogin.class.php";
include "../controllers/appLogin.con.php";

//selvNotat: husk å overføre dette til appLogin Controller istedenfor

//sjekker at brukeren har sendt formen ved hjelp av post metode
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])){


        //tar tak i data fra arbeidsgiver og putter dem inn i variabler som jeg kan sjekke 
        $email = htmlentities($_POST["email"], ENT_QUOTES, 'UTF-8');
        $password = htmlentities($_POST["password"], ENT_QUOTES, 'UTF-8');
   

        //initialiserer appLogin controller klassen fra kontrolleren



$appLogin= new appLoginController( $email,$password);


//validering av input
$appLogin->LoginUser(); //loginUser funksjonen fra kontrolleren

}




 


?>