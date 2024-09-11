<?php
session_start();

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

// Get user's email
$user_email = $_SESSION['user_email'] ?? null;

// Fetch cart items for the user
$cartItems = [];
if ($user_email) {
    $stmt = $pdo->prepare('SELECT c.id, p.name, p.price, c.quantity FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = ?');
    $stmt->execute([$user_email]);
    $cartItems = $stmt->fetchAll();
}

// Function to calculate total price
function calculateTotal($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

$total = calculateTotal($cartItems);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin-top: 20px;
            padding: 20px;
            color: #333;
        }

        h1 {
            padding: 50px;
            margin-top: 120px;
            font-size: 2.5em;
            color: #6f0936; 
        }

        .cart-table {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            border-radius: 0px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-table th, .cart-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .cart-table th {
            background-color: #6f0936;
            color: white;
        }

        .cart-table tr:hover {
            background-color: #f1f1f1;
        }

        .checkout-button {
            width: 100%;
            max-width: 1200px;
            margin: 20px auto;
            margin-left:70px;
            padding: 10px 0;
            background-color: white;
            color: #6F0936;
            border: 1px solid #6F0936;
            border-radius: 0; 
            text-align: center;
            letter-spacing: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .checkout-button:hover {
            background-color: #6f0936;
            color: #f5eff4;
        }

        .total {
            font-weight: bold;
            font-size: 1.5em;
            text-align: right;
            margin-right: 70px;
            color: #6f0936;
        }

        .remove-icon {
            color: #6f0936;
            cursor: pointer;
            font-size: 1.5em;
            transition: color 0.3s;
        }

        .remove-icon:hover {
            color: #6f0936;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<h1>Your Cart</h1>
<form id="checkoutForm" method="POST" action="checkout.php">
    <input type="hidden" name="selected_items" id="selectedItems" value="">
    <table class="cart-table">
        <thead>
            <tr>
                <th>Select</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
    <?php if (count($cartItems) > 0): ?>
        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td>
                    <input type="checkbox" class="item-checkbox" data-price="<?php echo $item['price']; ?>" data-quantity="<?php echo $item['quantity']; ?>" value="<?php echo $item['id']; ?>" onchange="updateTotal()">
                </td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td>$<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" name="remove" style="border:none; background:none; padding:0;">
                        <i class="fas fa-trash remove-icon" title="Remove from cart" onclick="removeFromCart(<?php echo $item['id']; ?>)"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">Your cart is empty! <a href="products.php">Continue Shopping</a></td>
        </tr>
    <?php endif; ?>
</tbody>

    </table>

    <div class="total" id="totalPrice">Total: $<?php echo number_format($total, 2); ?></div>

    <button type="submit" class="checkout-button" onclick="prepareSelectedItems(event)">Checkout</button>
    </form>

<script>
    function updateTotal() {
    const checkboxes = document.querySelectorAll('.item-checkbox');
    let total = 0;
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const price = parseFloat(checkbox.getAttribute('data-price'));
            const quantity = parseInt(checkbox.getAttribute('data-quantity'));
            total += price * quantity;
        }
    });
    document.getElementById('totalPrice').innerText = 'Total: $' + total.toFixed(2);
}

function prepareSelectedItems(event) {
    const checkboxes = document.querySelectorAll('.item-checkbox:checked');
    const selectedIds = Array.from(checkboxes).map(checkbox => checkbox.value);

    if (selectedIds.length === 0) {
        event.preventDefault(); // Prevent form submission if no items are selected
        alert('No items selected for checkout!');
    } else {
        document.getElementById('selectedItems').value = selectedIds.join(','); // Set the selected item IDs
    }
}


function removeFromCart(itemId) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'remove_from_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
        if (xhr.status === 200 && xhr.responseText === 'Item removed successfully') {
            // Remove the item row from the table
            const row = document.getElementById(`item-${itemId}`);
            if (row) {
                row.remove();
                updateTotal(); // Recalculate the total
            }
        } else {
            alert('Error removing item.');
        }
    };
    xhr.send('item_id=' + itemId);
}

</script>

<?php include 'footer.php'; ?>

</body>
</html>
