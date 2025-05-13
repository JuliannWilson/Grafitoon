<?php
session_start();

// Ensure the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if required data is present
    if (isset($_POST['product_id'], $_POST['name'], $_POST['price'])) {

        $id = filter_var($_POST['product_id'], FILTER_SANITIZE_NUMBER_INT);
        $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);

        // Validate data
        if ($id && $name !== false && $price !== false) {
            // Initialize cart if it doesn't exist
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Check if item already exists in cart
            if (isset($_SESSION['cart'][$id])) {
                // Increment quantity
                $_SESSION['cart'][$id]['quantity'] += 1;
            } else {
                // Add new item to cart
                // Note: Size is not handled here yet. Add size selection later.
                $_SESSION['cart'][$id] = [
                    'name' => $name,
                    'price' => $price,
                    'quantity' => 1
                    // 'size' => 'N/A' // Placeholder for size if needed
                ];
            }

            echo "success"; // Send success response back to AJAX
        } else {
            // Invalid data received
            echo "error: Invalid product data.";
            http_response_code(400); // Bad Request
        }
    } else {
        // Required data missing
        echo "error: Missing product data.";
        http_response_code(400); // Bad Request
    }
} else {
    // Not a POST request
    echo "error: Invalid request method.";
    http_response_code(405); // Method Not Allowed
}
?>