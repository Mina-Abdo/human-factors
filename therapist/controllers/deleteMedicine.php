<?php
// Start session and include the database connection
session_start();
require_once '../../assets/inc/dbconn.inc.php';

// Check if the request method is POST and the medicine_id is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['medicine_id'])) {

    // Sanitize the medicine ID
    $medicine_id = intval($_POST['medicine_id']);

    // Prepare the SQL DELETE query
    $delete_sql = "DELETE FROM Medication WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_sql);

    if ($stmt) {
        // Bind the medicine_id to the statement
        mysqli_stmt_bind_param($stmt, 'i', $medicine_id);

        // Execute the query
        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful, redirect to the patient's profile page
            header("Location: ../patientProfile.php");
            exit;
        } else {
            // If there was an issue executing the query
            echo "Error deleting record: " . mysqli_error($conn);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If there was an issue preparing the statement
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    // If the form was not submitted correctly, show an error message
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
