<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user_email'])) {
    header('Location: login.php'); 
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
    echo "Database connection failed: " . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input data
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $contact_number = htmlspecialchars(trim($_POST['contact_number']));
    $address = htmlspecialchars(trim($_POST['address']));
    $email = $_SESSION['user_email']; // Get the logged-in user's email from session

    if (empty($first_name) || empty($last_name) || empty($contact_number) || empty($address)) {
        echo "<script>alert('Please fill in all required fields.'); window.location.href='profile.php';</script>";
        exit();
    }

    $stmt = $pdo->prepare('UPDATE user SET first_name = ?, last_name = ?, birthday = ?, gender = ?, contact_number = ?, address = ? WHERE email = ?');
    
    if ($stmt->execute([$first_name, $last_name, $birthday, $gender, $contact_number, $address, $email])) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='profile.php';</script>";
    } else {
        echo "<script>alert('Error updating profile. Please try again.'); window.location.href='profile.php';</script>";
    }
} else {
    header('Location: profile.php');
    exit();
}
?>
