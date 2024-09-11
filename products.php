
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Aura Beauty</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,regular,500,600,700,800,900,100italic,200italic,300italic,italic,500italic,600italic,700italic,800italic,900italic" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic" rel="stylesheet" />
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Lato, sans-serif;
            background-color: #fdfbf8;
            background-size: cover;
        }

        .container {
            max-width: 100%;
            margin: 0 auto;
            padding-top: 180px;
        }

        h1 {
            text-align: center;
            color: #6f0936;
        }

        /* Container for Tabs */
        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #e0e0e0;
        }

        /* Tab Styles */
        .tab {
            margin: 0;
            padding: 10px 20px;
            cursor: pointer;
            color: #6f0936;
            font-weight: bold;
            text-align: center;
            transition: color 0.3s ease;
            position: relative;
            font-size: 18px;
            margin: 0 15px;
        }

        /* Active Tab Style */
        .tab.active {
            border-bottom: 2px solid #6f0936;
            color: #6f0936;
        }

        /* Hover Effect */
        .tab:hover:not(.active) {
            color: #9e3b68;
        }

        /* Tab Content */
        .tab-content {
            display: none;
            margin-top: 20px;
        }

        .tab-content.active {
            display: block;
        }

        .banner {
            padding: 20px;
            background-color: #6f0936;
            color: white;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }

        .products-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }

        .product-card {
            
            margin: 15px;
            width: 250px;
            text-align: left;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .product-card .products-section{
            background-color: #f7f1f7;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .product-card img {
            width: 100%;
            height: 300px;
            margin-bottom: 15px;
        }

        .product-card h3 {
            color: #333;
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-card p {
            color: #6f0936;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .product-card .btn {
        display: block; 
        width: 100%; 
        padding: 10px 0; 
        background-color: white;
        color: #6F0936;
        border: 1px solid #6F0936;
        border-radius: 0; 
        text-align: center;
        cursor: pointer;
        text-decoration:none;
        transition: background-color 0.3s ease, color 0.3s ease;
        letter-spacing:3px;
        font-size:10px;

    }

    .product-card .btn:hover {
        background-color: #6F0936;
        color: white;
    }

    .moisturizers-section, .serums-section {
            background-color: #ffffff; 
            padding: 20px;
            margin-bottom: 30px;
    }
    /* Media Queries for Responsiveness */
    @media (max-width: 1200px) {
        .product-card {
            width: 30%; /* 3 cards in a row */
        }
    }

    @media (max-width: 992px) {
        .product-card {
            width: 45%; /* 2 cards in a row */
        }

        .tabs {
            flex-direction: column;
        }

        .tab {
            margin: 10px 0;
        }
    }

    @media (max-width: 768px) {
        .products-container {
            justify-content: center;
        }

        .product-card {
            width: 90%; /* 1 card in a row */
            margin: 10px 0; /* Reduced margin */
        }

        .product-card img {
            height: auto; /* Maintain aspect ratio */
        }

        .product-card h3 {
            align: center;
            font-size: 15px;
        }

        h1 {
            font-size: 22px;
        }

        .tab {
            font-size: 16px;
            padding: 10px;
        }
    }

    @media (max-width: 480px) {
        h1 {
            font-size: 20px; 
        }

        .tab {
            font-size: 14px; 
            padding: 8px;
        }

        .product-card h3 {
            font-size: 14px; 
        }

        .product-card .btn {
            font-size: 9px; 
        }
    }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <h1>Browse All Our Beauty Products</h1>

        <!-- Tabs -->
        <div class="tabs">
            <div class="tab active" onclick="openTab(event, 'skincare')">Skincare</div>
            <div class="tab" onclick="openTab(event, 'makeup')">Makeup</div>
        </div>

        <!-- Skincare Tab Content -->
        <div id="skincare" class="tab-content active">
            <div class="banner">
                Discover your skin type and find the perfect products tailored to your needs with our Skin Type Identifier!
            </div>
            <div class="moisturizers-section">
                <h1>Moisturizers</h1>
                <div class="products-container">
                    <div class="product-card" onclick="window.location.href='product.php?id=1'">
                        <img src="images/products/moisturizer1.png" alt="HydraGlow Cream">
                        <h3>HydraGlow Cream</h3>
                        <a href="product.php?id=1" class="btn">ADD TO CART $35.25</a>
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=2'">
                        <img src="images/products/moisturizer2.png" alt="SilkSerenity Lotion">
                        <h3>SilkSerenity Lotion</h3>
                        <a href="product.php?id=2"  class="btn">ADD TO CART $28.25</a>
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=3'">
                        <img src="images/products/moisturizer3.png" alt="Velvet Veil Moisturizer">
                        <h3>Velvet Veil Moisturizer</h3>
                        <a href="product.php?id=3" class="btn">ADD TO CART $45.55</a>
                        
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=4'">
                        <img src="images/products/moisturizer4.png" alt="PetalSoft Hydrator">
                        <h3>PetalSoft Hydrator</h3>
                        <a href="product.php?id=4" class="btn">ADD TO CART $25.99</a>
                    </div>
                </div>
            </div>
            <div class="products-section">
                <h1>Scrubs</h1>
                <div class="products-container">
                    <div class="product-card" onclick="window.location.href='product.php?id=5'">
                        <img src="images/products/scrub1.png" alt="SilkGlow Exfoliating Scrub">
                        <h3>SilkGlow Exfoliating Scrub</h3>
                        <a href="product.php?id=5" class="btn">ADD TO CART $35.25</a>                      
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=6'">
                        <img src="images/products/scrub2.png" alt="Herbal Bliss Scrub">
                        <h3>Herbal Bliss Scrub</h3>
                        <a href="product.php?id=6" class="btn">ADD TO CART $29.99</a>                       
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=7'">
                        <img src="images/products/scrub3.png" alt="Berry Bright Scrub">
                        <h3>Berry Bright Scrub</h3>
                        <a href="product.php?id=7" class="btn">ADD TO CART $32.24</a>                       
                    </div>
                </div>
            </div>
            <div class="serums-section">
                <h1>Serums</h1>
                <div class="products-container">
                    <div class="product-card" onclick="window.location.href='product.php?id=8'">
                        <img src="images/products/serum1.png" alt="Radiance Boost Serum">
                        <h3>Radiance Boost Serum</h3>
                        <a href="product.php?id=8" class="btn">ADD TO CART $55.25</a>
                        
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=9'">
                        <img src="images/products/serum2.png" alt="Revive & Renew Serum">
                        <h3>Revive & Renew Serum</h3>
                        <a href="product.php?id=9" class="btn">ADD TO CART $45.25</a>
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=10'">
                        <img src="images/products/serum3.png" alt="HydraBalance Serum">
                        <h3>HydraBalance Serum</h3>
                        <a href="product.php?id=10" class="btn">ADD TO CART $32.95</a>
                    </div>
                    <div class="product-card" onclick="window.location.href='product.php?id=11'">
                        <img src="images/products/serum4.png" alt="Calm & Soothe Serum">
                        <h3>Calm & Soothe Serum</h3>
                        <a href="product.php?id=11" class="btn">ADD TO CART $52.99</a>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Makeup Tab Content -->
        <div id="makeup" class="tab-content">
            <div class="products-container">
                
                <div class="product-card" onclick="window.location.href='product.php?id=12'">
                    <img src="images/product1.png" alt="Mystique Glam Palette">
                    <h3>Mystique Glam Palette</h3>
                    <a href="product.php?id=12" class="btn">ADD TO CART $29.99</a>
                </div>
                <div class="product-card" onclick="window.location.href='product.php?id=13'">
                    <img src="images/product2.png" alt="Flawless Finish Compact">
                    <h3>Flawless Finish Compact</h3>
                    <a href="product.php?id=13" class="btn">ADD TO CART $39.99</a>
                </div>
                <div class="product-card" onclick="window.location.href='product.php?id=14'">
                    <img src="images/product3.png" alt="Product 2">
                    <h3>Velvet Charm Lipstick</h3>
                    <a href="product.php?id=14" class="btn">ADD TO CART $49.99</a>
                </div>
                <div class="product-card" onclick="window.location.href='product.php?id=15'">
                    <img src="images/product4.jpg" alt="Radiant Bloom Blush">
                    <h3>Radiant Bloom Blush</h3>
                    <a href="product.php?id=15" class="btn">ADD TO CART $59.99</a>
                </div>
            </div>
        </div>
    </div>
   


    <script>
        function openTab(event, tabName) {
            // Hide all tab contents
            var tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(function(content) {
                content.classList.remove('active');
            });

            // Deactivate all tabs
            var tabs = document.querySelectorAll('.tab');
            tabs.forEach(function(tab) {
                tab.classList.remove('active');
            });

            // Show the selected tab content and activate the tab
            document.getElementById(tabName).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>
