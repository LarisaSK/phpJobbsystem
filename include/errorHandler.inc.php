<?php

class ErrorHandler
{
    private static $errorsArray = [];

    public static function addError($errorMessage)
    {
        self::$errorsArray[] = $errorMessage;
    }

    public static function checkForError()
    {
        $hasErrors = !empty(self::$errorsArray);

        foreach (self::$errorsArray as $error) {
            echo "<p style='color: red;'>Error: $error</p>";
        }

        return $hasErrors;
    }
}
?>
