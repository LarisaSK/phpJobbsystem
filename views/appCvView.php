<?php 
include "../views/appTopnavView.inc.html"
include "../classes/appCV.class.php"
include "../include/session.inc.php"
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

<?php foreach ($job_applicant as $applicantID)?>
<form action="appCV.con.php" method="post">
    <label for="firstname">Fornavn:</label>
    <input type="text" name="firstname" value="<?php echo $cvData['firstName']; ?>" required>

    <label for="lastname">Etternavn:</label>
    <input type="text" name="lastname"value="<?php echo $cvData['lastName']; ?>" required>

    <label for="email">E-post:</label>
    <input type="email" name="email" value="<?php echo $cvData['email']; ?>" required>

    <label for="phone">Telefon:</label>
    <input type="tel" name="phone" value="<?php echo $cvData['phoneNumber']; ?>">

    <label for="education">Utdanning:</label>
    <textarea name="education" rows="4" required></textarea>

    <label for="experience">Arbeidserfaring:</label>
    <textarea name="experience" rows="4" required></textarea>

    <label for="skills">Ferdigheter:</label>
    <input type="text" name="skills" required>

    <input type="submit" value="Lagre CV">
</form>
<?php endforeach; ?>

</body>
</html>
