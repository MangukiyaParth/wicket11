<?php

$dir = '/var/www/html';

echo "<h2>Files in $dir:</h2>";
$files = scandir($dir);

foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<a href='$dir/$file'>$file</a><br>";
    }
}
$dir = '/var/www/html/vendor';

echo "<h2>Files in $dir:</h2>";
$files = scandir($dir);

foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<a href='$dir/$file'>$file</a><br>";
    }
}

// $uri = $_SERVER['REQUEST_URI'];
// $current_page = basename($_SERVER['PHP_SELF']);
// $ext = pathinfo(parse_url($uri, PHP_URL_PATH), PATHINFO_EXTENSION);
// $allowed_exts = ['js', 'css', 'png', 'jpg', 'jpeg', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'map'];

// if (in_array($ext, $allowed_exts)) {
//     return; // allow static file to pass through
// }

// session_start();

// if (!isset($_SESSION['user']) && $current_page != "login.php" && $current_page != "login") {
//     // header("Location: /login");
//     // exit;
// }

?>