
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session

// Check if the user is logged in by checking if 'user_id' exists in the session
if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to access this page."); // If not logged in, display an error message
}

require "connect_dbshop.php";

// Fetch employee data where service_provided is 'vet'
$query = "SELECT emp_id, first_name, last_name, email FROM Employee WHERE service_provided = 'vet'";
$result = mysqli_query($conn, $query);

// Fetch user postal code
$user_id = $_SESSION['user_id'];
$user_query = "SELECT postal_code FROM User_Data WHERE user_id = '$user_id'";
$user_result = mysqli_query($conn, $user_query);
$user_data = mysqli_fetch_assoc($user_result);
$user_postal_code = $user_data['postal_code'];

// Fetch pet data for the logged-in user
$pet_query = "SELECT pet_id, name FROM Pet_Data WHERE owner_id = '$user_id'";
$pet_result = mysqli_query($conn, $pet_query);

// Check for appointment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['appointment_time'])) {
    $vet_id = $_POST['vet_id'];
    $pet_id = $_POST['pet_id'];
    $service_id = 503; // Static service ID for vet
    $appointment_date = date("Y-m-d");
    $appointment_time = $_POST['appointment_time'];

    // Prepare the SQL statement
    $insert_query = "INSERT INTO Appointment (customer_id, vet_id, pet_id, service_id, appointment_date, appointment_time, postal_code)
                     VALUES ('$user_id', '$vet_id', '$pet_id', '$service_id', '$appointment_date', '$appointment_time', '$user_postal_code')";

    // Execute the query and check for errors
    if (mysqli_query($conn, $insert_query)) {
        // Redirect to the same page to prevent form resubmission
        header("Location: Book vet appointment.php");
        exit();
    } else {
        // Log the error and display a message
        error_log("Database insert error: " . mysqli_error($conn));
        echo "<script>alert('Error: Could not book appointment. Please try again.');</script>";
    }
}

// Fetch service rate for veterinary services (service ID 503)
$service_query = "SELECT service_rate FROM Services WHERE service_id = 503";
$service_result = mysqli_query($conn, $service_query);
$service_data = mysqli_fetch_assoc($service_result);
$service_rate = $service_data['service_rate'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Booking</title>
    <link rel="stylesheet" href="vet.css">
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
            <a href="My Profile.html">My Account</a>
            <a href="My pets.html">My Pets</a>
            <a href="#">My Appointments</a>
            <a href="#">My Cart</a>
            <a href="Book pet hostel.php">Hostel</a>
            <a href="sign up.php">Sign Up</a>
            <a href="Book vet appointment.php">Vet</a>
            <a href="test_vet_php">Vet Test</a>
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
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="vet-card">
                    <img src="https://www.housethatbarks.com/wp-content/uploads/2018/04/Golden-Retriever-with-a-Vet.jpg" alt="Vet Image" class="vet-image">
                    <h3>Dr. <?php echo $row['first_name'] . ' ' . $row['last_name']; ?></h3>
                    <p>Contact: <?php echo $row['email']; ?></p>
                    <p>Service Rate: $<?php echo $service_rate; ?></p>
                    <form method="POST">
                        <input type="hidden" name="vet_id" value="<?php echo $row['emp_id']; ?>">
                        <label for="pet_id">Select Pet:</label>
                        <select name="pet_id" required>
                            <?php
                            // Reset pet_result pointer to fetch pets again for each vet
                            mysqli_data_seek($pet_result, 0);
                            while ($pet_row = mysqli_fetch_assoc($pet_result)): ?>
                                <option value="<?php echo $pet_row['pet_id']; ?>"><?php echo $pet_row['name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                        <button class="appointment-btn" type="button" onclick="confirmAndSetTime('10:30', this.form)">TODAY at 10:30</button>
                        <button class="appointment-btn" type="button" onclick="confirmAndSetTime('13:30', this.form)">TODAY at 13:30</button>
                        <input type="hidden" name="appointment_time" value="">
                    </form>
                </div>
            <?php endwhile; ?>
        </section>

        <!-- Footer -->
        <footer>
            <p>PetLife Co pvt ltd &copy; 2024</p>
            <p><a href="#">Contact Us</a> | <a href="#">About Us</a></p>
        </footer>
    </div>

    <script>
    function confirmAndSetTime(time, form) {
        if (confirm('Are you sure you want to book this appointment for TODAY at ' + time + '?')) {
            form.appointment_time.value = time; // Set the appointment_time value
            form.submit(); // Submit the form
        }
    }
    </script>
</body>
</html>
