<?php
echo "her skal listen over jobber være";
require_once "../controllers/jobPost.con.php";
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Postings</title>
    <!-- Add any additional styling or CSS links here -->
    <style>
        /* Add your custom styles here */
        .job-post {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?php
//refererer til $jobPostList i kontrolleren som inneholder jobPostList fra modellen
if ($jobPostList) {   
    foreach ($jobPostList as $jobPost) {
        // hver annonse puttes i sin egen div
        echo '<div class="job-post">';
        echo '<h2>' . $jobPost['jobTitle'] . '</h2>';
        echo '<p><strong>Stilling:</strong> ' . $jobPost['positionName'] . '</p>';
        echo '<p><strong>By:</strong> ' . $jobPost['locationName'] . '</p>';
        // Når jeg trykker denne lenken blir det sendt en GET-metode til jobPost kontrolleren
        // med postID parameteren
        echo '<a href="../views/detailedJobPostView.php?jobPostingID=' . $jobPost['jobPostingID'] . '">Se detaljer</a>';
        echo '</div>';
    }
}

?>

</body>
</html>
