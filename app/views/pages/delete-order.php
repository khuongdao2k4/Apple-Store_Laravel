<?php
$pageTitle = "delete-order.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<?php
session_start();


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
        echo "<script>alert('Order deleted successfully.'); window.location.href='bag';</script>";
    } else {
        echo "<script>alert('Failed to delete order.'); window.location.href='bag';</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<?php
require_once '../app/views/layouts/footer.php';
?>
