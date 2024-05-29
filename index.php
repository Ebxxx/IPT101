
<?php
session_start();
include "db.php";


if (isset($_POST['username']) && isset($_POST['password'])) { 
    //validte user input
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
    }else if (empty($password)){
        header("Location: Loginform.php?error-password is required");
        exit();
    }else{  
        //Query the database to check if the username and password are match
        $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        //If user input are match, log in the user and redirect to the home page
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

            
            if ($row['username']  === $username && $row['password'] === $password) {
            echo "Logged in!";
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['user_id'] = $row['user_id'];
            header("Location: dashboard.php");
            exit();
        }else{
            //Redirect to the loginform with an error message
            header("Location: Loginform.php?error=Incorect Username or password");
            exit();
        }
    }else{
        //Redirect to the loginform with an error message 
        header("Location: Loginform.php?error=Incorect Username or password");
        exit();
    }
}
}else{
    //Redirect to the loginform if username and password are not set.
    header("Location: Loginform.php");
    exit();
}
?>