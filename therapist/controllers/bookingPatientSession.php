<?php
// Start session (if needed)
session_start();

// Include your database connection file
require_once "../../assets/inc/dbconn.inc.php";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if both user_id, appointment date, and time are set
    if (isset($_POST['user_id'], $_POST['appointment-date'], $_POST['appointment-time'])) {

        // Sanitize inputs
        $userId = intval($_POST['user_id']);
        $appointmentDate = mysqli_real_escape_string($conn, $_POST['appointment-date']);
        $appointmentTime = mysqli_real_escape_string($conn, $_POST['appointment-time']);

        // Combine date and time into one datetime string for MySQL (in 'Y-m-d H:i:s' format)
        $nextVisit = $appointmentDate . ' ' . $appointmentTime . ':00';

        // Update the user's next_visit field in the database
        $sql = "UPDATE User SET next_visit = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'si', $nextVisit, $userId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Appointment successfully booked.";
            // Redirect to a confirmation page or back to the profile page (optional)
            header("Location: ../therapistIndex.php?booking=success");
            exit;
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

    } else {
        echo "Please provide a valid date and time.";
    }

} else {
    echo "Invalid request.";
}
?>
