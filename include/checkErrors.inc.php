<?php

//Denne funksjonen sjekker om det finnes noen errors i error matrisen som
//ble laget i appSignup controlleren og eventuelt skriver dem ut. Funskjonen kalles
//i appliSigupView for å vise feilmeldingene til brukeren
 function checkSignupErrors(){

    if(isset($_SESSION["signup_errors"])){
        $errors= $_SESSION["signup_errors"];

echo "<br>";

foreach($errors as $error ){
echo "<p>". $error."</p>";
}

        unset($_SESSION["signup_errors"]);
    }
    else if(isset($_GET["signup"]) && $_GET["signup"] ==="success"){
echo "<br>";
echo "signup Success";


    }
  }

  //Denne funksjonen sjekker om det finnes noen errors i error matrisen som
//ble laget i appLogin controlleren og eventuelt skriver dem ut.
//Funskjonen kalles i appLoginView for å vise feilmeldingene til brukeren
  function checkLoginErrors(){
    if(isset($_SESSION["login_errors"])){
      $errors= $_SESSION["login_errors"];

echo "<br>";

foreach($errors as $error ){
echo "<p>". $error."</p>";
}

      unset($_SESSION["login_errors"]);
  }

  }
?>