
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sign Up Forms</title>
</head>
<body>
<div class="header">
       
    </div>
    <div class="form-container">
    <!-- Employer sign Up Form -->
    <form id="signupForm" action="../include/empSignup.inc.php" method="post">
        <h2>Lag ny bruker</h2>
        <p>Har du allerede konto? <a href="empLoginView.php">Arbeidsgiver logg inn her</a></p>
        <label for="firstName">Fornavn:<font color="red">*</font></label>
        <input type="text" id="firstName" name="firstName">

        <label for="lastName">Etternavn:<font color="red">*</font></label>
        <input type="text" id="lastName" name="lastName">

        <label for="email">E-mail:<font color="red">*</font></label>
        <input type="text" id="email" name="email">

        <label for="OrgName">Organisasjonsnavn:<font color="red">*</font></label>
        <input type="text" id="OrgName" name="OrgName">

        <label for="OrgNumber">Organisasjonsnummer:<font color="red">*</font></label>
        <input type="text" id="OrgNumber" name="OrgNumber">

 <!-- Dropdown for byer i Vest-Agder -->
      <label for="selectCity">City (Vest-Agder):<font color="red">*</font></label>
            <select id="selectCity" name="city">
            <?php
            $locations=getAllLocation($pdo);
    if ($locations) {
        foreach ($locations as $location) {
            echo '<option value="' . $location->locationID . '">' . $location->locationName . '</option>';
        }
    } else {
        echo '<option value="" disabled>ingen lokasjoner tilgjengelig</option>';
    }
    ?>
            </select>

        <label for="password">Lag passord:<font color="red">*</font></label>
        <input type="password" id="password" name="password">

        <label for="cpassword">Bekreft passord:<font color="red">*</font></label>
        <input type="password" id="cpassword" name="cpassword">

        <button type="submit" name="submit" value="submit" class="standardButton">Sign Up</button>
    </form>
    </div>
    <p>Har du allerede konto? <a href="empLogin.php">Arbeidsgiver logg inn her</a></p>
</body>
</html>