<?php
include "../include/session.inc.php";
include "../include/dbConfig.inc.php";
include "../classes/appLogin.class.php";
include "../include/checkErrors.inc.php";
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
    checkLoginErrors(); //kaller funksjonen som viser eventuelle feilmeldinger
    ?>
<div class="header">
       
    </div>
    <div class="form-container">
    <!-- Applicant login Form -->
    <form id="signupForm" action="../include/appLogin.inc.php" method="post">
        <h2>Jobbsøker Log inn</h2>
 <p>Jobbsøker registrering<a href="appSignupView.php"> her</a></p>
        <label for="email">E-mail:<font color="red">*</font></label>
        <input type="text" id="email" name="email">

        <label for="password">Passord:<font color="red">*</font></label>
        <input type="password" id="password" name="password">

        <button type="submit" name="submit" value="submit" class="standardButton">Sign Up</button>
    </form>
   
    </div>
</body>
</html>