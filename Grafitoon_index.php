<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafitoon Custom Clothing Ecommerce</title>
    <link rel="stylesheet" href="grafitoon_css.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #4a4a4a;
            text-align: center;
        }
        header {
            background-color:rgb(19, 19, 19);
            padding: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .container {
            padding: 20px;
        }
        .hero {
            background-image: url('cartoon-banner.jpg');
            background-size: cover;
            color: white;
            padding: 50px;
            font-size: 28px;
            font-weight: bold;
        }
        .products {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }
        .product {
            background: white;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.1);
            max-width: 200px;
        }
        .product img {
            max-width: 100%;
            border-radius: 10px;
        }

        .profile-pic {
    width: 40px; /* Adjust size as needed */
    height: 40px;
    border-radius: 50%;
    object-fit: cover; /* Ensures image maintains aspect ratio */
    border: 2px solid #fff; /* Optional: Adds a border around the image */
}
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        footer {
            background: #333;
            color: white;
            padding: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Grafitoon</h1>
        <nav class="navbar">
        <div class="logo">
        <a href="Grafitoon_index.php">Home</a>
        </div>
        <ul class="nav-links">
            <li><a href="Grafitoon_index.php">Home</a></li>
            <li><a href="Grafitoon_shoppingsection.php">Shop</a></li>
            <li><a href="Grafitoon_aboutus.php">About</a></li>
            <li><a href="Grafitoon_contactus.php">Contact</a></li>
            <li class="profile">
                <a href="profile.php">
                    <img src="profile_pics/babe.jpg" alt="Profile" class="profile-pic">
                </a>
            </li>
        </ul>
    </nav>

    </header>

<?php
    // Start the session
    session_start();
?>
    

    <div class="container">
        <h2>Our Featured Products</h2>
        <div class="products">
            <?php
                $products = [
                    ["img" => "tshirt1.jpg", "name" => "Cartoon Tee"],
                    ["img" => "hoodie1.jpg", "name" => "Cartoon Hoodie"],
                    ["img" => "cap1.jpg", "name" => "Cartoon Cap"]
                ];
                
                foreach ($products as $product) {
                    echo "<div class='product'>";
                    echo "<img src='" . $product['img'] . "' alt='" . $product['name'] . "'>";
                    echo "<p>" . $product['name'] . "</p>";
                    echo "<a href='#' class='btn'>Shop Now</a>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Grafitoon. All Rights Reserved.
    </footer>
</body>
</html>
