<?php
session_start();
include('Database_Connection.php'); // Or config.php

$error = ""; // Initialize error to avoid undefined warnings

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $stmt = $conn->prepare("SELECT user_id, password FROM users WHERE email = ?");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['user_id'] = $id;
                    $_SESSION['email'] = $email;
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $error = "User not found!";
            }

            $stmt->close();
        } else {
            $error = "Something went wrong. Please try again.";
        }
    } else {
        $error = "All fields are required!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Grafitoon</title>
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
    <a href="grafitoon_index.php">Home</a>
    <a href="about_us.php">About</a>
    <a href="products.php">Products</a>
    <a href="Grafitoon_contactus.php">Contact</a>
    <a href="Grafitoon_login.php">Login</a>
</nav>

<section class="hero">
    <h1>Welcome Back</h1>
    <p>Login to continue your Grafitoon journey.</p>
</section>

<section class="login-section">
    <div class="login-card">
        <h2>Login</h2>
        <?php if (!empty($error)): ?>
            <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form action="" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</section>

<footer>
    &copy; <?= date("Y") ?> Grafitoon. All Rights Reserved.
</footer>

</body>
</html>
