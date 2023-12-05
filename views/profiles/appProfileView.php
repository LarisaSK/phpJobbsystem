<?php


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
</head>
<body>

    <div class="form-container">
    <form id="signupForm" action="../../controllers/user.con.php" method="post">

        <label for="firstName">Fornavn:<font color="red">*</font></label>
        <input type="text" id="firstName" name="firstName">

        <label for="lastName">Etternavn:<font color="red">*</font></label>
        <input type="text" id="lastName" name="lastName">

 <label for="description">Fortell om  erfaring:<font color="red">*</font></label>
        <input type="text" id="description" name="description">

               <!-- Dropdown for skills -->
<label for="selectSkill">Ferdigheter:<font color="red">*</font></label>
<select id="selectSkill" name="skill">
    <?php
    $skills = $user::getAllSkills(); //fyller dropdown med skills fra databasen
    if ($skills) {
        foreach ($skills as $skill) {
            // Include the missing closing angle bracket and use skillName as both value and displayed text
            echo '<option value="' . $skill->skillName . '">' . $skill->skillName . '</option>';
        }
    } else {
        echo '<option value="" disabled>Ingen ferdigheter tilgjengelig</option>';
    }
    ?>
</select>
           

        <label for="email">E-mail:<font color="red">*</font></label>
        <input type="text" id="email" name="email">

 
        <label for="phoneNumber">Mobilnummer:<font color="red">*</font></label>
        <input type="text" id="phoneNumber" name="phoneNumber">

       
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