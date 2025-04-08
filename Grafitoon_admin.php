<?php
session_start();
include 'Database_Connection.php';

// Optional: Only allow admin access
// if ($_SESSION['role'] !== 'admin') {
//     header('Location: index.php');
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | GrafiToon</title>
    <link rel="stylesheet" href="grafitoon_css.css">
    <style>
        body { font-family: Poppins, sans-serif; padding: 20px; }
        h2 { margin-top: 40px; }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #aaa;
            text-align: left;
        }
        th {
            background-color: #131313;
            color: white;
        }
    </style>
</head>
<body>
<ul>
               <a href="Grafitoon_shoppingsection.php">Go Back</a></ul>
    <h1>Welcome, Admin</h1>

    <h2>Registered Users</h2>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
        </tr>
        <?php
        $users = $conn->query("SELECT user_id, name, email FROM users");
        while ($user = $users->fetch_assoc()) {
            echo "<tr>
                    <td>{$user['user_id']}</td>
                    <td>{$user['name']}</td>
                    <td>{$user['email']}</td>
                  </tr>";
        }
        ?>
    </table>

    <h2>Products</h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Password</th>
        </tr>
        <?php
        $products = $conn->query("SELECT product_id, name, price FROM products");
        while ($product = $products->fetch_assoc()) {
            echo "<tr>
                    <td>{$product['product_id']}</td>
                    <td>{$product['name']}</td>
                    <td>\${$product['price']}</td>
                
                  </tr>";
        }
        ?>
    </table>

</body>
</html>