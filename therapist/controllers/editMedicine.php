<?php
// Start session and include DB connection
session_start();
require_once '../../assets/inc/dbconn.inc.php';

// Check if the form is submitted and the necessary data is present
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Sanitize input
    $medicine_id = $_SESSION['medicine_id']; // From hidden input
    $medicine_name = htmlspecialchars(trim($_POST['name']));
    $dose = htmlspecialchars(trim($_POST['dose']));
    $daily_intake = intval($_POST['daily-intake']);
    
    // Validate input
    if (!empty($medicine_name) && !empty($dose) && $daily_intake > 0) {
        
        // Prepare the SQL query to update the medication record
        $update_sql = "UPDATE Medication SET medicine = ?, dose = ?, dose_per_day = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $update_sql);
        
        if ($stmt) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'ssii', $medicine_name, $dose, $daily_intake, $medicine_id);
            
            // Execute the query
            if (mysqli_stmt_execute($stmt)) {
                // Success, redirect to the patient's profile page or a success page
                header("Location: ../patientProfile.php");
                exit;
            } else {
                // If something went wrong during execution
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Please fill out all required fields.";
    }
} else {
    // Redirect back or show an error if the form is not properly submitted
    echo "Invalid request.";
}

// Close the DB connection
mysqli_close($conn);
?>
