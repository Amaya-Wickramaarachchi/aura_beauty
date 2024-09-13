<?php
session_start();
require 'connection.php'; 

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
}

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$user_email = $_SESSION['user_email'];

try {
    $query = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, added_at) VALUES (?, ?, ?, NOW())");
    $query->bind_param("ssi", $user_email, $product_id, $quantity);
    
    //query
    if ($query->execute()) {
        $_SESSION['message'] = 'Product has been added to the cart!';
    } else {
        $_SESSION['message'] = 'There was an error adding the product to the cart.';
    }
    $query->close();
} catch (Exception $e) {
    $_SESSION['message'] = 'There was an error adding the product to the cart: ' . $e->getMessage();
}


header("Location: product.php?id=$product_id");
exit();
?>
