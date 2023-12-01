<?php

require_once "../include/session.inc.php";
require_once "../include/dbConfig.inc.php";
require_once "../include/validationFunctions.inc.php";
require_once "../classes/appSignup.class.php";




class appSignupController extends appSignup{

//   protected $firstName;
//   protected $lastName;
//   protected $email;
//   protected $city;
//   protected $password;
//   protected $cpassword;

//   //definerer verdien av objekt-attributtene ovenfor til å være hva enn bruker skriver inn
  
//     public function __construct($firstName, $lastName, $email, $city, $password, $cpassword) {
//       $this->firstName = $firstName;
//       $this->lastName = $lastName;
//       $this->email = $email;
//       $this->city = $city;
//       $this->password = $password;
//       $this->cpassword = $cpassword;

//     }


public function createApplicant(){
//sjekker at brukeren har sendt formen ved hjelp av post metode
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])){

    $formFields= [
    //tar tak i data fra arbeidsgiver og putter dem inn i variabler som jeg kan sjekke 
    'firstName'  => htmlentities($_POST["firstName"], ENT_QUOTES, 'UTF-8'),
    'lastName'  => htmlentities($_POST["lastName"], ENT_QUOTES, 'UTF-8'),
    'email'  => htmlentities($_POST["email"], ENT_QUOTES, 'UTF-8'),
    'city'  => htmlentities($_POST["city"], ENT_QUOTES, 'UTF-8'),
    'password'  => htmlentities($_POST["password"], ENT_QUOTES, 'UTF-8'),
    'cpassword'  => htmlentities($_POST["cpassword"], ENT_QUOTES, 'UTF-8'),
    
];


$errors=[];//errors matrisen skal inneholde alle feilmeldinger 
if(!Validator::areEmptyFields($formFields)){
    $errors["emptyField"] = "Fyll ut alle felt";

}
// if ($this->checkEmptyFields()== true) {
//         $errors["emptyField"] = "Fyll ut alle felt";
 //}    
//     
    else{

 if (!Validator::validateFullName($formFields["firstName"], $formFields["lastName"])) {
        $errors["invalidFullName"] = "Navnet kan kun inneholde bokstaver";
      exit();
    }
    if (!Validator::validateEmail($formFields["email"])==true) {
        $errors["invalidEmail"] = "Ugyldig email";
        exit();
    }
    if (Validator::validatePasswordLength($formFields["password"])) {
        $errors["invalidPasswLength"] = "Passord må være minst 6 tegn";
        exit();
    } 
    if (Validator::confirmPassword($formFields["password"],$formFields["cpassword"])) {
        $errors["passwordNotConfirmed"] = "passordene er ikke like";
        exit();
    }
    if ($this->checkRegisteredEmails($formFields["email"])==true) {
        $errors["emailExists"] = "Email er allerede registrert";
        exit();
    }
 }
    if ($errors) { //dersom det er feilmeldinger i errors matrisen skal disse vises  
        $_SESSION["signup_errors"] = $errors; //i signupView
    
        header("Location: ../views/appSignupView.php");
        exit();
    }
    {
        $_SESSION["signup_success"] = true;
        header("Location: ../views/appSignupView.php");
        
        $model = new appSignup();
        $model->setApplicant($formFields["firstName"], $formFields["lastName"],$formFields["email"],$formFields["city"],$formFields["password"]);
    //$this->setApplicant($this->firstName,$this->lastName,$this->email,$this->city,$this->password);
}
}
}

// Nå lager valideringsfunksjoner for jobbsøker registrering


//checkEmptyFields-funksjonen sjekker om navn-feltene, email og passord-feltene er fylt 
//ut og gir en returverdi basert på dette

//public function signupUser(){
//Før vi registrerer bruker skal vi skjekke svarene fra alle metodene og vise
//dem til jobbsøker 

// $errors=[];//errors matrisen skal inneholde alle feilmeldinger 
   
// if ($this->checkEmptyFields()== true) {
//         $errors["emptyField"] = "Fyll ut alle felt";
     
//     }
//     else{

//  if ($this->validateFullName()== true) {
//         $errors["invalidFullName"] = "Navnet kan kun inneholde bokstaver";
      
//     }
//     if (Validator::validateEmail($formFields["email"])==true) {
//         $errors["invalidEmail"] = "Ugyldig email";
     
//     }
//     if ($this->validatePasswordLength()==true) {
//         $errors["invalidPasswLength"] = "Passord må være minst 6 tegn";
        
//     } 
//     if ($this->confirmPassword()==true) {
//         $errors["passwordNotConfirmed"] = "passordene er ikke like";
        
//     }
//     if ($this->checkRegisteredEmails()==true) {
//         $errors["emailExists"] = "Email er allerede registrert";
     
//     }
//  }
//     if ($errors) { //dersom det er feilmeldinger i errors matrisen skal disse vises  
//         $_SESSION["signup_errors"] = $errors; //i signupView
    
//         header("Location: ../views/appSignupView.php");
//         exit();
//     }
//     {
//         $_SESSION["signup_success"] = true;
//         header("Location: ../views/appSignupView.php");
//     $this->setApplicant($this->firstName,$this->lastName,$this->email,$this->city,$this->password);
// }
// }
/*
function checkEmptyFields() {
    $result=false;
    $fields = [$this->firstName, $this->lastName,  $this->email, $this->password, $this->cpassword];
    foreach ($fields as $field) {
        if (empty($field)) {
            $result=true; // noen av feltene er tomme  
            break;
        }                              
           }
           return $result;
         }
       
         // validateFullName-funkjonen sjekker om navnet kun inneholder bokstaver
       function validateFullName() {
        $result=false;
        if( !preg_match('/^[a-zA-Z]+$/',$this->firstName) || !preg_match('/^[a-zA-Z]+$/',  $this->lastName)){
        $result=true;
    }
      return   $result;
   }
      

  //validateEmail-funksjonen sjekker om email er fylt ut korrekt dersom det ikke er tomt
  function validateEmail() {
    $result=false;   
    if (!empty($this->email) && (!filter_var($this->email, FILTER_VALIDATE_EMAIL) || !preg_match("/\.(com|no)$/", $this->email))) {
        $result=true;   //Ugyldig epost adresse 
    } 
    return  $result;
    }
  
  
  //validatePasswordLength sjekker om passord lengden er mindre enn 6 eller ikke 
function validatePasswordLength() {
    $result=false;
    if (strlen($this->password) < 6) {
        $result=true; // Passordet er for kort
    } 
        return $result; // Passordet er langt nok
    }
  
  
  //confimPassword- funksjonen sjekker at bruker-input i password og confirmpassword er like
  function confirmPassword(){
    $result=false;
    if($this->password!==$this->cpassword){
        $result=true; // passordene er IKKE like 
    }
    
      return $result; //passordene er like
  
}
*/
function checkRegisteredEmails($formFields){
    $result=false;
    if($this->getExistingEmails($formFields["email"])){
        $result=true; // emailen er allerede registrert i databasen
    }
    
      return $result; //emailen er ikke registrert i databasen
  
}

}


?>