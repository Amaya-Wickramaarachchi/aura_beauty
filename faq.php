<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Aura Beauty</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic" rel="stylesheet" />
    <style>
        body {
            font-family: Lato, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            margin-top:180px;
            background-color: #faf6f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #6f0936;
            margin-bottom: 20px;
            text-align: center;
        }

        .faq {
            margin-bottom: 20px;
        }

        .faq h2 {
            font-size: 18px;
            color: #6f0936;
            margin-bottom: 10px;
        }

        .faq p {
            font-size: 16px;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Frequently Asked Questions</h1>

        <div class="faq">
            <h2>What is Aura Beauty?</h2>
            <p>Aura Beauty is your go-to source for quality cosmetics and skincare products. We offer a wide range of beauty products to cater to your skincare and cosmetic needs.</p>
        </div>

        <div class="faq">
            <h2>How can I place an order?</h2>
            <p>To place an order, simply browse our products, add the items you wish to purchase to your cart, and proceed to checkout. You will be prompted to enter your shipping and payment information before confirming your order.</p>
        </div>

        <div class="faq">
            <h2>What payment methods are accepted?</h2>
            <p>We accept various payment methods, including credit/debit cards and PayPal. You can choose your preferred payment method during the checkout process.</p>
        </div>

        <div class="faq">
            <h2>Can I return a product?</h2>
            <p>Yes, we offer a return policy for products that are unused and in their original packaging. Please refer to our return policy on the website for more details on how to initiate a return.</p>
        </div>

        <div class="faq">
            <h2>How do I contact customer support?</h2>
            <p>You can contact our customer support team via the contact form on our website, or by emailing us at support@aurabeauty.com. We aim to respond to all inquiries within 24 hours.</p>
        </div>

    </div>
</body>
<?php include 'footer.php'; ?>

</html>
