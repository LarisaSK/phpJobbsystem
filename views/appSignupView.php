<?php
include "../include/session.inc.php";
include "../include/dbConfig.inc.php";
include "../classes/appSignup.class.php";
require_once "../include/checkErrors.inc.php";
$appSignup = new appSignup();

// Gi tilbakemelding dersom brukeren ble registrert (session[signup_success]=== true)
if (isset($_SESSION["signup_success"]) && $_SESSION["signup_success"] === true) {
    echo '<p>Vellykket registrering! Vennligst logg inn.</p>';
    unset($_SESSION["signup_success"]); // Clear the success flag
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sign Up Forms</title>
</head>
<body>
<?php
    checkSignupErrors();
    ?>
<div class="header">
       
    </div>
    <div class="form-container">
    <!-- Employer sign Up Form -->

    <form id="signupForm" action="../include/appSignup.con.php" method="post">

        <h2>Jobbsøker registrering</h2> <a href="empLoginView.php"> Er du arbeidsgiver?</a>
         <p>Jobbsøker Login<a href="appLoginView.php"> her</a></p> 
        <label for="firstName">Fornavn:<font color="red">*</font></label>
        <input type="text" id="firstName" name="firstName">

        <label for="lastName">Etternavn:<font color="red">*</font></label>
        <input type="text" id="lastName" name="lastName">

        <label for="email">E-mail:<font color="red">*</font></label>
        <input type="text" id="email" name="email">

 
        <label for="password">Lag passord:<font color="red">*</font></label>
        <input type="password" id="password" name="password">

        <label for="cpassword">Bekreft passord:<font color="red">*</font></label>
        <input type="password" id="cpassword" name="cpassword">

        <!-- Dropdown for byer i Vest-Agder -->
      
 <label for="selectCity">City (Vest-Agder):<font color="red">*</font></label>
            <select id="selectCity" name="city">
            <?php
                $locations = $appSignup->getAllLocation();
                if ($locations) {
                    foreach ($locations as $location) {
                        echo '<option value="' . $location->locationID . '">' . $location->locationName . '</option>';
                    }
                } else {
                    echo '<option value="" disabled>No locations available</option>';
                }
                ?>
            </select>
           
            <button type="submit" name="submit" value="submit" class="standardButton">Sign Up</button>
    </form>
    </div>
</body>
</html>