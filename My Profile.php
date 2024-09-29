<?php
    require "connect_dbshop.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="P_user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Top Bar -->
    <div class="topbar">
        <span class="top-menu" onclick="openNav()">&#9776;</span>
        <div class="logo">
            <img src="https://static.vecteezy.com/system/resources/previews/000/467/567/original/pet-shop-logo-vector.jpg" alt="PetLife Co Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search..">
            <button type="submit"><i class="fa fa-search"></i></button>
        </div>
        <img src="https://ehonami.blob.core.windows.net/media/2018/07/7-ways-dog-owners-healthier-live-longer.jpg" alt="User Profile" class="user-icon">
    </div>

    <!-- Side Navigation -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="side-list">
            <a href="My Profile.php">My Account</a>
            <a href="My pets.php">My Pets</a>
            <a href="#">My Appointments</a>
            <a href="#">My Cart</a>
        </div>
        <div class="log-out-button">
            <button>Log Out</button>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main">
        <!-- Profile Section -->
        <section class="profile-section">
            <img src="https://ehonami.blob.core.windows.net/media/2018/07/7-ways-dog-owners-healthier-live-longer.jpg" alt="Profile Photo" class="profile-photo"> <!-- Profile Photo -->
            <h2>User Profile</h2>
            <?php 

                $fname = "SELECT fname FROM Users WHERE id='1";

            echo "<p><strong>First Name:</strong> John</p>" ;
            echo "<p><strong>Last Name:</strong> Doe</p> ";
            echo "<p><strong>Phone Number:</strong> +1234567890</p> ";
            echo "<p><strong>Email:</strong> john.doe@example.com</p> ";
            echo "<p><strong>Password:</strong> ********</p> ";
;
            ?>
            <div class="profile-buttons">
                <button id="editProfile">Edit</button> <!-- Edit Button -->
                <button id="resetPassword">Reset Password</button> <!-- Reset Password Button -->
                <button id="deleteAccount">Delete Account</button> <!-- Delete Account Button -->
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <p>PetLife Co pvt ltd &copy; 2024</p>
            <p><a href="#">Contact Us</a> | <a href="#">About Us</a></p>
        </footer>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
