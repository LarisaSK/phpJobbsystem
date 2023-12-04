<?php
require_once "../classes/jobPost.class.php";  // Adjust the path to your jobPost class file

$jobPost = new jobPost();

try {
    // Trigger an exception by calling the method with an invalid query
    $positions = $jobPost->getAllJobPositions();

    // If no exception is thrown, you can handle the result or proceed with your logic
    echo "Positions retrieved successfully!";
} catch (Exception $e) {
    // If an exception is caught, display the error message to the user
    echo "Error: " . $e->getMessage();
}
?>
