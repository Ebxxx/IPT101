<?php
session_start();
include '../db.php';

if (isset($_POST['add_subject'])) {
    $subject_name = mysqli_real_escape_string($conn, $_POST['subject']);
    $userId = $_SESSION['user_id'];

    if (empty($subject_name)) {
        header("Location: student_dashboard.php?error=Subject name cannot be empty");
        exit();
    } else {
        $query = "INSERT INTO subjects (user_id, subject_name) VALUES ('$userId', '$subject_name')";
        if (mysqli_query($conn, $query)) {
            header("Location: student_dashboard.php?success=Subject added successfully");
            exit();
        } else {
            header("Location: student_dashboard.php?error=Error: " . mysqli_error($conn));
            exit();
        }
    }
} else {
    header("Location: student_dashboard.php");
    exit();
}
?>
