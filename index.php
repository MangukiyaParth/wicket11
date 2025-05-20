<?php

$dir = '';

echo "<h2>Files in $dir:</h2>";
$files = scandir($dir);

foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo "<a href='/$file'>$file</a><br>";
    }
}
?>