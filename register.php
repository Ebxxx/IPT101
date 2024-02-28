<?php
//connection from the database
include "db.php";


//Get user input from the registartionform.php
$username = $_POST['username'];
$password = $_POST['password'];
$last_name = $_POST['Last_name'];
$first_name = $_POST['First_name'];
$middle_name = $_POST['Middle_name'];
$Email = $_POST['Email'];
$Status = $_POST['Status'];
$Active = isset($_POST['Active']) ? "Online" : "Offline";


// Validate email format
if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    // Redirect back to the registration form with an error message
    header("Location: registrationform.php?error=Invalid email format");
    exit;
}


//check if email is empty
if (empty($Email)) {
    header("Location: registrationform.php?error=Add email address.");
    exit();
}

// Check if email already exists in the database
$email_check_query = "SELECT * FROM user WHERE Email='$Email' LIMIT 1";
$result = mysqli_query($conn, $email_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { 
    header("Location: registrationform.php?error=Email already exists. Please try another one.");
    exit;
}

// Insert user input into the database
$sql = "INSERT INTO user (username, password, Last_name, First_name, Middle_name, Email, Status, Active)
 VALUES ('$username','$password','$last_name','$first_name','$middle_name','$Email','$Status','$Active')";

if(mysqli_query($conn, $sql)){
    header("Location: register_compt.php?message=Successfully Registered");
} else{
    echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
}

mysqli_close($conn);
?>