<?php
session_start();
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Aura Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Lato', sans-serif;
            margin: 0;
            padding-top: 100px;
            background-color: #ffffff;
            color: #333;
        }
        .features-container {
            width: 100%; 
            background-color: #fdfbf8; 
            border-radius: 0px; 
            margin: 0;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }

        h1 {
            font-size: 3em;
            color: #6f0936;
            margin-bottom: 20px;
            font-weight: 600;
        }

        h2 {
            font-size: 2em;
            color: #6f0936;
            margin-top: 50px;
            margin-bottom: 20px;
            font-weight: 500;
        }

        p {
            font-size: 1.1em;
            line-height: 1.8;
            color: #555;
            max-width: 900px;
            margin: 0 auto 20px auto;
        }

        .about-section {
            display: flex;
            flex-direction: row;
            text-align: left;
            justify-content: space-between;
            margin-bottom: 60px;
        }

        .about-content {
            flex: 1;
            padding-right: 20px;
        }

        .about-image {
            flex: 1;
            max-width: 500px;
        }

        .about-image img {
            width: 100%;
            border-radius: 50%;
        }
        
        .features-section {
            display: flex;
            justify-content: space-around;
            text-align: center; 
            padding: 30px; 
            border-radius: 0px; 
        }

        .features-section h2 {
            text-align: center; 
            margin-top: 40px; 
           
        }

        .text-section h2 {
            text-align: center; 
            margin-top: 40px; 
        }

        .icon-item {
            flex-direction: column;
            align-items: center;
            margin: 10px;
            flex: 1;
        }

        .icon-item i {
            font-size: 50px;
            color: #6F0936;
            transition: color 0.3s ease;
        }

        .icon-item i:hover {
            color: #f0936;
        }

        .icon-item p {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        .text-section {
            margin-top: 50px;
            max-width: 100%;
        }

        .team-section {
            margin-top: 60px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .team-member {
            flex: 1 1 300px;
            margin: 20px;
            background-color: #fdfbf8;
            text-align: center;
            padding: 20px;
            max-width: 300px;
        }

        .team-member img {
            width: auto;
            height: 300px;
            border-radius: 0;
            margin-bottom: 15px;
        }

        .team-member h3 {
            font-size: 1.5em;
            color: #6f0936;
            margin-bottom: 10px;
        }

        .team-member p {
            font-size: 1em;
            color: #555;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 1024px) {
            .about-section {
                flex-direction: column;
                text-align: center;
            }

            .about-content {
                padding-right: 0;
                margin-bottom: 20px;
            }

            .about-image {
                max-width: 100%;
                margin-bottom: 20px;
            }

            .team-member {
                width: calc(50% - 40px);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.2em;
            }

            h2 {
                font-size: 1.6em;
            }

            p {
                font-size: 1em;
            }

            .team-member {
                width: calc(100% - 40px);
            }
            .about-image {
                max-width: 100%;
                margin-bottom: 20px;
                border-radius: 50%;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.8em;
            }

            h2 {
                font-size: 1.4em;
            }

            p {
                font-size: 0.95em;
            }
            .about-image {
                max-width: 100%;
                margin-bottom: 20px;
                border-radius:50%;
            }
        }

      
        @media (max-width: 600px) {
            .features-section {
                flex-direction: column;
                padding: 20px; 
            }

            .icon-item {
                margin-bottom: 20px; 
                flex-basis: 100%; 
            }

            .team-member {
                width: calc(100% - 40px);
                margin: 10px 0; 
            }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <div class="about-section">
            <div class="about-content">
                <h1>About Us</h1>
                <p>At Aura Beauty, we believe that every individual deserves to feel confident and radiant in their own skin. Our mission is to provide personalized skincare solutions tailored to each customer’s unique skin type and needs. Understanding that skincare is not one-size-fits-all, we are committed to offering a diverse range of products that cater to various concerns, from hydration to anti-aging and everything in between.</p>
                <p>Our expert team is dedicated to educating customers on the importance of understanding their skin and selecting the right products for their specific requirements. We prioritize quality and efficacy, using only the finest ingredients in our formulations to ensure that each product not only feels luxurious but also delivers real results.</p>
                <p>Join us on a journey to discover your skin’s true potential, and let Aura Beauty empower you to embrace your natural beauty with confidence and grace. Together, we can create a skincare routine that highlights your uniqueness and enhances your inner glow.</p>
            </div>
            <div class="about-image">
                <img src="images/about-us1.jpg" alt="About Aura Beauty">
            </div>
        </div>

        <div class="text-section">
            <h2>Our Story</h2>
            <p>Founded in 2024, Aura Beauty emerged from a passion for beauty and a commitment to quality. Our founders recognized the need for a personalized approach to skincare that celebrates individuality and promotes self-love.</p>
        </div>
        
        <div class="features-container">
            <h2>Our Values</h2>
            <div class="features-section">
                <div class="icon-item">
                    <i class="fas fa-leaf"></i>
                    <p>Ethical Sourcing</p>
                </div>
                <div class="icon-item">
                    <i class="fas fa-paw"></i>
                    <p>Cruelty-Free</p>
                </div>
                <div class="icon-item">
                    <i class="fas fa-balance-scale"></i>
                    <p>Balanced Beauty</p>
                </div>
                <div class="icon-item">
                    <i class="fas fa-recycle"></i>
                    <p>Sustainability</p>
                </div>
                <div class="icon-item">
                    <i class="fas fa-heart"></i>
                    <p>Customer Love</p>
                </div>
                <div class="icon-item">
                    <i class="fas fa-user-friends"></i>
                    <p>Community Engagement</p>
                </div>
                <div class="icon-item">
                    <i class="fas fa-thumbs-up"></i>
                    <p>Quality Assurance</p>
                </div>
            </div>
        </div>

        <h2>Why Choose Us?</h2>
        <div class="container">
            <p>We offer a unique, personalized skincare experience designed to meet your specific needs. Our advanced skin type finder and customized recommendations ensure that you achieve glowing, healthy skin.</p>
        </div>

        <h2>Meet Our Team</h2>
        <div class="team-section">
            <div class="team-member">
                <img src="images/staff/s1.png" alt="Jane Doe">
                <h3>Jane Doe</h3>
                <p>Founder & CEO</p>
                <p>Jane is passionate about creating high-quality beauty products that empower individuals to feel confident in their skin.</p>
            </div>
            <div class="team-member">
                <img src="images/staff/s3.png" alt="John Smith">
                <h3>John Smith</h3>
                <p>Head of Product Development</p>
                <p>John oversees the development of our innovative skincare line, ensuring every product meets our high standards.</p>
            </div>
            <div class="team-member">
                <img src="images/staff/s2.png" alt="Emily White">
                <h3>Emily White</h3>
                <p>Marketing Manager</p>
                <p>Emily is dedicated to spreading the word about Aura Beauty and connecting with our customers.</p>
            </div>
        </div>
    </div>
    
</body>
</html>

<?php
include 'footer.php';
?>
