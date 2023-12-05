<?php
require_once "../include/session.inc.php";
require_once "../include/dbConfig.inc.php";
require_once "../classes/appSignup.class.php";

class appLoginController extends appLogin{

  protected $email;
  protected $password;

  //definerer verdien av objekt-attributtene ovenfor til å være hva enn bruker skriver inn
  
    public function __construct($email, $password) {
      $this->email = $email;
      $this->password = $password;
    }


// Nå lager valideringsfunksjoner for jobbsøker login

public function loginUser(){
$errors=[];//errors matrisen skal inneholde alle feilmeldinger 
   
if ($this->checkEmptyFields()== true) {
        $errors["emptyField"] = "Fyll ut alle felt";
    }
    else{

    if ($this->validateEmail()==true) {
        $errors["invalidEmail"] = "Ugyldig email";
     
    }

    try{
    $applicantData = $this->getApplicant($this->email,$this->password);
   }
   catch (Exception $e){
    // Handle exceptions thrown by getApplicant
    $errors["login_errors"] = $e->getMessage();
}
}
    if ($errors) {                            //dersom det er feilmeldinger i errors
        $_SESSION["login_errors"] = $errors; // matrisen skal disse vises  i loginView
        header("Location: ../views/appLoginView.php");
        exit();
    }
   else  {                                 //dersom det IKKE er noen errors skal SESSION variablene til brukeren 
    $_SESSION["login_success"] = true;    //bli satt (dette er data som vi skal bruke på alle sider i systemet for 
    $_SESSION["role"] = "job_applicant";   //å identifisere jobbsøkeren. ps! dataen inni applicantData ble hentet i 
    $_SESSION["id"] = $applicantData["applicantID"]; //getApplicant funksjonen 
    $_SESSION["firstName"] = $applicantData["firstName"];
    $_SESSION["lastName"] = $applicantData["lastName"];

    //logg inn jobbsøker til "ledige stillinger"-siden
    header("Location: ../views/jobListingView.php");
    exit();

   }
}

function checkEmptyFields() {
    $result=false;
    $fields = [$this->email, $this->password];
    foreach ($fields as $field) {
        if (empty($field)) {
            $result=true; // noen av feltene er tomme  
            break;
        }                              
           }
           return $result;
         }
       

  //validateEmail-funksjonen sjekker om email er fylt ut korrekt dersom det ikke er tomt
  function validateEmail() {
    $result=false;   
    if (!empty($this->email) && (!filter_var($this->email, FILTER_VALIDATE_EMAIL) || !preg_match("/\.(com|no)$/", $this->email))) {
        $result=true;   //Ugyldig epost adresse 
    } 
    return  $result;
    }


}

