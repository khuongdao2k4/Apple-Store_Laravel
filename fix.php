<?php

$file = 'resources/views/pages/login.blade.php';
$content = file_get_contents($file);

// Decoding ISO-8859-1 encoded UTF-8 string back to UTF-8
$decoded = utf8_decode($content);
file_put_contents($file, $decoded);
echo "Fixed login.blade.php\n";

// Done

