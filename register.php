<?php
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli("localhost", "root", "", "grafitoon");
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo "<p style='color: green; text-align:center;'>Registration successful. <a href='login.php'>Login here</a></p>";
    } else {
        echo "<p style='color: red; text-align:center;'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Grafitoon</title>
    <link rel="stylesheet" href="grafitoon_css.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f2f3f5;
        }

        .background-gif {
            background-image: url('images/bg.gif');
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1;
            width: 100%;
            height: 100%;
        }

        header {
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 15px;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
        }

        .grafi { color: #ff6f00; }
        .toon { color: #00b4d8; }

        nav {
            background-color: #131313;
            display: flex;
            justify-content: center;
            gap: 15px;
            padding: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
        }

        nav a:hover {
            color: #ff6600;
        }

        .form-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 60px 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 350px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .form-container input[type="submit"] {
            background-color: #00b4d8;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0096c7;
        }

        .login-link {
            text-align: center;
            margin-top: 10px;
        }

        footer {
            background: #131313;
            color: white;
            text-align: center;
            padding: 15px;
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
    <a href="grafitoon_index.php">Home</a>
    <a href="about_us.php">About</a>
    <a href="Grafitoon_shoppingsection.php">Shop</a>
    <a href="Grafitoon_contactus.php">Contact</a>
    <a href="Grafitoon_shoppingcart.php">Cart</a>
    <a href="grafitoon_checkout.php">Checkout</a>
    <a href="Grafitoon_ordershistory.php">Orders</a>
    <a href="Grafitoon_login.php">Login</a>
</nav>

<section class="form-section">
    <div class="form-container">
        <h2>Register</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Register">
            <div class="login-link">
                Already have an account? <a href="login.php">Login</a>
            </div>
        </form>
    </div>
</section>

<footer>
    &copy; <?= date("Y") ?> Grafitoon. All Rights Reserved.
</footer>

</body>
</html>
