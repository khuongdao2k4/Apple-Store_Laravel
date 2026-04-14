@extends('layouts.app', ['pageTitle' => 'delete-product.php'])

@section('content')


<?php
session_start();
 // Kết nối database

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Sản phẩm đã được xóa!'); window.location.href='mua-iphone';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>



@endsection

