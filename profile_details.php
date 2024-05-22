<?php
// Include the database connection file
include 'db.php';

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // Fetch the user's profile information from the database
    $userId = $_SESSION['user_id'];
    $query = "SELECT * FROM user_profile WHERE user_id = $userId";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User profile not found";
    }
}
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $full_name = $row['First_name'] . ' ' . $row['Middle_name'] . ' ' . $row['Last_name'];
    // Display user information
}

// Close connection
mysqli_close($conn);
?>


