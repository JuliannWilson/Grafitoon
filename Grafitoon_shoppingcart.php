<?php
    // Start the session
    session_start();

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['checkout'])) {
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $address = $_POST['address'] ?? '';
        $payment = $_POST['payment'] ?? '';
        
        if ($name && $email && $address && $payment) {
            $_SESSION['cart'] = [];
            $message = "Thank you for your purchase, $name! Your order has been placed.";
        } else {
            $error = "Please fill in all required fields.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cartoon Couture - Checkout</title>
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
       Checkout
       <ul>
                <li><a href="Grafitoon_shoppingsection.php">Go Back</a></li></ul>
    </header>
    <div class="container">
        <h2>Review Your Order</h2>
        <div class="cart-items">
            <h3>Your Cart</h3>
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <li><?php echo htmlspecialchars($item['name']) . " - " . htmlspecialchars($item['price']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <h2>Enter Your Details</h2>
        <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="name">Full Name:</label><br>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="address">Shipping Address:</label><br>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="payment">Payment Method:</label><br>
                <select id="payment" name="payment" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                </select>
            </div>
            <button type="submit" name="checkout" class="btn">Place Order</button>
        </form>
    </div>
    <footer>
        &copy; <?php echo date("Y"); ?> Cartoon Couture. All Rights Reserved.
    </footer>
</body>
</html>
