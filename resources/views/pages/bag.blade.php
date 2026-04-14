@extends('layouts.app', ['pageTitle' => 'bag.php'])

@section('content')


<style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 0;
        padding: 0;
        background-color: white;
    
    .container1, .container2 {
        max-width: 80%;
        margin: 50px auto;
        background: white;
        padding: 30px;
    }
    .container1 {
        padding-top: 0px;
    }
    h1 {
        font-size: 28px;
        font-weight: bold;
    }
    p {
        color: #6e6e73;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .buttons {
        margin: 20px 0;
    }
    button {
        padding: 12px 20px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
    }
    .sign-in {
        background-color: #0071e3;
        color: white;
        margin-right: 10px;
    }
    .continue-shopping {
        background-color: white;
        color: #0071e3;
        border: 1px solid #0071e3;
    }
    .help-text {
        font-size: 14px;
    }
    .help-text a {
        color: #0071e3;
        text-decoration: none;
    }
    .order-item {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
        text-align: left;   
    }
    .order-item img {
        width: 230px;
        height: 140px;
        margin-right: 20px;
        border-radius: 5px;
    }
    .order-details {
        flex: 1;
    }
    .order-buttons {
        position: absolute;
        right: 150px;
        transform: translateY(-50%);
    }
    .order-buttons button {
        margin-left: 10px;
        padding: 8px 12px;
        font-size: 14px;
    }
    .delete-button {
        background-color: red;
        color: white;
    }
    .edit-button {
        background-color: orange;
        color: white;
    }

    .new-arrivals {
        display: flex;
        width: 980px;
        height: 400px;
        align-items: center;
        padding: 20px;
        background: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin: 0px auto;
    }
    .new-arrivals img {
        width: 100px;
        margin-right: 20px;
    }
    .shop-link {
        color: #0071e3;
        font-weight: bold;
        text-decoration: none;
    }
</style>

<div class="container1" style="margin-bottom: 20px; text-align: left; margin-left: 230px;">
<?php
    if (!isset($_SESSION['email'])) {
        echo '<h1 style="font-size:48px;">Your bag is empty.</h1>';
        echo '<p>Sign in to see if you have any saved items. Or continue shopping.</p>';
        echo '<div class="buttons">';
        echo '<button class="sign-in" style="width: 300px; border-radius: 20px;" onclick="location.href=\'login\'">Sign In</button>';
        echo '<button class="continue-shopping" style="width: 300px; border-radius: 20px;" onclick="location.href=\'mua-iphone\'">Continue Shopping</button>';
        echo '</div>';
    } else {
        $email = $_SESSION['email'];
        include_once '../app/config/database.php'; // Ensure database connection
        $query = "SELECT * FROM orders WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
           echo '<h1 style=" font-size: 48px">Your Bag</h1>';
           echo '<div class="buttons" style="padding-bottom:20px;">';
           echo '<button class="continue-shopping" style="width: 300px; border-radius: 20px;" onclick="location.href=\'mua-iphone\'">Continue Shopping</button>';
           echo '</div>';
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<div class="order-item">';
                echo '<img src="' . $row['image_url'] . '" alt="Product Image">';
                echo '<div class="order-details">';
                echo '<p><strong>Username:</strong> ' . $row['username'] . '</p>';
                echo '<p><strong>Product:</strong> ' . $row['product'] . '</p>';
                echo '<p><strong>Storage:</strong> ' . $row['storage'] . '</p>';
                echo '<p><strong>Color:</strong> ' . $row['color'] . '</p>';
                echo '<p><strong>Price:</strong> $' . $row['price'] . '</p>';
                echo '<p><strong>Ordered At:</strong> ' . $row['created_at'] . '</p>';
                echo '</div>';
                echo '<div class="order-buttons">';
                echo '<button class="delete-button" onclick="deleteOrder(' . $row['id_order'] . ')">Delete</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<h1 style="font-size:48px;">Your bag is empty.</h1>';
            echo '<p>Sign in to see if you have any saved items. Or continue shopping.</p>';
            echo '<div class="buttons">';
            echo '<button class="sign-in" style="width: 300px; border-radius: 20px;">Sign In</button>';
            echo '<button class="continue-shopping" style="width: 300px; border-radius: 20px;" onclick="location.href=\'mua-iphone\'">Continue Shopping</button>';
            echo '</div>';
        }
    }
    ?>
</div>

<div>
    <hr>
    <p class="help-text" style="font-size:20px; margin-left:-500px ;">Need some help? <a href="#">Chat now</a> or call 1-800-MY-APPLE.</p>
    <hr>
</div>

<div class="container2" style="margin-top: 5px;">
    <div class="new-arrivals" style="background-image: url(https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/apple-new-arrivals-checkout-201804?wid=980&hei=400&fmt=jpeg&qlt=95&.v=1523551959954)">
        <div style="padding-left:80px">
            <h2>New Arrivals</h2>
            <p>Check out the latest accessories.</p>
            <a href="#" class="shop-link" style="text-decoration: none;">Shop ></a>
        </div>
    </div>
</div>

<script>
    function deleteOrder(id_order) {
        if (confirm("Are you sure you want to delete this order?")) {
            window.location.href = "delete-order?id_order=" + id_order;
        }
    }
</script>



@endsection

