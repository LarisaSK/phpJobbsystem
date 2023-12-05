<?php

require_once "../controllers/jobPost.con.php";

// Check if the jobPostID is provided in the URL
if (isset($_GET['jobPostingID'])) {
    $jobPostID = $_GET['jobPostingID'];

    // Retrieve detailed job post information
    $detailedJobPostMethod = JobPost::DetailedJobPostById($jobPostID);

    // Check if the detailed job post information is available
    if ($detailedJobPostMethod) {
        // Display detailed job post information
        echo '<div class="job-post">';
        echo '<h2>' . $detailedJobPostMethod['jobTitle'] . '</h2>';
        echo '<p><strong>Bedrift:</strong> ' . $detailedJobPostMethod['companyName'] . '</p>';
        echo '<p><strong>Stilling:</strong> ' . $detailedJobPostMethod['positionName'] . '</p>';
        echo '<p><strong>Beskrivelse og kvalifikasjoner:</strong> <br>' . $detailedJobPostMethod['jobDescription'] . '</p>';
        echo '<p><strong>Annsettelsesform:</strong> ' . $detailedJobPostMethod['employmentType'] . '</p>';
        echo '<p><strong>Søkefrist:</strong> ' . $detailedJobPostMethod['deadline'] . '</p>';
        echo '<p><strong>Arbeidsstart:</strong> <br>' . $detailedJobPostMethod['startDate'] . '</p>';
        echo '<p><strong>By:</strong> ' . $detailedJobPostMethod['locationName'] . '</p>';
        echo '<p><strong>Gateadresse:</strong> ' . $detailedJobPostMethod['address'] . '</p>';
        echo '<input type="submit" value="Søk på stillingen" name="applyForJob">';
        echo '</form>';

        echo '</div>';
    } else {
        echo '<p>Kunne ikke finne annonse detaljer.</p>';
    }
} else {
    echo '<p>kunne ikke finne jobPostID.</p>';
}
?>
