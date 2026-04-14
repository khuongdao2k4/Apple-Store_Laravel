@extends('layouts.app', ['pageTitle' => 'order-detail.php'])

@section('content')
@php
    $user_name = session('user_name', '');
    $email = session('email', '');
    $productName = request('name', '');
    $productPrice = request('price', '');
    $productStorage = request('storage', '');
    $productColor = request('color', '');
    $imageUrl = request('image_url', '');
@endphp


<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        align-items: center;
        height: 100vh;
        background-color: #f9f9f9;
        flex-direction: column;
    }

    .header-order {
        width: 100%;
        max-width: 68%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-top: 80px;
        margin-left: -80px;
        margin-right: -200px;
    }

    .header-order a {
        text-decoration: none;
        color: #007aff;
        font-size: 14px;
    }

    .main-container {
        display: flex;
        background: white;
        padding: 20px;
        width: 80%;
        border-radius: 20px;
        height: 75vh;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .info-section {
        width: 60%;
        padding-right: 20px;
        border-right: 1px solid #ccc;
        text-align: center;
    }

    .info-section img {
        width: 100%;
        height: auto;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .info-section img:hover {
        transform: scale(1.05);
    }

    .form-section {
        width: 40%;
        padding-left: 20px;
        text-align: center;
    }

    h2 {
        margin-bottom: 10px;
    }

    p {
        font-size: 14px;
        color: #666;
    }

    input {
        width: 80%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        transition: all 0.3s ease;
    }

    input:focus {
        border-color: #007aff;
        box-shadow: 0 0 5px rgba(0, 122, 255, 0.5);
    }

    .pay-button {
        width: 40%;
        padding: 10px;
        background: #007aff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .pay-button:hover {
        background: rgb(0, 0, 0);
        transform: scale(1.05);
    }

    .payment-options {
        margin-top: 30px;
        height: 50px;
        padding-bottom: 30px;
    }

    .payment-card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px 20px 5px 20px;
        text-align: center;
        background-color: #f8f9fa;
        justify-content: center;
        height: 80px;
        width: 50%;
        margin: 0 auto;
        padding-bottom: 20px !important;
    }
</style>

<div class="header-order">
    <h3>Apple Order Detail</h3>
    <div>
        <a href="#">Sign In</a> | <a href="#">FAQ</a>
    </div>
</div>

<div class="main-container">
    <div class="info-section">
        <img style="width:100%; height: 76%; padding-top: 20px;" src="<?= htmlspecialchars($imageUrl) ?>"
            alt="Product Image">

        <div class="payment-options">
            <div class="payment-card">
                <strong>Buy</strong>
                <p>Pay with Apple Pay or other payment methods.</p>
            </div>
        </div>
    </div>
    <div class="form-section">
        <h2 style="margin-top: 20px;">Information Order</h2>
        <p style="margin-bottom: 20px;">Display product information that user information.</p>

        <form action="process-order" method="POST">
            <input style="border-radius: 20px; text-align: center;" type="email" name="email"
                value="<?= htmlspecialchars($email) ?>" required readonly>
            <input style="border-radius: 20px; text-align: center;" type="text" name="username"
                value="<?= htmlspecialchars($user_name) ?>" required readonly>
            <input style="border-radius: 20px; text-align: center;" type="text" name="name"
                value="<?= htmlspecialchars($productName) ?>" required readonly>
            <input style="border-radius: 20px; text-align: center;" type="text" name="storage"
                value="<?= htmlspecialchars($productStorage) ?>" required readonly>
            <input style="border-radius: 20px; text-align: center;" type="text" name="color"
                value="<?= htmlspecialchars($productColor) ?>" required readonly>
            <input style="border-radius: 20px; text-align: center;" type="text" name="price"
                value="<?= htmlspecialchars($productPrice) ?>" required readonly>
            <input style="border-radius: 20px; text-align: center;" type="hidden" name="image_url"
                value="<?= htmlspecialchars($imageUrl) ?>">
            <button
                class="pay-button"
                style="border-radius: 20px; margin-top: 20px; width: 130px; background-color: #666; text-align: center;"
                type="submit">Thanh Toán</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector("button[type='submit']").addEventListener("click", function (event) {
            if (!confirm("Bạn có chắc chắn muốn thanh toán không?")) {
                event.preventDefault();
            }
        });
    });
</script>



@endsection

