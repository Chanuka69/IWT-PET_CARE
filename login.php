<?php
    include 'connect_dbshop.php';

    $email = $password = $error = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $sql = "SELECT * FROM `users` WHERE `email`='$email'";
        $result = mysqli_query($conn, $sql); 

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['password'];

            if ($stored_password === $password) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $row['fname'];
                $_SESSION['userId'] = $row['uid'];
                $_SESSION['user_role'] = $row['role'];

                header("Location: http://localhost/PetCare/test.php");
                exit;
            } else {
                $error = "Email or Password Incorrect.";
            }
        } else {
            $error = "Account not Found.";
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login-signup.css">
    <title>login</title>
    <link rel="icon" type="image/x-icon" href="images/assets/pet_care_logo.jpg">
</head>
<body>
    <section id="login-signup">
        <form action="login.php" method="POST">
            <section id="login-signup-error"><?php echo $error; ?></section>
            <h2>Log In</h2>
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email_input" required><br>
            <label for="password">Password</label><br>
            <input type="password" name="password" id="password_input" required><br>
            <p style="font-size:12px; float:right; margin:0; padding:0;"><a style="margin:0;padding:0;color:gray" href="password_reset.php">forgot your password?</a></p>
            <div class="buttons">
                <a href="signup.php">Sign Up</a><br>
                <input type="submit" value="Log In">
            </div>
        </form>
    </section>
</body>
</html>