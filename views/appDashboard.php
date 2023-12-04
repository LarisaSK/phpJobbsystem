
<?php 
include "../views/appTopnavView.inc.html"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">

    <title>Jobbannonser</title>
</head>
<body>
 <!--ikke ferdig-->
 
 <h1>Velg en ledig stilling</h1>

<form action="vis_stilling.php" method="post">
    <label for="stilling">Velg stilling:</label>
    <select name="stilling" id="stilling" required>
        <option value="webutvikler">Webutvikler</option>
        <option value="markedsforing">Markedsføringsansvarlig</option>
        <option value="prosjektleder">Prosjektleder</option>
    </select>
    <br>
    <input type="submit" value="Vis stilling">
</form>

</body>
</html>
