<?php
// Start session and include DB connection
session_start();
require_once '../../assets/inc/dbconn.inc.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dose = mysqli_real_escape_string($conn, $_POST['dose']);
    $daily_intake = intval($_POST['daily-intake']);  // Integer type for daily intake
    $user_id = intval($_POST['user_id']);  // Assuming you're passing user_id along
    $therapist_id = intval($_POST['therapist_id']);
    echo $therapist_id;
    if($name && $dose && $daily_intake && $user_id && $therapist_id){
        // Insert the medicine into the Medication table
        $sql = "INSERT INTO Medication (medicine, dose, dose_per_day, user, therapist) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ssiii', $name, $dose, $daily_intake, $user_id, $therapist_id); // 'ssii' = string, string, integer, integer

        if (mysqli_stmt_execute($stmt)) {
            echo "Medicine added successfully.";
            header("Location: ../patientProfile.php?add_medicine=success");
            exit;
        } else {
            echo "Error adding medicine: " . mysqli_error($conn);
        }
    }else{
        echo "Data not sent correctly";
    }
    

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>