<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
}

// Database connection (same as before)
$host = 'localhost';
$db = 'aura_beauty';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Retrieve posted data
$shippingAddress = $_POST['address'] ?? '';
$contactNumber = $_POST['contact'] ?? '';
$selectedItems = $_POST['selected_items'] ?? '';
$totalPrice = $_POST['total_price'] ?? 0;

// Check if selected items are present
$itemIds = explode(',', $selectedItems);
$checkoutItems = [];

// Fetch the details of the selected items from the database
if (!empty($itemIds[0])) { // Check if there's at least one item
    $placeholders = str_repeat('?,', count($itemIds) - 1) . '?';
    $stmt = $pdo->prepare("SELECT p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.id IN ($placeholders) AND c.user_id = ?");
    $stmt->execute(array_merge($itemIds, [$_SESSION['user_email']]));
    $checkoutItems = $stmt->fetchAll();
}

// Generate a unique tracking number
$trackingNumber = strtoupper(uniqid('TRACK-'));

// Insert order into the database
if (!empty($checkoutItems)) {
    $stmt = $pdo->prepare("INSERT INTO orders (user_email, shipping_address, contact_number, total_price, tracking_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_SESSION['user_email'], $shippingAddress, $contactNumber, $totalPrice, $trackingNumber]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            color: #6f0936;
            margin: 20px 0;
        }
        .container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s ease;
        }
        .container:hover {
            transform: scale(1.02);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table th, table td {
            padding: 15px;
            border: 1px solid #ddd;
            text-align: center;
        }
        table th {
            background-color: #6f0936;
            color: white;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total {
            text-align: right;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .tracking {
            text-align: center;
            font-size: 20px;
            margin: 20px 0;
            padding: 10px;
            border: 1px dashed #6f0936;
            border-radius: 5px;
            background-color: #f9f9f9;
            color: #6f0936;
        }
        .back-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #6f0936;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .back-button:hover {
            background-color: #f0936;
        }
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
            table th, table td {
                padding: 10px;
                font-size: 14px;
            }
            .total {
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Order Confirmation</h1>

    <?php if (!empty($checkoutItems)): ?>
        <h2>Items Ordered:</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($checkoutItems as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo htmlspecialchars(number_format($item['price'] * $item['quantity'], 2)); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="total">
            <strong>Total Price: $<?php echo number_format($totalPrice, 2); ?></strong>
        </div>
        <div class="tracking">
            <strong>Tracking Number: <?php echo $trackingNumber; ?></strong>
        </div>
        <h2>Shipping Details:</h2>
        <p><strong>Shipping Address:</strong> <?php echo htmlspecialchars($shippingAddress); ?></p>
        <p><strong>Contact Number:</strong> <?php echo htmlspecialchars($contactNumber); ?></p>
    <?php else: ?>
        <p>No items in your order.</p>
    <?php endif; ?>
    
    <a href="index.php" class="back-button">Back to Home</a>
</div>

</body>
</html>
