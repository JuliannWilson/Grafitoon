<?php
$page_title = "Contact Us - ToonThreads";
$company_name = "ToonThreads";
$address = "123 Cartoon Lane, ToonTown, TX 75001";
$email = "support@toonthreads.com";
$phone = "(123) 456-7890";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
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
        .navbar {
            background-color:rgb(19, 19, 19);
            padding: 15px;
            text-align: center;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .navbar ul li {
            display: inline;
        }
        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            padding: 10px 15px;
            display: inline-block;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 5px 5px 15px rgba(19, 19, 19);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .contact-info {
            flex: 1;
            text-align: left;
            padding-right: 20px;
        }
        .map {
            flex: 1;
        }

        .profile-pic {
    width: 40px; /* Adjust size as needed */
    height: 40px;
    border-radius: 50%;
    object-fit: cover; /* Ensures image maintains aspect ratio */
    border: 2px solid #fff; /* Optional: Adds a border around the image */
}

        .hero {
            background-image: url('cartoon-banner.jpg');
            background-size: cover;
            color: white;
            padding: 50px;
            font-size: 28px;
            font-weight: bold;
        }
    
        iframe {
            width: 100%;
            height: 300px;
            border: 0;
            border-radius: 10px;
        }
        h1, h2 {
            color:rgb(0, 0, 0);
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

<header>
        <h1>Grafitoon</h1>
        <nav class="navbar">
       
        <ul class="nav-links">
            <li><a href="Grafitoon_index.php">Home</a></li>
            <li><a href="about_us.php">About</a></li>
            <li><a href="Grafitoon_shoppingsection.php">Shop</a></li>
            <li><a href="Grafitoon_contactus.php">Contact</a></li>
            <li class="profile">
                <a href="profile.php">
                    <img src="profile_pics/babe.jpg" alt="Profile" class="profile-pic">
                </a>
            </li>
        </ul>
    </nav>

    </header>
<body>
    <div class="container">
        <div class="contact-info">
            <h1>Contact <?php echo $company_name; ?></h1>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <p><strong>Email:</strong> <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
        </div>
        <div class="map">
            <h2>Find Us Here</h2>
            <iframe 
                src="https://www.google.com/maps/embed/v1/place?key=YOUR_GOOGLE_MAPS_API_KEY&q=<?php echo urlencode($address); ?>" 
                allowfullscreen>
            </iframe>
        </div>
    </div>
</body>
</html>
