<?php
session_start();

// Check if user ID and needs_followup are set
// if (isset($_POST['user_id']) && isset($_POST['needs_followup'])) {
//     // Sanitize inputs
//     $user_id = intval($_POST['user_id']);
//     $needs_followup = intval($_POST['needs_followup']); // 0 or 1

//     // Include the database connection
//     require_once "../inc/dbconn.inc.php";

//     // Prepare the update query
//     $sql = "UPDATE User SET needs_followup = ? WHERE id = ?";
//     $stmt = mysqli_prepare($conn, $sql);
//     mysqli_stmt_bind_param($stmt, 'ii', $needs_followup, $user_id);

//     // Execute the query
//     if (mysqli_stmt_execute($stmt)) {
//         echo "User follow-up status updated successfully.";
//     } else {
//         echo "Error: " . mysqli_error($conn);
//     }

//     // Close the statement and connection
//     mysqli_stmt_close($stmt);
//     mysqli_close($conn);
// } else {
//     echo "Invalid request.";
// }
if (isset($_POST['user_id']) && isset($_POST['needs_followup'])) {
    // Sanitize inputs
    $user_id = intval($_POST['user_id']);
    $needs_followup = intval($_POST['needs_followup']); // 0 or 1

    // Include the database connection
    require_once "../inc/dbconn.inc.php";

    // Prepare the update query
    $sql = "UPDATE User SET needs_followup = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $needs_followup, $user_id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        echo "User follow-up status updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request.";
}
?>
