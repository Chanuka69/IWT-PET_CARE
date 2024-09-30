<?php

session_start(); // Start the session

// Check if the user is logged in by checking if 'user_id' exists in the session
if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to access this page."); // If not logged in, display an error message
}

require "connect_dbshop.php";

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $pname = $_POST['petname'];
    $page = $_POST['pet_age'];
    $ptype = $_POST['pet_type'];
    $pbreed = $_POST['pet_breed'];
    $pweight = $_POST['pet_weight'];
    $pgender = $_POST['pet_gender'];
    $pnote = $_POST['pet_note'];

    if(isset($_FILES['pet_photo'])){
        $photo = $_FILES['pet_photo'];
    } else{
        $photo = null;
    }
    

    $sql = "INSERT INTO Pet_Data VALUES (NULL,'$user_id','$pname','$page','$pbreed','$pgender','$pweight','$ptype','$photo','$pnote')";

    if($conn->query($sql))
    {
        header("Location: http://localhost/PetCare/User Profile.php");
        die();
    }
    else {
        echo "Error: " . $conn->error;
    }
    

    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Registration</title>
    <link rel="stylesheet" href="registration.css">
</head>
<body>

    <img src="https://example.com/logo.png" alt="Logo" class="R-logo"> <!-- Logo on the top left -->

    <div class="R-page-container">
        <div class="R-card">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
                <fieldset>
                    <legend>Sign Up</legend>
                    
                    <label for="pet_name">Pet Name</label>
                    <input type="text" name="petname" placeholder="Enter your pet's name" required>

                    <label for="pet_age">Age</label>
                    <input type="text" name="pet_age" placeholder="Enter pet age" required>

                    <label for="pet_type">Pet Type</label>
                    <select name="pet_type" required>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Bird">Bird</option>
                        <option value="Fish">Fish</option>
                        <option value="Rabbits">Rabbits</option>
                        <option value="Guinea Pigs">Guinea Pigs</option>
                        <option value="Horses">Horses</option>
                        <option value="Reptiles">Reptiles</option>
                    </select>

                    <label for="pet_breed">Breed</label>
                    <input type="text" name="pet_breed" placeholder="Enter pet breed" required>

                    <label for="pet_weight">Weight (kg)</label>
                    <input type="number" name="pet_weight" step="0.1" min="0" placeholder="Enter weight" required>

                    <label for="pet_gender">Gender</label>
                    <select name="pet_gender" required>
                        <option value="M">Male</option>
                        <option value="F">Female</option>
                    </select>

                    <label for="pet_note">Additional Notes</label>
                    <textarea name="pet_note" placeholder="Any special notes about your pet"></textarea>

                    <label for="pet_photo">Pet Photo</label>
                    <input type="file" id="myFile" name="filename"> 
                    <!-- Button wrapper -->
                    <div class="R-button-wrapper">
                        <button type="submit">Register Now</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>



</body>
</html>
