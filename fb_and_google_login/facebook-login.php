<?php
// Start the session to manage user sessions
session_start();

// Include Facebook OAuth configuration and database connection
require_once 'facebook-oauth.php'; // Contains Facebook OAuth settings
require_once '../db.php'; // Establishes the database connection

// Check if the OAuth code parameter exists and is valid
if (isset($_GET['code']) && !empty($_GET['code'])) {
    // Set parameters for the access token request
    $params = [
        'client_id' => $facebook_oauth_app_id,
        'client_secret' => $facebook_oauth_app_secret,
        'redirect_uri' => $facebook_oauth_redirect_uri,
        'code' => $_GET['code']
    ];

    // Initialize cURL session for access token request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/oauth/access_token');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response, true);

    // Check if the access token is received
    if (isset($response['access_token'])) {
        $access_token = $response['access_token'];

        // Initialize cURL session to get user profile data
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://graph.facebook.com/me?fields=id,name,email,picture&access_token=' . $access_token);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $user_data = curl_exec($ch);
        curl_close($ch);
        $user_data = json_decode($user_data, true);

        // Extract user data
        $email = $user_data['email'];
        $name = $user_data['name'];
        $profile_picture = $user_data['picture']['data']['url'];

        // Check if the user already exists in the database
        $check_user_query = "SELECT * FROM user WHERE Email = '$email'";
        $check_user_result = mysqli_query($conn, $check_user_query);

        if (mysqli_num_rows($check_user_result) > 0) {
            // User exists, log them in
            $user_row = mysqli_fetch_assoc($check_user_result);
            $_SESSION['user_id'] = $user_row['user_id'];
            $_SESSION['username'] = $user_row['username'];

            // Update the 'Active' column to 'Online' and set verified to 1 for the logged-in user
            $active = 'Online';
            $update_active_query = "UPDATE user SET Active = '$active', verified = 1 WHERE user_id = " . $user_row['user_id'];
            mysqli_query($conn, $update_active_query);

            // Redirect to the dashboard after login
            header("Location: ../dashboard.php");
            exit;
        } else {
            // User doesn't exist, create a new account
            $username = $name;
            $password = 'admin'; // Default password (consider hashing in real applications)

            // Insert new user into the 'user' table
            $insert_query = "INSERT INTO user (username, password, First_name, Last_name, Email) 
                            VALUES ('$username', '$password', '', '', '$email')";
            if (mysqli_query($conn, $insert_query)) {
                // Get the ID of the newly inserted user
                $user_id = mysqli_insert_id($conn);
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;

                $random_phone = NULL;
                $social_media = NULL;

                // Insert new user's profile into the 'user_profile' table
                $insert_profile_query = $conn->prepare("INSERT INTO user_profile (user_id, phone_number, social_media) VALUES (?, ?, ?)");
                $insert_profile_query->bind_param("iss", $user_id, $random_phone, $social_media);
                $insert_profile_query->execute();

                // Redirect the new user to the dashboard
                header("Location: ../dashboard.php");
                exit;
            } else {
                // Handle errors during user insertion
                echo "Error: " . mysqli_error($conn);
            }
        }
    } else {
        // Handle errors in the access token response
        echo 'Error: ' . $response['error']['message'];
    }
} else {
    // If no OAuth code is present, redirect to Facebook OAuth page
    $params = [
        'client_id' => $facebook_oauth_app_id,
        'redirect_uri' => $facebook_oauth_redirect_uri,
        'response_type' => 'code',
        'scope' => 'email'
    ];
    header('Location: https://www.facebook.com/' . $facebook_oauth_version . '/dialog/oauth?' . http_build_query($params));
    exit;
}
?>
