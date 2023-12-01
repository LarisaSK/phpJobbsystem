<?php

class Validator
{

  //denne funksjonen sjekker om noen input felt er tomme 
  public static function areEmptyFields($formFields)
  {
    
    $result = false;

    foreach ($formFields as $formField) {
      if (empty($formField)) {
        $result = true; // noen av feltene er tomme  
        break;
      }
    }
    return $result;
  }

  // validateFullName-funkjonen sjekker om navnet kun inneholder bokstaver
  public static function validateFullName($formFields)
  {
    $result = false;

    foreach ($formFields as $formField) {
      if (!preg_match('/^[a-zA-Z]+$/', $formField)) {
        $result = true;
        break;
      }
    }
    return   $result;
  }


  //validateEmail-funksjonen sjekker om email er fylt ut korrekt dersom det ikke er tomt
  public static function validateEmail($formFields)
  {
    $result = false;

    foreach ($formFields as $formField) {
      if (!empty($formField) && (!filter_var($formField, FILTER_VALIDATE_EMAIL) || !preg_match("/\.(com|no)$/", $formField))) {
        $result = true; //Ugyldig epost adresse 
        break;
      }
    }
    return  $result;
  }


  //validatePasswordLength sjekker om passord lengden er mindre enn 6 eller ikke 
  public static function validatePasswordLength($formFields)
  {
    $result = false;

    foreach ($formFields as $formField) {
      if (strlen($formField) < 6) {
        $result = true; // Passordet er for kort
        break;
      }
    }
    return $result; // Passordet er langt nok
  }


  //confimPassword- funksjonen sjekker at bruker-input i password og confirmpassword er like
  public static function confirmPassword($formFields)
  {
    $result = false;

    foreach ($formFields as $formField) {
      if ($formField !== $formField) {
        $result = true; // passordene er IKKE like 
      }
    }
    return $result; //passordene er like

  }
}
