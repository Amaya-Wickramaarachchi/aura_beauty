<?php
session_start();
require 'connection.php';

// Redirect to login if not authenticated
if (!isset($_SESSION['user_email'])) {
    header('Location: login.php'); 
    exit();
}

// Database connection settings
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

// Establish database connection
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Fetch user details from the database
$email = $_SESSION['user_email'];
$stmt = $pdo->prepare('SELECT first_name, last_name, birthday, gender, contact_number, address FROM user WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();

// Initialize message variable
$message = '';

// Handle profile update form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $contact_number = trim($_POST['contact_number']);
    $address = trim($_POST['address']);

    // Update user profile in the database
    $update_stmt = $pdo->prepare('UPDATE user SET first_name = ?, last_name = ?, birthday = ?, gender = ?, contact_number = ?, address = ? WHERE email = ?');
    
    if ($update_stmt->execute([$first_name, $last_name, $birthday, $gender, $contact_number, $address, $email])) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile. Please try again.";
    }
}

// Handle account deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_account'])) {
    $delete_stmt = $pdo->prepare('DELETE FROM user WHERE email = ?');
    if ($delete_stmt->execute([$email])) {
        session_destroy(); // Destroy the session after account deletion
        header('Location: goodbye.php'); // Redirect to a goodbye page
        exit();
    } else {
        $message = "Error deleting account. Please try again.";
    }
}

// Fetch user's order history
$order_stmt = $pdo->prepare('SELECT order_id, tracking_number, shipping_address, contact_number, total_price, created_at FROM orders WHERE user_email = ? ORDER BY created_at DESC');
$order_stmt->execute([$email]);
$orders = $order_stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <title>User Profile</title>
    <style>
          body {
            font-family: 'Lato', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        h1 {
            color: #6f0936; 
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-container {
            max-width: 80%;
            margin: 150px auto;
            padding: 20px;
            background-color: rgba(250, 246, 249, 1);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .profile-container:hover {
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 1.1em;
            color: #444;
        }
        input[type="text"],
        input[type="date"],
        input[type="tel"],
        textarea {
            width: 80%;
            padding: 15px;
            font-size: 14px;
            background-color: rgba(250, 246, 249, 1);
            border: 1px solid rgba(250, 246, 249, 1);
            border-bottom: 1px solid #6f0936;
            margin-bottom: 15px;
            outline: none;
            color: #6f0936;
            align-items:center;
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        input[type="tel"]:focus,
        textarea:focus {
            border-color: #6f0936;
        }
        .profile-btn {
            width: 100%;
            padding: 10px;
            background-color: #6f0936;
            color: white;
            border: 1px solid #6f0936;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .profile-btn:hover {
            background-color: #f5eff4;
            color: #6f0936;
            border: 1px solid #6f0936;
        }
        
        .order-history-container {
            margin-top: 30px;
        }
        .order-history {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .order-history th,
        .order-history td {
            padding: 12px;
            border: 1px solid #ccc;
        }
        .order-history th {
            background-color: #f2f2f2;
            color: #6f0934;
            font-weight: bold;
        }
        .order-history tr:hover {
            background-color: #f9f9f9;
        }
        .message {
            color: green;
            margin: 10px 0;
            font-weight: bold;
            text-align: center;
        }
        @media (max-width: 768px) {
            .profile-container {
                padding: 20px;
            }
            h1 {
                font-size: 1.8em;
            }
        }
        @media (max-width: 480px) {
            h1 {
                font-size: 1.6em;
            }
            input[type="text"],
            input[type="tel"],
            textarea {
                font-size: 0.9em;
            }
        }
        .delete-btn {
            background-color: #ff6666;
            border-color: #ff6666;
            color: white;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }
        .delete-btn:hover {
            background-color: #ff9999;
        }
        .logout-btn {
            width: 100%;
            padding: 10px;
            background-color: #6f0936;
            color: white;
            border: 1px solid #6f0936;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top:10px;
        }
        .logout-btn:hover {
            background-color: #f5eff4;
            color: #6f0936;
            border: 1px solid #6f0936;
        }
        
    </style>
</head>
<?php include 'header.php'; ?>

<body>
    <div class="profile-container">
        <h1>Welcome to Your Profile!</h1>

        <!-- Display success or error message -->
        <?php if ($message): ?>
            <div class="message"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>

        <!-- Profile Update Form -->
        <form action="profile.php" method="POST">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" name="birthday" id="birthday" value="<?php echo htmlspecialchars($user['birthday']); ?>" required>
            </div>
            <div class="form-group">
                <label>Gender:</label>
                <label class="gender-label">
                    <input type="radio" name="gender" value="Male" <?php echo ($user['gender'] == 'Male') ? 'checked' : ''; ?>> Male
                
                
                    <input type="radio" name="gender" value="Female" <?php echo ($user['gender'] == 'Female') ? 'checked' : ''; ?>> Female
                
                
                    <input type="radio" name="gender" value="Other" <?php echo ($user['gender'] == 'Other') ? 'checked' : ''; ?>> Other
                </label>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="tel" name="contact_number" id="contact_number" value="<?php echo htmlspecialchars($user['contact_number']); ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea name="address" id="address" rows="4" required><?php echo htmlspecialchars($user['address']); ?></textarea>
            </div>
            
            <button type="submit" name="update_profile" class="profile-btn">Update Profile</button>
        </form>

        <!-- Logout and Delete Account buttons -->
        <form action="profile.php" method="POST">
            <button type="submit" name="delete_account" class="delete-btn" onclick="return confirm('Are you sure you want to delete your account?');">Delete Account</button>
        </form>
        
        <form action="logout.php" method="POST">
            <button type="submit" class="logout-btn">Logout</button>
        </form>

        <!-- Order History Section -->
        <div class="order-history-container">
            <h2>Order History</h2>
            <table class="order-history">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking Number</th>
                        <th>Shipping Address</th>
                        <th>Contact Number</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($order['tracking_number']); ?></td>
                            <td><?php echo htmlspecialchars($order['shipping_address']); ?></td>
                            <td><?php echo htmlspecialchars($order['contact_number']); ?></td>
                            <td><?php echo htmlspecialchars($order['total_price']); ?></td>
                            <td><?php echo htmlspecialchars($order['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<?php include 'footer.php'; ?>
</html>
