<?php
session_start();
include 'header.php';
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php');
    exit();
}

// Database connection
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

// Get selected items
$selectedItems = $_POST['selected_items'] ?? '';

if (empty($selectedItems)) {
    echo "No items were added to checkout.";
    exit();
}

$itemIds = explode(',', $selectedItems);

if (count($itemIds) > 0) {
    $placeholders = str_repeat('?,', count($itemIds) - 1) . '?'; 
    $stmt = $pdo->prepare("SELECT p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.id IN ($placeholders) AND c.user_id = ?");
    $stmt->execute(array_merge($itemIds, [$_SESSION['user_email']]));
    $checkoutItems = $stmt->fetchAll();
} else {
    $checkoutItems = [];
}

// Calculate total
$totalPrice = 0;
foreach ($checkoutItems as $item) {
    $totalPrice += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
            margin-top:150px;
        }
        h1 {
            text-align: center;
            color: #6f0936;
            margin-top: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            margin-bottom:20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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
            background-color: #f2f2f2;
        }
        .total {
            text-align: right;
            font-size: 20px;
            margin-bottom: 20px;
        }
        .checkout-button {
            width: 100%;
            padding: 10px;
            background-color: #6f0936;
            color: #fff;
            border: 1px solid #6f0936;
            border-radius: 0px;
            cursor: pointer;
            font-size: 12px;
            font-weight: bolder;
            transition: background-color 0.3s, color 0.3s;
        }

        .checkout-button:hover  {
            background-color: #f5eff4;
            color: #6f0936;
            border: 1px solid #6f0936;
        }
        
        .no-items {
            text-align: center;
            font-size: 18px;
            color: #888;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 15px;
            color: #6f0936;
            outline: none;
            font-size: 14px;
            background-color: #ffffff;
            border: 1px solid #ffffff;
            box-sizing: border-box;
            border-bottom: 1px solid #6f0936;
            margin-bottom: 15px;
        }
        @media (max-width: 600px) {
            h1 {
                font-size: 24px;
            }
            .container {
                padding: 15px;
            }
            .checkout-button {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<h1>Checkout</h1>

<div class="container">
    <?php if (count($checkoutItems) > 0): ?>
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
            <strong>Total: $<?php echo number_format($totalPrice, 2); ?></strong>
        </div>

        <form method="POST" action="place_order.php">
            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="form-group">
                <label for="contact">Contact Number</label>
                <input type="text" id="contact" name="contact" required>
            </div>
            <button type="submit" class="checkout-button">Place Order</button>
            <input type="hidden" name="selected_items" value="<?php echo htmlspecialchars($selectedItems); ?>">
            <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($totalPrice); ?>">
        </form>
    <?php else: ?>
        <p class="no-items">No items selected for checkout.</p>
    <?php endif; ?>
</div>

</body>
<?php include 'footer.php'; ?>
</html>
