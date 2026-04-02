<?php
session_start();

$chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
$captcha_code = '';
for ($i = 0; $i < 5; $i++) {
    $captcha_code .= $chars[rand(0, strlen($chars) - 1)];
}
$_SESSION['captcha_code'] = $captcha_code;

// Set header for true SVG
header('Content-Type: image/svg+xml; charset=utf-8');
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<svg width="130" height="42" viewBox="0 0 130 42" xmlns="http://www.w3.org/2000/svg">
    <!-- Nền xám nhạt -->
    <rect width="130" height="42" fill="#e8e8ed" rx="4" ry="4" />
    
    <!-- Pattern chấm nhiễu (noise) -->
    <defs>
        <pattern id="noise" x="0" y="0" width="4" height="4" patternUnits="userSpaceOnUse">
            <circle cx="2" cy="2" r="1" fill="#c0c0c8" />
        </pattern>
    </defs>
    <rect width="130" height="42" fill="url(#noise)" />

    <!-- Đường nhiễu xéo (lines) -->
    <?php
    for ($i = 0; $i < 8; $i++) {
        $x1 = rand(0, 130);
        $y1 = rand(0, 42);
        $x2 = rand(0, 130);
        $y2 = rand(0, 42);
        $thick = rand(1, 2);
        echo "<line x1='$x1' y1='$y1' x2='$x2' y2='$y2' stroke='#999' stroke-width='$thick' opacity='0.4' />\n";
    }
    ?>

    <!-- Ký tự CAPTCHA xoay nghiêng ngẫu nhiên -->
    <?php
    $x = 18;
    for ($i = 0; $i < 5; $i++) {
        $char = $captcha_code[$i];
        $y = rand(24, 30); // Random Y position
        $rot = rand(-20, 20); // Random rotation
        // Shadow for text depth
        echo "<text x='".($x+1)."' y='".($y+1)."' font-family='Arial, Helvetica, sans-serif' font-size='22' font-weight='bold' fill='#aaa' transform='rotate($rot, $x, $y)'>$char</text>\n";
        // Main text
        echo "<text x='$x' y='$y' font-family='Arial, Helvetica, sans-serif' font-size='22' font-weight='bold' fill='#1d1d1f' transform='rotate($rot, $x, $y)'>$char</text>\n";
        $x += 20; // Move to right
    }
    ?>
</svg>
