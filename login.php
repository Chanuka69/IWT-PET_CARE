<?php

session_start(); // Start the session

include 'connect_dbshop.php'; // Include the database connection file

$email = $password = $error = ""; // Initialize variables

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = htmlspecialchars($_POST['email']); // Get the email input and sanitize it
    $password = htmlspecialchars($_POST['password']); // Get the password input and sanitize it

    $sql = "SELECT * FROM `User_Data` WHERE `email`='$email'"; // SQL query to select user with the given email
    $result = mysqli_query($conn, $sql); // Execute the query

    if (mysqli_num_rows($result) > 0) { // Check if a user is found
        $row = mysqli_fetch_assoc($result); // Fetch user data
        $stored_password = $row['password']; // Get the stored password

        if ($stored_password === $password) { // Check if the provided password matches the stored password
            $_SESSION['loggedin'] = true; // Set session variables
            $_SESSION['user_id'] = $row['user_id'];
 
            header("Location: http://localhost/PetCare/Book pet hostel.php"); // Redirect to the vet page
            exit; // Stop further execution after redirection
        } else {
            $error = "Email or Password Incorrect."; // Error message for incorrect password
        }
    } else {
        $error = "Account not Found."; // Error message for account not found
    }
}

mysqli_close($conn); // Close the database connection

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login-signup.css"> <!-- Link to your CSS file -->
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="images/assets/pet_care_logo.jpg"> <!-- Favicon -->
</head>
<body>
    <section id="login-signup">
        <form action="login.php" method="POST"> <!-- Login form -->
            <section id="login-signup-error"><?php echo $error; ?></section> <!-- Display error message -->
            <h2>Log In</h2>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email_input" required><br> <!-- Email input -->
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password_input" required><br> <!-- Password input -->
            <p style="font-size:12px; float:right; margin:0; padding:0;">
                <a style="margin:0;padding:0;color:gray" href="password_reset.php">Forgot your password?</a>
            </p>
            <div class="buttons">
                <a href="signup.php">Sign Up</a><br> <!-- Link to signup page -->
                <input type="submit" value="Log In"> <!-- Log in button -->
            </div>
        </form>
    </section>
</body>
</html>
