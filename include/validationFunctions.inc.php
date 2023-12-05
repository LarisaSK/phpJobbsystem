<?php

class Validator
{

  //denne funksjonen sjekker om noen input felt er tomme 
  public static function areEmptyFields($formFields)
  {  
    $result = false;

    foreach ($formFields as $formField) {
      if (empty($formField)) {
        ErrorHandler::addError("ingen felt kan være tomme");
        $result = true; //  
       break; // bruker break slik at feilmeldingen kun vises en gang isteden for 
       // for hvert tomt felt
      }
    }
    return $result;
  }

  //denne funksjonen sjekker at datoene i jobbannonse er gyldige 
  public static function isValidDate($formFields)
  {
      $result = false;
  
      $inputStartDate = $formFields['startDate'];
      $inputDeadline =  $formFields['deadline'];
  
      // Sammenligner datoene
      if ($inputDeadline >= $inputStartDate) {
          ErrorHandler::addError("Startdato må være etter søkefrist.");
      } elseif ($inputStartDate < new DateTime()) {
          ErrorHandler::addError("Startdato kan ikke være gammel.");
      } elseif ($inputDeadline < new DateTime()) {
          ErrorHandler::addError("Fristdato kan ikke være gammel.");
      } else {
          $result = true;
      }
  
      return $result;
  }

  public static function fullNameIsValid($formFields) {
    $result=false;
    if( !preg_match('/^[a-zA-Z]+$/',$formFields["firstName"]) 
    || !preg_match('/^[a-zA-Z]+$/',$formFields["lastName"])){
      ErrorHandler::addError("navn kan kun bestå av bokstaver");
$result = true;
     }  
  return   $result;
}
  

//validateEmail-funksjonen sjekker om email er fylt ut korrekt dersom det ikke er tomt
public static function validateEmail($formFields) {
$result=false;   
if ((!empty($formFields["email"])) &&
 (!filter_var($formFields["email"], FILTER_VALIDATE_EMAIL) ||
  !preg_match("/\.(com|no)$/", $formFields["email"]))) {
    ErrorHandler::addError("Ugyldig Epost");
    $result=true;   //Ugyldig epost adresse 
} 
return  $result;
}
  


  


}
