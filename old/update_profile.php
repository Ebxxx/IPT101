<?php
session_start();
include 'db.php'; // Database connection file

// Check if the user is logged in
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Get the form data
    $firstname = isset($_POST['First_name']) && !empty($_POST['First_name']) ? $_POST['First_name'] : '';
    $middlename = isset($_POST['Middle_name']) && !empty($_POST['Middle_name']) ? $_POST['Middle_name'] : '';
    $lastname = isset($_POST['Last_name']) && !empty($_POST['Last_name']) ? $_POST['Last_name'] : '';
    $phone_number = isset($_POST['phone_number']) && !empty($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $address = isset($_POST['address']) && !empty($_POST['address']) ? $_POST['address'] : '';
    $username = isset($_POST['username']) && !empty($_POST['username']) ? $_POST['username'] : '';
    
    // $date_of_birth = isset$_POST(['date_of_birth']) && !empty($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';



    // Retrieve user inputs from the form
// $first_name = $_POST['First_name'];
// $last_name = $_POST['Last_name'];
// $middle_name = $_POST['Middle_name'];
// $email = $_POST['email'];
// $password = $_POST['password'];
// $phone_number = $_POST['phone_number'];
// $address = $_POST['address'];
// $date_of_birth = $_POST['date_of_birth'];
// $gender = $_POST['gender'];
// $social_media = $_POST['social_media'];


    $profile_picture = ''; // Initialize the $profile_picture variable
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture_size = $_FILES['profile_picture']['size'];
        $profile_picture_tmp_name = $_FILES['profile_picture']['tmp_name'];
        $profile_picture = 'uploads/' . $_FILES['profile_picture']['name'];

        if (!empty($profile_picture)) {
            if ($profile_picture_size > 2000000) {
                $message[] = 'Image is too large';
            } else {
                if (move_uploaded_file($profile_picture_tmp_name, $profile_picture)) {
                    $image_update_query = mysqli_query($conn, "UPDATE user_profile SET profile_picture = '$profile_picture' WHERE user_id = '$user_id'") or die('Query failed');
                    $message[] = 'Image updated successfully!';
                } else {
                    $message[] = 'Error uploading file!';
                }
            }
        }
    }

    // Update the users table
    $update_user_query = "UPDATE user SET First_name='$firstname', Middle_name='$middlename', Lastname='$lastname', username='$username' WHERE user_id=$user_id";
    if ($conn->query($update_user_query) === TRUE) {
        echo "User table updated successfully";
    } else {
        echo "Error updating user table: " . $conn->error;
    }

    // Update the user_profile table
    $sql = "UPDATE user_profile SET First_name='$firstname', Middle_name='$middlename', Last_name='$lastname', username='$username', phone_number='$phone_number', address='$address', profile_picture='$profile_picture' WHERE user_id=$user_id";
    if ($conn->query($sql) === TRUE) {
        echo "User profile table updated successfully";
    } else {
        echo "Error updating user profile table: " . $conn->error;
    }
}
$conn->close();
?>