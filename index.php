<?php
session_start();
include "db.php";

if (isset($_POST['username']) && isset($_POST['password'])) { 
    //validate user input
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Validate username and password
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    //Check if the username is empty.
    if (empty($username)) {
        header("Location: Loginform.php?error=Username is required");
        exit();
    //Check if the password is empty
    } else if (empty($password)) {
        header("Location: Loginform.php?error=Password is required");
        exit();
    } else {  
        //Query the database to check if the username and password match in the user table
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        //If user input matches in the user table, log in the user and redirect to the home page
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result); 
            if ($row['verified'] == 0) {
                // User is not verified, redirect with an error message
                header("Location: loginform.php?error=Please verify your email first. Check your email for the verification link.");
                exit(); 
            }
            $Active = 'Online';
            $sql_active = "UPDATE user SET Active = '$Active' WHERE username = '$username'";
            mysqli_query($conn, $sql_active);

            if ($row['username'] === $username && $row['password'] === $password) {
                echo "Logged in!";
                $_SESSION['username'] = $row['username'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['user_id'] = $row['user_id'];
                header("Location: dashboard.php");
                exit();
            } else {
                //Redirect to the loginform with an error message
                header("Location: Loginform.php?error=Incorrect Username or password");
                exit();
            }
        } else {
            //Query the database to check if the full name and password match in the students table
            $sql_student = "SELECT * FROM students WHERE full_name='$username' AND password='$password'";
            $result_student = mysqli_query($conn, $sql_student);

            //If student input matches, check their enrollment status
            if (mysqli_num_rows($result_student) === 1) {
                $row_student = mysqli_fetch_assoc($result_student);

                // Check if the student is enrolled, and their status is neither pending nor declined
                if ($row_student['status'] === 'enrolled') {
                    if ($row_student['full_name'] === $username && $row_student['password'] === $password) {
                        echo "Logged in as student!";
                        $_SESSION['username'] = $row_student['full_name'];
                        $_SESSION['name'] = $row_student['name'];
                        $_SESSION['user_id'] = $row_student['user_id'];
                        header("Location: index-student/student_dashboard.php");
                        exit();
                    } else {
                        //Redirect to the loginform with an error message
                        header("Location: Loginform.php?error=Incorrect Full Name or password");
                        exit();
                    }
                } else {
                    // If student is not enrolled, pending, or declined, redirect with an appropriate error message
                    header("Location: Loginform.php?error=Your registration is pending, declined, or not yet enrolled. Please contact admin.");
                    exit();
                }
            } else {
                //Redirect to the loginform with an error message 
                header("Location: Loginform.php?error=Incorrect Username or password");
                exit();
            }
        }
    }
} else {
    //Redirect to the loginform if username and password are not set.
    header("Location: Loginform.php");
    exit();
}
?>
