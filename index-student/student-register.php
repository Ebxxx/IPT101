<?php
include "../db.php";

// Retrieve form data
$last_name = $_POST['Last_name'];
$first_name = $_POST['First_name'];
$middle_name = $_POST['Middle_name'];
$email = $_POST['Email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$course = $_POST['course'];

// Check if the email already exists
$emailCheckQuery = "SELECT * FROM students WHERE email = ?";
$stmt = $conn->prepare($emailCheckQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email already exists
    $stmt->close();
    $conn->close();
    header("Location: student-registration-form.php?error=Email already exists");
    exit();
}

$full_name = trim("$last_name $first_name $middle_name");

// Insert data into database
$sql = "INSERT INTO students (full_name, Email, password, gender, course) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssss", $full_name, $email, $password, $gender, $course);

if ($stmt->execute()) {
    // Success
    header("Location: ../loginform.php?success=Registration successful");
} else {
    // Failure
    header("Location: student-registration-form.php?error=Registration failed");
}

// Close connections
$stmt->close();
$conn->close();
?>
