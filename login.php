<?php
session_start();
require 'connection.php'; 

$error_message = ''; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email 
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Invalid email format.';
    } else {
       
        $stmt = $conn->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            if ($user['password'] == $password) { 
                
                $_SESSION['user_email'] = $user['email'];
                header('Location: index.php');
                exit();
            } else {
                // Incorrect password
                $error_message = 'Invalid email or password.';
            }
        } else {
            // User not found
            $error_message = 'No account found with that email.';
        }

        $stmt->close();
    }
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic" rel="stylesheet" />
    <style>
        body {
            font-family: Lato, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/loginbg.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .container {
            max-width: 500px;
            margin: 150px auto;
            padding: 20px;
            background-color: rgba(250, 246, 249, 1);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: xx-large;
            color: #6f0936;
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        input[type="email"],
        input[type="password"] {
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

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #f5eff4;
            color: #6f0936;
            border: 1px solid #6f0936;
        }

        .alert {
            padding: 10px;
            background-color: #f44336;
            color: white;
            margin-bottom: 15px;
            border-radius: 4px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <?php if (!empty($error_message)): ?>
            <div class="alert">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
        <form action="login.php" method="post">
            <input type="email" id="email" placeholder="EMAIL" name="email" required>
            <input type="password" id="password" placeholder="PASSWORD" name="password" required>
            <input type="submit" value="L O G I N">
            <p>Don't have an account? <a href="register.php" class="btn">Register here.</a></p>
        </form>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>
