<?php
session_start();
include 'Database_Connection.php';

$user_id = $_SESSION['user_id'] ?? 1;

$sql = "SELECT 
            products.name, 
            products.image_url, 
            cart_items.product_id, 
            cart_items.price_at_purchase, 
            cart_items.quantity,
            cart_items.item_id
        FROM cart_items
        JOIN products ON cart_items.product_id = products.product_id
        WHERE cart_items.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart | GrafiToon</title>
    <link rel="stylesheet" href="grafitoon_css.css">
</head>
<body>

<div class="background-gif"></div>

<header>
    <div class="grafitoon-logo">
        <span class="grafi">Grafi</span><span class="toon">toon</span>
    </div>
</header>

<nav>
    <a href="Grafitoon_home.php">Home</a>
    <a href="Grafitoon_aboutus.php">About Us</a>
    <a href="Grafitoon_shoppingsection.php">Shop</a>
    <a href="Grafitoon_shoppingcart.php">Cart</a>
    <a href="Grafitoon_login.php">Login</a>
</nav>

<main class="cart-container">
    <h1 style="text-align: center;">🛒 Your Shopping Cart</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="cart-table">
            <tr>
                <th>Product</th>
                <th>Image</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): 
                $subtotal = $row['price_at_purchase'] * $row['quantity'];
                $total += $subtotal;
            ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><img src="<?= htmlspecialchars($row['image_url']) ?>" width="80" /></td>
                <td>$<?= number_format($row['price_at_purchase'], 2) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>$<?= number_format($subtotal, 2) ?></td>
            </tr>
            <?php endwhile; ?>
            <tr class="cart-total-row">
                <td colspan="4" style="text-align: right;">Grand Total:</td>
                <td>$<?= number_format($total, 2) ?></td>
            </tr>
        </table>
        <div class="cart-buttons">
            <a href="Grafitoon_shoppingsection.php" class="btn-secondary">🛍 Continue Shopping</a>
            <a href="checkout.php" class="btn">💳 Proceed to Checkout</a>
        </div>
    <?php else: ?>
        <p class="empty-cart-msg">🧺 Your cart is empty.</p>
        <div class="cart-buttons">
            <a href="Grafitoon_shoppingsection.php" class="btn">🛍 Start Shopping</a>
        </div>
    <?php endif; ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> GrafiToon. All rights reserved.</p>
</footer>

</body>
</html>
