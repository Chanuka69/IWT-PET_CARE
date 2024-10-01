<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
     session_start();

session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to access this page.");
}

// Include the database connection file
require "connect_dbshop.php"; // Ensure this file connects to your database correctly

// Store the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Check if the form is submitted to update the profile
if (isset($_POST['update_profile'])) {
    // Fetch updated data from the form
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    
    // Update the user's information in the database
    $update_query = "UPDATE User_Data SET first_name='$fname', last_name='$lname', email='$email' WHERE user_id='$user_id'";
    mysqli_query($conn, $update_query);
}

// Check if the form is submitted to reset the password
if (isset($_POST['reset_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $query = "SELECT password FROM User_Data WHERE user_id='$user_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row && md5($current_password) === $row['password']) {
        if (!empty($new_password)) {
            $update_password_query = "UPDATE User_Data SET password='" . md5($new_password) . "' WHERE user_id='$user_id'";
            mysqli_query($conn, $update_password_query);
            $message = "Password updated successfully.";
        } else {
            $message = "Enter a new password.";
        }
    } else {
        $message = "Wrong password.";
    }
}

// Check if the form is submitted to delete the account
if (isset($_POST['delete_Account'])) {
    $delete_AC = "DELETE FROM User_Data WHERE user_id ='$user_id'";
    mysqli_query($conn, $delete_AC);
    session_destroy();
    header("Location: login.php"); // Redirect to the login page
    exit();
}

// Check if the form is submitted to upload a new profile picture
if (isset($_POST['upload_photo'])) {
    $target_dir = "uploads/"; // Directory to save uploaded images
    $target_file = $target_dir . basename($_FILES["user_image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if the uploaded file is an image
    $check = getimagesize($_FILES["user_image"]["tmp_name"]);
    if ($check !== false) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["user_image"]["tmp_name"], $target_file)) {
            // Update the user image path in the database
            $update_image_query = "UPDATE User_Data SET user_image_path='$target_file' WHERE user_id='$user_id'";
            mysqli_query($conn, $update_image_query);
            $message = "Image uploaded successfully.";
        } else {
            $message = "Sorry, there was an error uploading your file.";
        }
    } else {
        $message = "File is not an image.";
    }
}

// Fetch the user's current profile details including image path
$query = "SELECT first_name, last_name, email, user_image_path FROM User_Data WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $fname = $row['first_name'];
    $lname = $row['last_name'];
    $email = $row['email'];
    $user_image_path = $row['user_image_path'];
} else {
    die("Error: User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="test.css">
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
            <a href="Book pet hostel.php">hostel</a>
            <a href="sign up.php">sign up</a>
            <a href="Book vet appointment.php">vet</a>
            <a href="test_vet.php"> vet test </a>
        </div>
        <div class="log-out-button">
            <button>Log Out</button>
        </div>
    </div>

    <div id="main">
        <section class="profile-section">
            <h2>User Profile</h2>
            <div>
                <img src="<?php echo $user_image_path; ?>" alt="User Profile Picture" style="width: 150px; height: 150px; border-radius: 50%;">
            </div>
            <form method="post" enctype="multipart/form-data" id="uploadPhotoForm">
                <input type="file" name="user_image" required>
                <button type="submit" name="upload_photo">Change Photo</button>
            </form>

            <!-- Profile update form -->
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
                    <label for="email"><strong>Email:</strong></label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" disabled>
                </div>
                <button type="button" id="editProfile" onclick="enableProfileEditing()">Edit</button>
                <button type="submit" name="update_profile" id="saveProfile" style="display:none;">Save Changes</button>
            </form>

            <!-- Password reset form -->
            <form method="post" id="passwordForm">
                <div class="C_pwd">
                    <input type="password" id="current_password" name="current_password" placeholder="Enter current password" style="display:none;">
                </div>
                <div>
                    <label for="new_password"><strong>New Password:</strong></label>
                    <input type="password" id="new_password" name="new_password" disabled>
                    <?php if (isset($message)) echo $message; ?>
                </div>
                <button type="button" id="resetPassword" onclick="enablePasswordReset()">Reset Password</button>
                <button type="submit" name="reset_password" id="savePassword" style="display:none;">Save New Password</button>
            </form>

            <!-- Delete Account Form -->
            <form method="post" id="deleteAccountForm">
                <button type="submit" name="delete_Account" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">Delete Account</button>
            </form>
        </section>

        <!-- Footer -->
        <footer>
            <p>PetLife Co pvt ltd &copy; 2024</p>
            <p><a href="#">Contact Us</a> | <a href="#">About Us</a></p>
        </footer>
    
    </div>

    <script src="scripts.js"></script>
    <script>
        // Enable profile form for editing
        function enableProfileEditing() {
            document.getElementById('fname').disabled = false;
            document.getElementById('lname').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('saveProfile').style.display = 'inline';
            document.getElementById('editProfile').style.display = 'none';
        }

        // Enable password reset form
        function enablePasswordReset() {
            document.getElementById('current_password').style.display = 'inline';
            document.getElementById('new_password').disabled = false;
            document.getElementById('savePassword').style.display = 'inline';
            document.getElementById('resetPassword').style.display = 'none';
        }

        // Event listener for file upload form submission
        document.getElementById('uploadPhotoForm').addEventListener('submit', function (event) {
            if (!confirm('Are you sure you want to change your profile photo?')) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>

