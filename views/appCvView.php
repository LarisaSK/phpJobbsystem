<?php 
include "../views/appTopnavView.inc.html"
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV-skjema</title>
</head>
<body>

<h2>CV-skjema</h2>

<form action="handle_cv.php" method="post">
    <label for="name">Navn:</label>
    <input type="text" name="name" required>

    <label for="email">E-post:</label>
    <input type="email" name="email" required>

    <label for="phone">Telefon:</label>
    <input type="tel" name="phone">

    <label for="education">Utdanning:</label>
    <textarea name="education" rows="4" required></textarea>

    <label for="experience">Arbeidserfaring:</label>
    <textarea name="experience" rows="4" required></textarea>

    <label for="skills">Ferdigheter:</label>
    <input type="text" name="skills" required>

    <input type="submit" value="Send CV">
</form>

</body>
</html>
