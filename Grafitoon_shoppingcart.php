<?php
session_start();
include 'Database_Connection.php'; // ensure DB connects and tables are created

// Simulate a user for demo/testing
$user_id = $_SESSION['user_id'] ?? 1; // Default to user ID 1 if not logged in

// Fetch cart items for this user
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

    <h1>Your Shopping Cart</h1>

    <div class="cart-container">
        <?php if ($result->num_rows > 0): ?>
            <table border="1" cellpadding="10">
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
                <tr>
                    <td colspan="4" align="right"><strong>Grand Total:</strong></td>
                    <td><strong>$<?= number_format($total, 2) ?></strong></td>
                </tr>
            </table>
            <br>
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        <?php else: ?>
            <p>Your cart is empty.</p>
            <a href="Grafitoon_shoppingsection.php">Continue Shopping</a>
        <?php endif; ?>
    </div>

</body>
</html>
