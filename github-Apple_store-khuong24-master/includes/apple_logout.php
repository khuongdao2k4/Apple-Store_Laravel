<?php
session_start();
session_destroy();
header("Location: apple_home.php"); // Điều hướng về trang chủ sau khi đăng xuất
exit();
?>