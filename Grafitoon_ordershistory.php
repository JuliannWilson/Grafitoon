<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();
require('includes/Database_Connection.php'); // Connects to your MySQL database

// Check login
if (!isset($_SESSION['user'])) {
    header("Location: Grafitoon_login.php");
    exit();
}

$user_id = $_SESSION['user']['user_id'];

// Fetch user orders
$sql = "SELECT * FROM Orders WHERE user_id = ? ORDER BY order_date DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$orders = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
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

<div class="order-history">
    <h2>🧾 My Order History</h2>

    <?php if ($orders->num_rows > 0): ?>
        <?php while ($order = $orders->fetch_assoc()): ?>
            <div class="order">
                <strong>Order ID:</strong> <?= $order['order_id']; ?><br>
                <strong>Date:</strong> <?= $order['order_date']; ?><br>
                <strong>Status:</strong> <?= ucfirst($order['status']); ?><br>
                <strong>Total:</strong> $<?= number_format($order['total_amount'], 2); ?>

                <table>
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $order_id = $order['order_id'];
                        $items_sql = "
                            SELECT oi.*, p.name 
                            FROM Order_Items oi
                            JOIN Products p ON oi.product_id = p.product_id
                            WHERE oi.order_id = ?
                        ";
                        $items_stmt = $conn->prepare($items_sql);
                        $items_stmt->bind_param("i", $order_id);
                        $items_stmt->execute();
                        $items_result = $items_stmt->get_result();

                        while ($item = $items_result->fetch_assoc()):
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']); ?></td>
                            <td><?= $item['quantity']; ?></td>
                            <td>$<?= number_format($item['price_at_purchase'], 2); ?></td>
                            <td>$<?= number_format($item['price_at_purchase'] * $item['quantity'], 2); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>You haven’t placed any orders yet.</p>
    <?php endif; ?>

    <a href="shop.php">← Continue Shopping</a>
</div>

</body>
</html>

</body>
</html>
