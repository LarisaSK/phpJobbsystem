<?php

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

        .header-box {
            background-color: #f0f0f0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        /* Style for the header links */
        .header-box a {
            margin-right: 100px; /* Adjust the value as needed */
            
            
        }
    </style>
</head>
<body>
<div class="header-box">
        <a href="./profiles/appProfileView.php">PROFIL</a>
        <a href="jobListingView.php">JOBBANNONSER</a>
</div>

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
