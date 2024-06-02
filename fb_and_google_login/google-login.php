<?php
// Start the session to manage user sessions
session_start();

// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the required configuration and database connection files
require_once 'config.php'; // Contains configuration settings
require_once '../db.php'; // Establishes the database connection
require_once 'google-api/vendor/autoload.php'; // Loads the Google API client

// Initialize the Google Client with credentials and settings
$gClient = new Google_Client();
$gClient->setClientId("369092361112-k3jdk0h3b9avv6jnvn9vcc02gt5qot6v.apps.googleusercontent.com");
$gClient->setClientSecret("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");
$gClient->setApplicationName("Test");
$gClient->setRedirectUri("http://localhost/IPT101/fb_and_google_login/google-login.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");

// Check if the OAuth 2.0 code is set in the URL after Google authentication
if (isset($_GET['code'])) {
    try {
        // Exchange the authorization code for an access token
        $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
        if (isset($token['error'])) {
            // Handle any errors during token fetching
            throw new Exception('Error fetching access token: ' . $token['error']);
        }

        // Set the access token in the Google Client
        $gClient->setAccessToken($token['access_token']);
        // Store the access token in the session
        $_SESSION['access_token'] = $token['access_token'];

        // Get user information from Google using the OAuth2 service
        $google_oauth = new Google_Service_Oauth2($gClient);
        $google_account_info = $google_oauth->userinfo_v2_me->get();
        $email = $google_account_info->email; // User's email
        $first_name = $google_account_info->givenName; // User's first name
        $last_name = $google_account_info->familyName; // User's last name
        $google_id = $google_account_info->id; // Google user ID
        $profile_picture = $google_account_info->picture; // Profile picture URL

        // Construct full name from first name and last name
        $fullname = "$last_name $first_name";

        // Prepare a query to check if the user already exists in the database
        $check_user_query = $conn->prepare("SELECT * FROM user WHERE Email = ?");
        $check_user_query->bind_param("s", $email);
        $check_user_query->execute();
        $check_user_result = $check_user_query->get_result();

        // If the user exists in the database
        if ($check_user_result->num_rows > 0) {
            // Fetch the user's information
            $user_row = $check_user_result->fetch_assoc();
            // Set session variables with user information
            $_SESSION['user_id'] = $user_row['user_id'];
            $_SESSION['username'] = $user_row['username'];

            // Set user status to 'Online' and verify the user
            $Active = 'Online';
            $update_active_query = $conn->prepare("UPDATE user SET Active = ?, verified = 1 WHERE user_id = ?");
            $update_active_query->bind_param("si", $Active, $user_row['user_id']);
            $update_active_query->execute();

            // Redirect the user to the dashboard
            header("Location: ../dashboard.php");
            exit;
        } else {
            // If the user does not exist, insert new user into the database
            $username = $first_name . $last_name;
            $password = 'admin'; // Default password (consider hashing in real applications)

            // Prepare an insert query to add the new user
            $insert_query = $conn->prepare("INSERT INTO user (username, password, First_name, Last_name, Email) VALUES (?, ?, ?, ?, ?)");
            $insert_query->bind_param("sssss", $username, $password, $first_name, $last_name, $email);
            
            if ($insert_query->execute()) {
                // Get the ID of the newly inserted user
                $user_id = $conn->insert_id;
                // Set session variables with new user information
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                $random_phone = NULL;
                $social_media = NULL;

                // Prepare an insert query to add the new user's profile
                $insert_profile_query = $conn->prepare("INSERT INTO user_profile (user_id, phone_number, full_name, social_media) VALUES (?, ?, ?, ?)");
                $insert_profile_query->bind_param("isss", $user_id, $random_phone, $fullname, $social_media);
                $insert_profile_query->execute();

                // Redirect the new user to the dashboard
                header("Location: ../dashboard.php");
                exit;
            } else {
                // Handle errors during the user insertion
                echo "Error: " . $insert_query->error;
            }
        }
    } catch (Exception $e) {
        // Catch and display any exceptions that occur
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
} else {
    // If no OAuth 2.0 code is present, redirect to Google authentication URL
    header("Location: " . $gClient->createAuthUrl());
    exit();
}
?>
