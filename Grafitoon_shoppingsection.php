<?php
include "Database_Connection.php"
    // Start the session
    session_start();
?>
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
        .navbar ul li {
            display: inline;
        }
        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 15px;
            display: inline-block;
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
    position: absolute;
    bottom: 0;
    width: 100%;
    background: #333;
    color: white;
    padding: 10px;
    text-align: center;
}
    </style>
</head>
<body>
<div class="background-gif"></div>
<header>
        <div class="logo">
            <span class="grafi">Grafi</span><span class="toon">toon</span>
        </div>
    </header>
    <nav>
       <a href="Grafitoon_index.php">Home</a>
        <a href="Grafitoon_shoppingsection.php">Shop</a>
        <a href="Grafitoon_contactus.php">Contact</a>
        <a href="Grafitoon_shoppingcart.php">Cart</a>
         <a href="orders.php">Orders</a>
         <a href="admin.php">Admin</a>
                <?php if(isset($_SESSION['user'])): ?>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="Grafitoon_login.php">Login</a>
                <?php endif; ?>
        </nav>

    <section class="container">
        <h2>Shop Our Cartoon Collection</h2>
        <section class="products">
            <?php
                $products = [
                    ["img" => "images\product1.jpg", "name" => "Cartoon Tee", "price" => "$20"],
                    ["img" => "images\product2.jpg", "name" => "Cartoon Hoodie", "price" => "$35"],
                    ["img" => "images\product3.jpg", "name" => "Cartoon Cap", "price" => "$15"],
                    ["img" => "images\product4.jpg", "name" => "Cartoon Sweater", "price" => "$30"],
                    ["img" => "images\product5.png", "name" => "Cartoon Jacket", "price" => "$50"]
                ];
                
                foreach ($products as $product) {
                    echo "<div class='product'>";
                    echo "<img src='" . $product['img'] . "' alt='" . $product['name'] . "'>";
                    echo "<p>" . $product['name'] . " - " . $product['price'] . "</p>";
                    echo "<a href='Grafitoon_shoppingcart.php?product=" . urlencode($product['name']) . "&price=" . urlencode($product['price']) . "' class='btn'>Add to Cart</a>";
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
