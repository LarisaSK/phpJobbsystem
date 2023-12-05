<?php

class ErrorHandler
{
    // En statisk variabel som lagrer feilmeldinger
    private static $errorsArray = [];

    // Når denne funksjonen blir kalt 
    //legges det til en feilmelding i arrorsArray
    public static function addError($errorMessage)
    {
        self::$errorsArray[] = $errorMessage;
    }
// Denne funksjonen sjekker om det finnes noen feil
//i errorsArray og gir tilbakemelding om det
    public static function checkForError()
    {
        $hasErrors = !empty(self::$errorsArray);
// Går gjennom errorsArray og skriver ut hver feilmelding i rødt
        foreach (self::$errorsArray as $error) {
            echo "<p style='color: red;'>Error: $error</p>";
        }

        return $hasErrors;
    }
}
?>
