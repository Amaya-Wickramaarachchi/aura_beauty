<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aura Beauty</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        footer {
            background-color: #fffaf4; 
            padding: 40px 20px; 
            color: #6f0936; 
            text-align: center;
            font-family: 'Lato', sans-serif;
            border-top: 1px solid #eaeaea; 
        }

        .footer-container {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .links {
            display: flex;
            justify-content: space-between;
            flex-basis: 100%;
            margin-bottom: 30px;
        }

        .links div {
            flex: 1;
            min-width: 150px; 
        }

        .links h3 {
            color: #6f0936;
            font-size: 18px;
            font-family: 'Montserrat', sans-serif;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .links ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .links ul li {
            margin-bottom: 8px;
        }

        .links ul li a {
            color: #6f0936;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s;
        }

        .links ul li a:hover {
            color: #6f0936;
        }

        /* Social Media */
        .social-icons {
            margin-bottom: 30px;
            display: flex;
            justify-content: center; 
            align-items: center; 
            gap: 15px; 
            flex-basis: 100%;
        }

        .social-icons a {
            color: #6f0936;
            font-size: 18px;
            transition: color 0.3s;
        }

        .social-icons a:hover {
            color: #f0936;
        }

        
        .footer-bottom {
            font-size: 14px;
        }

        .footer-bottom p {
            margin: 0;
        }

        .footer-bottom a {
            color: #6f0936;
            text-decoration: none;
            font-weight: bold;
        }

        .footer-bottom a:hover {
            color: #f0936;
        }

        
        @media (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                text-align: center;
            }

            .links {
                flex-direction: column;
                align-items: center;
            }

            .links div {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
<footer>
    <div class="footer-container">
        <div class="links">
            <div>
                <h3>About Us</h3>
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact_us.php">Contact Us</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                </ul>
            </div>
            <div>
                <h3>Legal</h3>
                <ul>
                    <li><a href="terms_of_service.php">Terms of Service</a></li>
                    <li><a href="privacy_policy.php">Privacy Policy</a></li>
                </ul>
            </div>
        </div>

        <div class="social-icons">
            <a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Aura Beauty. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
