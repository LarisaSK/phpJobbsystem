<?php
require_once "../include/session.inc.php";
require_once "../include/dbConfig.inc.php";
require_once "../classes/appSignup.class.php";




class appSignupController extends appSignup{

  protected $firstName;
  protected $lastName;
  protected $email;
  protected $city;
  protected $password;
  protected $cpassword;

  //definerer verdien av objekt-attributtene ovenfor til å være hva enn bruker skriver inn
  
    public function __construct($firstName, $lastName, $email, $city, $password, $cpassword) {
      $this->firstName = $firstName;
      $this->lastName = $lastName;
      $this->email = $email;
      $this->city = $city;
      $this->password = $password;
      $this->cpassword = $cpassword;

    }


// Nå lager valideringsfunksjoner for jobbsøker registrering


//checkEmptyFields-funksjonen sjekker om navn-feltene, email og passord-feltene er fylt 
//ut og gir en returverdi basert på dette

public function signupUser(){
//Før vi registrerer bruker skal vi skjekke svarene fra alle metodene og vise
//dem til jobbsøker 

$errors=[];//errors matrisen skal inneholde alle feilmeldinger 
   
if ($this->checkEmptyFields()== true) {
        $errors["emptyField"] = "Fyll ut alle felt";
     
    }
    else{

 if ($this->validateFullName()== true) {
        $errors["invalidFullName"] = "Navnet kan kun inneholde bokstaver";
      
    }
    if ($this->validateEmail()==true) {
        $errors["invalidEmail"] = "Ugyldig email";
     
    }
    if ($this->validatePasswordLength()==true) {
        $errors["invalidPasswLength"] = "Passord må være minst 6 tegn";
        
    } 
    if ($this->confirmPassword()==true) {
        $errors["passwordNotConfirmed"] = "passordene er ikke like";
        
    }
    if ($this->checkRegisteredEmails()==true) {
        $errors["emailExists"] = "Email er allerede registrert";
     
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
    $this->setApplicant($this->firstName,$this->lastName,$this->email,$this->city,$this->password);
}
}

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

function checkRegisteredEmails(){
    $result=false;
    if($this->getExistingEmails($this->email)){
        $result=true; // emailen er allerede registrert i databasen
    }
    
      return $result; //emailen er ikke registrert i databasen
  
}

}

?>