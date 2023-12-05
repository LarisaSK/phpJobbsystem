
<?php

class getExistingData {
    protected function getCVData($firstname, $lastname, $email) {
        try {
            $pdo = $this->dbConnection():

            $query = "SELECT firstname, lastname, email FROM job_applicant"
        }



        // Legg til databasekoden for å hente CV-data basert på brukerens ID
        // Bytte til riktig databasekobling
        $mysqli = new mysqli("localhost", "brukernavn", "passord", "database");
        $userId = $mysqli->real_escape_string($userId);

        $query = "SELECT fornavn, etternavn, epost, sted FROM cv_data WHERE user_id = $userId";
        $result = $mysqli->query($query);

        if ($result) {
            $cvData = $result->fetch_assoc();
            $result->free();
            $mysqli->close();
            return $cvData;
        } else {
            // Håndter feil her
            return null;
        }
    }
}
?>
