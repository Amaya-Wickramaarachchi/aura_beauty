<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100italic,300,300italic,regular,italic,700,700italic,900,900italic" rel="stylesheet" />

    <title>Aura Beauty - Skin Type Quiz</title>
    <?php include 'header.php'; ?>
    <style>
        body {
            font-family: Lato, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            margin-top:100px;
        }

        .container {
            margin-top: 250px;
            background: white;
            padding: 2rem;
            border-radius: 0px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center; /* Center align text */
        }

        h2 {
            margin-bottom: 1.5rem;
            color: #6f0936;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input[type="number"],
        select {
            width: 80%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 0px;
            transition: border-color 0.3s;
        }

        input[type="number"]:focus,
        select:focus {
            border-color: #6f0936;
            outline: none;
        }

        .btn {
            text-decoration: none; 
            display: inline-block; 
            width: 100%;
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

        .btn:hover {
            background-color: #6f0936;
            color:#f5eff4;
        }

        .product-card {
            display: none;
            margin-top: 0.25rem;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 0px;
            background: #f9f9f9;
        }

        footer {
            margin-top: 2rem;
            text-align: center;
            padding: 1rem 0;
            background-color: white;
            width: 100%;
            position: relative;
            bottom: 0;
        }
        
        .question {
            display: none; 
        }

        .question.active {
            display: block; 
        }

        /* Media Queries for Mobile Responsiveness */
        @media (max-width: 768px) {
            body{
                margin-top:200px;
            }
            .container {
                margin-top: 150px; 
                padding: 1rem; 
            }

            h2 {
                font-size: 1.5rem; 
            }

            input[type="number"],
            select {
                width: 80%;
            }

            .btn {
                padding: 8px 0; 
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            body{
                margin-top:100px;
            }
            .container {
                margin-top: 120px; 
            }

            h2 {
                font-size: 1.2rem; 
            }

            .btn {
                padding: 6px 0; 
                font-size: 0.8rem; 
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Identify Your Skin Type</h2>
        <form id="skinTypeForm">
            <div class="question active" id="question1">
                <label for="age">How old are you?</label>
                <input type="number" id="age" name="age" required>
                <button type="button" class="btn" onclick="showNextQuestion(1)">N E X T</button>
            </div>
            
            <div class="question" id="question2">
                <label>How does your skin feel after cleansing?</label>
                <select id="skinFeel" name="skinFeel" required>
                    <option value="">Select an option</option>
                    <option value="tight">Tight and dry</option>
                    <option value="normal">Normal</option>
                    <option value="oily">Oily and shiny</option>
                    <option value="flaky">Flaky and sensitive</option>
                </select>
                <button type="button" class="btn" onclick="showNextQuestion(2)">N E X T</button>
            </div>

            <div class="question" id="question3">
                <label>Do you experience breakouts?</label>
                <select id="breakouts" name="breakouts" required>
                    <option value="">Select an option</option>
                    <option value="frequent">Frequent breakouts</option>
                    <option value="occasionally">Occasionally</option>
                    <option value="never">Never</option>
                </select>
                <button type="button" class="btn" onclick="showNextQuestion(3)">N E X T</button>
            </div>

            <div class="question" id="question4">
                <label>Does your skin get red or irritated easily?</label>
                <select id="sensitivity" name="sensitivity" required>
                    <option value="">Select an option</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <button type="button" class="btn" onclick="showResults()">F I N I S H</button>
            </div>
        </form>
<br>
        <div id="result" class="product-card">
            <h3>Your Skin Type:</h3>
            <p id="skinTypeResult"></p>
            <h4>Recommended Products:</h4>
            <div id="productRecommendations"></div>
            <br>
            <a href="products.php" class="btn" id="shopNowBtn">Shop Now</a>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    
    <script>
        function showNextQuestion(current) {
            // Hide current question
            document.getElementById('question' + current).classList.remove('active');
            // Show next question
            document.getElementById('question' + (current + 1)).classList.add('active');
        }

        function showResults() {
            // Hide all questions
            const questions = document.querySelectorAll('.question');
            questions.forEach(question => {
                question.classList.remove('active');
            });

            // Get values from the quiz
            const skinFeel = document.getElementById('skinFeel').value;
            const breakouts = document.getElementById('breakouts').value;
            const sensitivity = document.getElementById('sensitivity').value;

            let skinType = '';
            let products = [];

            // Determine skin type
            if (skinFeel === 'tight' && sensitivity === 'yes') {
                skinType = 'Dry and Sensitive';
                products = ['HydraGlow Cream', 'Berry Bright Scrub', 'Radiance Boost Serum'];
            } else if (skinFeel === 'oily' && breakouts === 'frequent') {
                skinType = 'Oily';
                products = ['PetalSoft Hydrator', 'Radiance Boost Serum', 'SilkGlow Exfoliating Scrub'];
            } else if (skinFeel === 'normal' && breakouts === 'occasionally') {
                skinType = 'Normal';
                products = ['SilkSerenity Lotion', 'Herbal Bliss Scrub', 'Radiance Boost Serum'];
            } else if (skinFeel === 'flaky' || sensitivity === 'yes') {
                skinType = 'Sensitive';
                products = ['PetalSoft Hydrator', 'Radiance Boost Serum', 'Herbal Bliss Scrub'];
            } else {
                skinType = 'Combination';
                products = ['PetalSoft Hydrator', 'Velvet Veil Moisturizer'];
            }

            // Display results
            document.getElementById('skinTypeResult').innerText = skinType;
            const productDiv = document.getElementById('productRecommendations');
            productDiv.innerHTML = ''; // Clear previous results
            products.forEach(product => {
                const productCard = document.createElement('div');
                productCard.innerText = product;
                productCard.className = 'product-card-item';
                productDiv.appendChild(productCard);
            });

            // Show the result section
            document.getElementById('result').style.display = 'block';
        }
    </script>
</body>
</html>
