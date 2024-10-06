<?php
session_start();
// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['notes']) && isset($_SESSION['user_id']) && isset($_SESSION['therapist_id'])) {
    $userId = $_SESSION['user_id'];
    $therapistId = $_SESSION['therapist_id'];

    // Define the target directory to save the uploaded file
    $targetDirectory = __DIR__ . '/../../assets/docs/therapist/';
    
    // Get the original file name and generate a unique file name to avoid conflicts
    $fileName = basename($_FILES['notes']['name']);
    $targetFilePath = $targetDirectory . $fileName;

    // Check if the directory exists, if not, create it
    if (!is_dir($targetDirectory)) {
        mkdir($targetDirectory, 0755, true);
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($_FILES['notes']['tmp_name'], $targetFilePath)) {
        // File successfully uploaded, now insert file name into the notes table
        require_once "../../assets/inc/dbconn.inc.php"; // Ensure you have your DB connection file

        $sql = "INSERT INTO Notes (user, therapist, note) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'iis', $userId, $therapistId, $fileName);

        if (mysqli_stmt_execute($stmt)) {
            header("location: ../patientProfile.php");
            echo "<p>Notes file uploaded and saved successfully.</p>";
        } else {
            echo "Error saving file info in the database: " . mysqli_error($conn);
        }

        // Close the statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "There was an error uploading the file.";
    }
}else{
    echo "Error in sent data";
}
