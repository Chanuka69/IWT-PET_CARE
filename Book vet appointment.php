<?php

    session_start(); // Start the session

    // Check if the user is logged in by checking if 'user_id' exists in the session
    if (!isset($_SESSION['userId'])) {
        die("Error: You must be logged in to access this page."); // If not logged in, display an error message
    }

    require "connect_dbshop.php";

    $query = "INSERT INTO appoinmet VALUES ();

    $result = mysli_query($conn,$quey);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Booking</title>
    <link rel="stylesheet" href="vet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for search icon -->
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
            <a href="My Profile.html">My Account</a>
            <a href="My pets.html">My Pets</a>
            <a href="#">My Appointments</a>
            <a href="#">My Cart</a>
        </div>
        <div class="log-out-button">
            <button>Log Out</button>
        </div>
    </div>

    <!-- Main Content -->
    <div id="main">
        <!-- Title Section -->
        <section class="title-section">
            <h2>Select a Vet for your appointment</h2>
        </section>

        <!-- Vets List in Cards -->
        <section class="vet-list">
            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. John Doe</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>10 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('10:30')">TODAY at 10:30</button>
                <button class="appointment-btn" onclick="bookAppointment('13:30')">TODAY at 13:30</button>
            </div>
            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>

            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>
            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>
            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>

            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>

            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. John Doe</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>10 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('10:30')">TODAY at 10:30</button>
                <button class="appointment-btn" onclick="bookAppointment('13:30')">TODAY at 13:30</button>
            </div>
            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>

            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>
            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>

            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
            </div>

            <div class="vet-card">
                <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                <h3>Dr. Jane Smith</h3>
                <p>⭐⭐⭐⭐☆</p>
                <p>12 reviews</p>
                <button class="appointment-btn" onclick="bookAppointment('11:00')">TODAY at 11:00</button>
                <button class="appointment-btn" onclick="bookAppointment('14:00')">TODAY at 14:00</button>
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

