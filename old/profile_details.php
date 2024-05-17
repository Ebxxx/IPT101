<?php
session_start();

if (!isset($_SESSION['user_id'])) {  // Rely on $_SESSION['user_id']
    // Redirect to login page
    header("Location: loginform.php");
    exit();
  }

// Include database connection
include "db.php";

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];

// Fetch user details and set default values
$sql = "SELECT user.user_id, user.Email, user.user_id, user.First_name, user.Middle_name,
               user.Lastname, user_profile.phone_number, user_profile.address, user_profile.profile_picture 
        FROM user JOIN user_profile ON user.user_id = user_profile.user_id 
        WHERE user.user_id = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $user = mysqli_fetch_assoc($result);

  $default_profile_picture = 'default_profile_picture1.jpeg';
    $user['profile_picture'] = empty($user['profile_picture']) ? $default_profile_picture : $user['profile_picture'];
    
  // Set default values if phone number or address is empty
  $user['phone_number'] = isset($user['phone_number']) && !empty($user['phone_number']) ? $user['phone_number'] : 'No phone number added';
  $user['address'] = isset($user['address']) && !empty($user['address']) ? $user['address'] : 'No address added';
} else {
  // Handle error if user not found
  echo "Error: User not found!";
  exit();
}

?>
