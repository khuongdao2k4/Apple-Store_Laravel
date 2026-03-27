<?php
session_start();
include '../config/DBconnect.php';

if (!isset($_SESSION['email'])) {
    echo "<script>alert('You need to sign in first.'); window.location.href='login.php';</script>";
    exit();
}

if (isset($_GET['id_order'])) {
    $id_order = intval($_GET['id_order']);
    $email = $_SESSION['email'];
    
    $query = "DELETE FROM orders WHERE id_order = ? AND email = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "is", $id_order, $email);
    
    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Order deleted successfully.'); window.location.href='apple_bag.php';</script>";
    } else {
        echo "<script>alert('Failed to delete order.'); window.location.href='apple_bag.php';</script>";
    }
    mysqli_stmt_close($stmt);
}
?>
