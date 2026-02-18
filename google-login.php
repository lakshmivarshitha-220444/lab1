<?php
// Autoload Composer packages
require_once __DIR__ . "/vendor/autoload.php";

// Load .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Create Google Client
$client = new Google_Client();
$client->setClientId($_ENV['GOOGLE_CLIENT_ID']);
$client->setClientSecret($_ENV['GOOGLE_CLIENT_SECRET']);
$client->setRedirectUri($_ENV['GOOGLE_REDIRECT_URI']);
$client->addScope("email");
$client->addScope("profile");

// Generate Google Login URL
$login_url = $client->createAuthUrl();

// Redirect user to Google login
header("Location: " . $login_url);
exit();
?>
