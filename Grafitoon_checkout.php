<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get cart ID for the user
$cart_query = $conn->prepare("SELECT cart_id FROM cart WHERE user_id = ?");
$cart_query->bind_param("i", $user_id);
$cart_query->execute();
$cart_result = $cart_query->get_result();

if ($cart_result->num_rows === 0) {
    echo "Your cart is empty.";
    exit();
}

$cart = $cart_result->fetch_assoc();
$cart_id = $cart['cart_id'];

// Get cart items
$item_query = $conn->prepare("
    SELECT ci.product_id, ci.quantity, p.price
    FROM cart_items ci
    JOIN Products p ON ci.product_id = p.product_id
    WHERE ci.cart_id = ?
");
$item_query->bind_param("i", $cart_id);
$item_query->execute();
$item_result = $item_query->get_result();

if ($item_result->num_rows === 0) {
    echo "No items in your cart.";
    exit();
}

// Calculate total amount
$total = 0;
$items = [];

while ($row = $item_result->fetch_assoc()) {
    $total += $row['price'] * $row['quantity'];
    $items[] = $row;
}

// Insert order
$order_stmt = $conn->prepare("INSERT INTO Orders (user_id, total_amount) VALUES (?, ?)");
$order_stmt->bind_param("id", $user_id, $total);
$order_stmt->execute();
$order_id = $conn->insert_id;

// Insert order items
foreach ($items as $item) {
    $insert_item = $conn->prepare("
        INSERT INTO Order_Items (order_id, product_id, quantity, price_at_purchase)
        VALUES (?, ?, ?, ?)
    ");
    $insert_item->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
    $insert_item->execute();
}

// Clear cart
$conn->query("DELETE FROM cart_items WHERE cart_id = $cart_id");

// Redirect to order history
header("Location: order_history.php");
exit();
?>
