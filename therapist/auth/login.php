<?php
session_start();
require_once '../../assets/inc/dbconn.inc.php';  // Include your DB connection file
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    // Basic validation to check if the form fields are not empty
    if (empty($email) || empty($password)) {
        echo "Please fill in both email and password.";
        exit;
    }

    // Prepare SQL query to select the therapist record with the matching email
    $sql = "SELECT id, name, password FROM Therapist WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // If a record is found, verify the password
    if ($row = mysqli_fetch_assoc($result)) {
        // Assuming that the passwords are stored hashed in the database
        if ($password == $row['password']) {  // Verify the password

            // Login successful, store therapist ID and name in session
            $_SESSION['therapist_id'] = $row['id'];
            $_SESSION['therapist_name'] = $row['name'];

            // Redirect to therapist dashboard or home page
            header("Location: ../therapistIndex.php");
            exit;
        } else {
            // Password is incorrect
            echo "Invalid email or password.";
        }
    } else {
        // No record found with that email
        echo "Invalid email or password.";
    }

    // Close the database connection and statement
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
// print_r($_SESSION);  // Debug to check the session data

?>
