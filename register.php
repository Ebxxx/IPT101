<?php
//connection from the database
include "db.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer autoload file
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

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
if (empty($username)) {
    header("Location: registrationform.php?error=Add username.");
    exit();
}

if (empty($password)) {
     header("Location: registrationform.php?error=add password ");
    exit();
}

if(empty($last_name)) {
    header("Location: registrationform.php?error=Complete the following requirements.");
    exit();
}
if(empty($first_name)) {
    header("Location: registrationform.php?error=Complete the following requirements.");
    exit();
}
if(empty($middle_name)) {
    header("Location: registrationform.php?error=Complete the following requirements.");
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


//Generate verification code
$verification_code = md5(uniqid(rand(), true));

// Insert user input into the database  
$sql = "INSERT INTO user (username, password, Last_name, First_name, Middle_name, Email, Status, Active,verification_code)
 VALUES ('$username','$password','$last_name','$first_name','$middle_name','$Email','$Status','$Active','$verification_code')";

// Executing the SQL query
if(mysqli_query($conn, $sql)){
    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'itsebs758@gmail.com';  // SMTP username
        $mail->Password = 'uwah cfom oymb brza';  // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          // Enable TLS encryption
        $mail->Port = 465;                  // TCP port to connect to

        // Email content
        $mail->setFrom('itsebs758@gmail.com');
        $mail->addAddress($Email);
        $mail->isHTML(true);
        $mail->Subject = 'Email Verification';
        $mail->Body = 'Please click the "verify" link to verify your email: <a href="http://localhost/IPT101/verification.php?email='.$Email.'&code='.$verification_code.'">Verify</a>';

        // Send email
        $mail->send();
        header("Location: register_compt.php?message=Verification email sent. Please check your email to verify your account.");
    } catch (Exception $e) {
        header("Location: registrationform.php?error=Failed to send verification email. Please try again later.");
    }
} else {
    echo "ERROR: Hush! Sorry $sql. " . mysqli_error($conn);
}

// Closing the database connection
mysqli_close($conn);
?>