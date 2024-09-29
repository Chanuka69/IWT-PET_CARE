<?php
session_start(); // Start the session

// Check if the user is logged in by checking if 'user_id' exists in the session
if (!isset($_SESSION['userId'])) {
    die("Error: You must be logged in to access this page."); // If not logged in, display an error message
}

// Include the database connection file
require "connect_dbshop.php"; // Make sure this file connects to your database correctly

// Store the logged-in user's ID from the session
$user_id = $_SESSION['userId'];

// Check if the form is submitted to update the profile
if (isset($_POST['update_profile'])) {
    // Fetch updated data from the form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    
    // Update the user's information in the database
    $update_query = "UPDATE Users SET first_name='$fname', last_name='$lname', email='$email' WHERE user_id='$user_id'";
    $update_phone = "UPDATE User_Phone SET phone_num = '$phone' WHERE user_id = '$user_id'";
    mysqli_query($conn, $update_query);
    mysqli_query($conn, $update_phone);
}

// Check if the form is submitted to reset the password
if (isset($_POST['reset_password'])) {
    // Fetch the new password from the form
    $new_password = $_POST['new_password'];
    
    // Update the user's password in the database (you should hash passwords in real-world applications)
    $update_password_query = "UPDATE User_Data SET password='$new_password' WHERE user_id='$user_id'";
    mysqli_query($conn, $update_password_query);
}

// Fetch the user's current profile details
$query = "SELECT first_name, last_name,email FROM User_Data WHERE user_id='$user_id'";
$query2 = "SELECT phone_ FROM User_Data WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $email = $row['email'];
} else {
    die("Error: User not found.");
}
$result2 = mysqli_query($conn, $query2);
$phone = $result2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="test.css"> <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Link to Font Awesome icons -->
</head>
<body>
    <!-- Top Bar -->
    <div class="topbar">
        <span class="top-menu" onclick="openNav()">&#9776;</span> <!-- Hamburger icon for side navigation -->
        <div class="logo">
            <img src="https://static.vecteezy.com/system/resources/previews/000/467/567/original/pet-shop-logo-vector.jpg" alt="PetLife Co Logo">
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search.."> <!-- Input field for search -->
            <button type="submit"><i class="fa fa-search"></i></button> <!-- Search button -->
        </div>
        <img src="https://ehonami.blob.core.windows.net/media/2018/07/7-ways-dog-owners-healthier-live-longer.jpg" alt="User Profile" class="user-icon"> <!-- User profile icon -->
    </div>

    <!-- Side Navigation -->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a> <!-- Close button for side navigation -->
        <div class="side-list">
            <a href="My Profile.php">My Account</a> <!-- Link to My Account page -->
            <a href="My pets.php">My Pets</a> <!-- Link to My Pets page -->
            <a href="#">My Appointments</a> <!-- Link to My Appointments page -->
            <a href="#">My Cart</a> <!-- Link to My Cart page -->
        </div>
        <div class="log-out-button">
            <button onclick="logout()">Log Out</button> <!-- Log Out button -->
        </div>
    </div>

    <!-- Main Content -->
    <div id="main">
        <!-- Profile Section -->
<!-- Profile Section -->
        <section class="profile-section">
            <h2>User Profile</h2>
            <!-- Profile form to update user's profile details -->
            <form method="post" id="profileForm">
                <div>
                    <label for="fname"><strong>First Name:</strong></label>
                    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" disabled>
                </div>
                
                <div>
                    <label for="lname"><strong>Last Name:</strong></label>
                    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" disabled>
                </div>

                <div>
                    <label for="phone"><strong>Phone Number:</strong></label>
                    <input type="number" id="phone" name="phone" value="<?php echo $phone; ?>" disabled>
                </div>

                <div>
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" disabled>
                </div>

                <button type="button" id="editProfile" onclick="enableProfileEditing()">Edit</button>
                <button type="submit" name="update_profile" id="saveProfile" style="display:none;">Save Changes</button>
            </form>

            <!-- Password reset form -->
            <form method="post" id="passwordForm">
                <div>
                    <label for="new_password"><strong>New Password:</strong></label>
                    <input type="password" id="new_password" name="new_password" disabled>
                </div>

                <button type="button" id="resetPassword" onclick="enablePasswordReset()">Reset Password</button>
                <button type="submit" name="reset_password" id="savePassword" style="display:none;">Save New Password</button>
            </form>

            <button id="deleteAccount" onclick="confirmDelete()">Delete Account</button>
        </section>


        <!-- Footer -->
        <footer>
            <p>PetLife Co pvt ltd &copy; 2024</p> <!-- Footer text -->
            <p><a href="#">Contact Us</a> | <a href="#">About Us</a></p> <!-- Footer links -->
        </footer>
    </div>

    <script src="scripts.js"></script> <!-- Link to the external JavaScript file -->
    <script>
        // Enable profile form for editing
        function enableProfileEditing() {
            document.getElementById('fname').disabled = false;
            document.getElementById('lname').disabled = false;
            document.getElementById('phone').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('saveProfile').style.display = 'inline'; // Show save button
            document.getElementById('editProfile').style.display = 'none'; // Hide edit button
        }

        // Enable password reset form
        function enablePasswordReset() {
            document.getElementById('new_password').disabled = false;
            document.getElementById('savePassword').style.display = 'inline'; // Show save button
            document.getElementById('resetPassword').style.display = 'none'; // Hide reset button
        }

        // Confirm deletion of the account
        function confirmDelete() {
            if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                // Logic to delete the account
                alert('Account deleted'); // Replace with actual deletion logic
            }
        }

        // Log out user
        function logout() {
            // Logic to log out the user
            alert('Logged out'); // Replace with actual logout logic
        }
    </script>
</body>
</html>
