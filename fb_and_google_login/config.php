<?php
require_once 'google-api/vendor/autoload.php';
$gClient = new Google_Client();
$gClient->setClientId("369092361112-k3jdk0h3b9avv6jnvn9vcc02gt5qot6v.apps.googleusercontent.com");
$gClient->setClientSecret("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");

$gClient->setApplicationName("Test");
$gClient->setRedirectUri("http://localhost/IPT101/fb_and_google_login/google-login.php");
$gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");
$login_url = $gClient->createAuthUrl();
?>