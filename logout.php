
<?php
// logout.php file

session_start();

// Include the database connection file
include "db.php";

// Check if the session is set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Update the 'Active' column to 'Offline' when the user logs out
    $Active = 'Offline';
    $update_query = "UPDATE user SET Active = '$Active' WHERE user_id = $user_id";
    mysqli_query($conn, $update_query);

    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();
}

// Redirect to the login form
header("Location: Loginform.php");
exit();
?>