<?php
session_start();
include 'db.php';

$message = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['First_name'];
    $last_name = $_POST['Last_name'];
    $middle_name = $_POST['Middle_name'];
    // $email = $_POST['Email'];
    // $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];
    $social_media = $_POST['social_media'];
    $profile_picture = $_POST['profile_picture'];

    if (!empty($phone_number) && !preg_match('/^\d{11}$/', $phone_number)) {
        // Redirect back to the registration form with an error message
        header("Location: edit_profile.php?error=Invalid phone number format");
        exit;
    }

    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Redirect back to the registration form with an error message
        header("Location: edit_profile.php?error=Invalid email format");
        exit;
    }

    if (!empty($social_media) && !preg_match('/^(https?:\/\/)?(www\.)?(facebook\.com|twitter\.com|instagram\.com|linkedin\.com|youtube\.com|snapchat\.com)\/.+$/i', $social_media)) {
        // Redirect back to the registration form with an error message
        header("Location: edit_profile.php?error=Invalid social media URL");
        exit;
    }

       // Validate date of birth
    $current_date = date("Y-m-d");
    $min_age_date = date("Y-m-d", strtotime("-18 years"));

    if (!empty($date_of_birth)) {
        $dob_timestamp = strtotime($date_of_birth);
        $min_age_timestamp = strtotime($min_age_date);
        $current_timestamp = strtotime($current_date);

        if ($dob_timestamp > $current_timestamp) {
            // Redirect back to the registration form with an error message
            header("Location: edit_profile.php?error=Date of birth cannot be in the future");
            exit;
        }

        if ($dob_timestamp > $min_age_timestamp) {
            // Redirect back to the registration form with an error message
            header("Location: edit_profile.php?error=You must be at least 18 years old");
            exit;
        }
    }

    // Concatenate first name, middle name, and last name into full name
    $full_name = trim("$first_name $middle_name $last_name");

    // Update user profile information
    $query = "UPDATE user_profile SET Full_name='$full_name', phone_number='$phone_number', address='$address', date_of_birth='$date_of_birth', gender='$gender', social_media='$social_media', profile_picture='$profile_picture'";

 //    $sql = "INSERT INTO user (username, password, Last_name, First_name, Middle_name, Email, Status, verification_code)
 // VALUES ('$username','$password','$last_name','$first_name','$middle_name','$Email','$Status','$verification_code')";

    // Update user table
    $sql = "UPDATE user SET Last_name='$last_name', First_name='$first_name', Middle_name='$middle_name'";

    if(mysqli_query($conn, $sql) && mysqli_query($conn, $query)) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
