<?php

require_once "../controllers/jobPost.con.php";

// // sjekker om jobPostingID for annonsen finnes i URL-en
if (isset($_GET['jobPostingID'])) {
    $jobPostID = $_GET['jobPostingID'];

    // kjører metoden for å hente detaljert jobbannonse
    $detailedJobPostMethod = JobPost::DetailedJobPostById($jobPostID);

    // sjekker om dataen ble returnert
    if ($detailedJobPostMethod) {
        // Viser detaljert data til jobbsøker
        echo '<div class="job-post">';
        echo '<form action="applyForJobPostView.php" method="post">';
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
