<?php
    session_start();
    require_once 'Database_Connection.php'; // Make sure this file sets up $conn
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafitoon - Shop</title>
    <link rel="stylesheet" href="grafitoon_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .container {
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
            text-align: center;
        }

        .filter-buttons {
            margin-bottom: 30px;
        }

        .filter-buttons button {
            background-color: #ff6600;
            color: white;
            border: none;
            padding: 10px 20px;
            margin: 5px;
            border-radius: 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .filter-buttons button:hover,
        .filter-buttons button.active {
            background-color: #cc5200;
        }

        .products {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 30px;
        }

        .product {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            width: 220px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        }

        .product img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .product p {
            color: black;
            font-weight: bold;
            margin: 10px 0;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff6600;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: auto;
        }

        .profile-dropdown {
            position: relative;
            display: inline-block;
        }

        .profile-dropdown-content {
            display: none;
            position: absolute;
            background-color: #fff;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            z-index: 1;
            right: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .profile-dropdown-content a {
            color: black;
            padding: 10px 16px;
            text-decoration: none;
            display: block;
        }

        .profile-dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .profile-dropdown:hover .profile-dropdown-content {
            display: block;
        }

        .profile-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #fff;
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
    <a href="about_us.php">About</a>
    <a href="Grafitoon_shoppingsection.php">Shop</a>
    <a href="Grafitoon_contactus.php">Contact</a>
    <a href="Grafitoon_shoppingcart.php"><i class="fas fa-shopping-cart"></i></a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <div class="profile-dropdown">
            <img src="<?= htmlspecialchars($_SESSION['profile_picture'] ?? 'images/placeholders/default_profile.png') ?>" alt="Profile" class="profile-avatar">
            <div class="profile-dropdown-content">
                <a href="Grafitoon_profile.php"><i class="fas fa-user"></i> My Profile</a>
                <a href="grafitoon_checkout.php"><i class="fas fa-credit-card"></i> Checkout</a>
                <a href="Grafitoon_orders.php"><i class="fas fa-box"></i> Orders</a>
                <a href="Grafitoon_ordershistory.php"><i class="fas fa-history"></i> Order History</a>
                <a href="#" onclick="confirmLogout()"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
            </div>
        </div>
    <?php else: ?>
        <a href="Grafitoon_login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
    <?php endif; ?>
</nav>

<script>
function confirmLogout() {
    if (confirm("Are you sure you want to sign out?")) {
        window.location.href = "logout.php";
    }
}
</script>

<section class="container">
    <h2>Shop Our Cartoon Collection</h2>

    <div class="filter-buttons">
        <button class="active" onclick="filterProducts('all', event)">All</button>
        <button onclick="filterProducts('t-shirts', event)">T-Shirts</button>
        <button onclick="filterProducts('hoodies', event)">Hoodies</button>
        <button onclick="filterProducts('pants', event)">Pants</button>
        <button onclick="filterProducts('accessories', event)">Accessories</button>
    </div>

    <div class="products" id="productList">
        <?php
        $query = "SELECT * FROM products";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) {
                $img = htmlspecialchars($product['image_path']);
                $name = htmlspecialchars($product['NAME']);
                $price = htmlspecialchars($product['price']);
                $category = strtolower($product['category']); // used as data-type for filtering

                echo "<div class='product' data-type='{$category}'>";
                echo "<img src='{$img}' alt='{$name}'>";
                echo "<p>{$name}</p>";
                echo "<p>\${$price}</p>";
                echo "<a href='Grafitoon_shoppingcart.php?product=" . urlencode($name) . "&price=" . urlencode($price) . "' class='btn'>Add to Cart</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</section>

<footer>
    &copy; <?= date("Y") ?> Grafitoon. All Rights Reserved.
</footer>

<script>
function filterProducts(category, event) {
    const products = document.querySelectorAll('.product');
    document.querySelectorAll('.filter-buttons button').forEach(btn => btn.classList.remove('active'));
    if (event) event.target.classList.add('active');

    products.forEach(product => {
        const type = product.getAttribute('data-type');
        product.style.display = (category === 'all' || type === category) ? 'flex' : 'none';
    });
}
</script>
</body>
</html>
