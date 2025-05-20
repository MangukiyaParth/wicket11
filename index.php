<?php

session_start();

// Define an array of file extensions that should bypass authentication
$allowed_extensions = ['css', 'js', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'map'];

// Extract the requested URI and its extension
$request_uri = $_SERVER['REQUEST_URI'];
$extension = pathinfo(parse_url($request_uri, PHP_URL_PATH), PATHINFO_EXTENSION);

// If the requested file is not a static asset and the user is not authenticated, redirect to login
if (!in_array($extension, $allowed_extensions) && !isset($_SESSION['user'])) {
    header("Location: /login");
    exit;
}
?>