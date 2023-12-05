<?php
require_once "../include/dbConfig.inc.php";
   require_once "../classes/jobPost.class.php"; 
   require_once "../classes/appSignup.class.php"; 
   require_once "../controllers/jobPost.con.php";
   
   //her lager jeg et objekt av appSignup class for
   //for å få brukt getAllLocation metoden den sin
   $appSignup = new appSignup();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jobbannonseutlysning</title>
    <style>
        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <h1>Legg ut jobbannonse</h1>

    

    <form action="../controllers/jobPost.con.php" method="post">
        <!-- Tittel på utlysningen -->
        <label for="jobTitle">Tittel på utlysningen:</label>
        <input type="text" id="jobTitle" name="jobTitle" novalidate>
 
        <!-- Navn på bedrift -->
        <label for="companyName">Bedriftens navn:</label>
        <input type="text" id="companyName" name="companyName" novalidate>
       
        <!-- Navn på stilling -->
        <div>
        <label for="positionName">Navn på stilling:</label>
       <select id="selectPositionName" name="positionName">
       <?php
        $positions = jobPost::getAllJobPositions(); // Call the method and capture the positions

        if ($positions) {
            foreach ($positions as $position) {
                echo '<option value="' . $position->positionName . '">' . $position->positionName . '</option>';
            }
        } else {
            echo '<option value="" disabled>ingen stillinger tilgjengelig</option>';
        }
        ?>

       </select>
    </div>
        
        <!-- Beskrivelse -->
        <label for="jobDescription">Beskrivelse (maksimum 2000 tegn):</label>
        <textarea id="jobDescription" name="jobDescription" rows="4" maxlength="2000" novalidate></textarea>

        <!-- Ansettelsesform -->
        <label for="employmentType">Ansettelsesform:</label>
        <div>
        <select id="employmentType" name="employmentType" novalidate>
        <option value="Fulltid">Fulltid</option>
        <option value="Deltid">Deltid</option>
    </select>
        </div>

        <!-- Frist -->
        <label for="deadline">Frist:</label>
        <input type="date" id="deadline" name="deadline" novalidate>

        <!-- Startdato -->
        <label for="startDate">Startdato:</label>
        <input type="date" id="startDate" name="startDate" novalidate>

        <!-- Adresse -->
        <label for="city">By:</label>
        <div>
        <select id="city" name="city" novalidate>
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
    </div>

        <label for="address">Gateadresse:</label>
        <input type="text" id="address" name="address" novalidate>
        <br>
        <input type="submit" value="Legg ut annonse" name="publishJobPost">
    </form>

</body>

</html>
