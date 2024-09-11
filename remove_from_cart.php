<?php
session_start();

if (!isset($_SESSION['user_email'])) {
    echo 'Unauthorized access';
    exit();
}

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
    echo 'Database connection failed';
    exit();
}

$user_email = $_SESSION['user_email'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $itemId = $_POST['item_id'];

    // Delete the item from the cart
    $removeStmt = $pdo->prepare('DELETE FROM cart WHERE id = ? AND user_id = ?');
    $removeStmt->execute([$itemId, $user_email]);

    if ($removeStmt->rowCount() > 0) {
        echo 'Item removed successfully';
    } else {
        echo 'Failed to remove item';
    }
}
?>
