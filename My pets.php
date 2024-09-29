<?php
    require "connect_dbshop.php";
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Pets Profile</title>
    <link rel="stylesheet" href="P_pet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
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
        <h2 class="title-section">My Pets</h2> <!-- Title for the pets section -->
        <button class="add-pet-btn"  onclick="location.href='index.php';">Add New Pet</button> <!-- Button to add new pet -->

        <!-- Pet Cards Section -->
        <section class="pet-cards">
            <div class="pet-card">
                <img src="https://phasephotography.co.uk/wp-content/uploads/2019/11/WEB-PETS_15.jpg" alt="Pet 1" class="pet-image"> <!-- Replace with actual pet image URL -->
                <h3>Pet Name 1</h3> <!-- Replace with actual pet name -->
            </div>
            <div class="pet-card">
                <img src="https://cdn.pixabay.com/photo/2023/07/27/14/50/cat-8153510_1280.jpg" alt="Pet 2" class="pet-image"> <!-- Replace with actual pet image URL -->
                <h3>Pet Name 2</h3> <!-- Replace with actual pet name -->
            </div>
            <!-- Add more pet cards as needed -->
        </section>

        <!-- Footer -->
        <footer>
            <p>PetLife Co pvt ltd &copy; 2024</p>
            <p><a href="#">Contact Us</a> | <a href="#">About Us</a></p>
        </footer>
    </div>

    <script src="scripts.js"></script> <!-- External JavaScript file -->
</body>
</html>
