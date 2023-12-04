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

  


}
