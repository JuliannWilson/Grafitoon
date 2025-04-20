<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafitoon - Home</title>
    <link rel="stylesheet" href="grafitoon_css.css">
    <style>
        .features {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    padding: 40px 20px;
    background-color: rgba(255, 255, 255, 0.45); /* Translucent white */
    border-radius: 10px;
    margin: 30px;
    backdrop-filter: blur(3px); /* Optional: smooth glass effect */
}
    </style>
</head>
<body>

    <!-- Animated Background Container -->
    <div class="background-gif"></div>

    <header>
        <div class="logo">
            <span class="grafi">Grafi</span><span class="toon">toon</span>
        </div>
    </header>

    
    <nav>
        <a href="grafitoon_index.php">Home</a>
        <a href="about_us.php">About</a>
        <a href="Grafitoon_shoppingsection.php">Shop</a>
        <a href="Grafitoon_contactus.php">Contact</a>
        <a href="Grafitoon_shoppingcart.php">Cart</a>
        <a href="grafitoon_checkout.php">Checkout</a>
        <a href="Grafitoon_ordershistory.php">Orders</a>
        <a href="Grafitoon_login.php">Login</a>
    </nav>

    <section class="hero">
        <h1>Welcome to Grafitoon</h1>
        <p>Where Urban Streetwear Meets Cartoon Vibes!</p>
    </section>

    <section class="features">
        <div class="feature-card">
            <img src="images/product1.jpg" alt="Graffiti Tee">
            <h3>Street Tees</h3>
            <p>Bold, artistic designs inspired by urban walls.</p>
        </div>
        <div class="feature-card">
            <img src="images/product2.jpg" alt="Cartoon Hoodie">
            <h3>Cartoon Hoodies</h3>
            <p>Cozy hoodies featuring your favorite animated styles.</p>
        </div>
        <div class="feature-card">
            <img src="images/product3.jpg" alt="Snapbacks">
            <h3>Dope Snapbacks</h3>
            <p>Top off your fit with our graffiti-inspired snapbacks.</p>
        </div>
    </section>

    <footer>
        &copy; 2025 Grafitoon. All rights reserved.
    </footer>

</body>
</html>
