<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Error: You must be logged in to access this page.");
}

require "connect_dbshop.php";

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $pet_id = $_POST['pet'];
    $checkin_date = $_POST['checkin_date'];
    $checkout_date = $_POST['checkout_date'];
    $hostel_type = $_POST['hostelOption'];

    // Ensure hostel option is selected
    if (empty($hostel_type)) {
        echo "<script>alert('Error: Please select a hostel option.');</script>";
    } else {
        // Get current date and time for appointment_date and appointment_time
        $appointment_date = date("Y-m-d");
        $appointment_time = date("H:i:s");

        // Insert booking details into the Appointment table
        $query = "INSERT INTO Appointment (appointment_id, customer_id, pet_id, appointment_date, appointment_time, checkin_date, checkout_date, hostel_type)
                  VALUES (NULL, '$user_id', '$pet_id', '$appointment_date', '$appointment_time', '$checkin_date', '$checkout_date', '$hostel_type')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Booking successful!');</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
        }
    }
}

// Fetch user's pets
$query = "SELECT pet_id, name FROM Pet_Data WHERE owner_id='$user_id'";
$pets_result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Pet Hostel</title>
    <link rel="stylesheet" href="hostel.css">
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
        <!-- Image Section -->
        <section class="image-section">
            <img src="http://www.psyeta.org/wp-content/uploads/2022/02/AdobeStock_481854656-1-scaled.jpeg" alt="Pet Hostel Image" class="hostel-img">
        </section>

        <!-- Booking Form -->
        <section class="booking-form">
            <form id="bookingForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <select name="pet" id="pet-select" required>
                    <option value="">Select Pet</option>
                    <?php
                    // Dynamically populate pet options from the database
                    if (mysqli_num_rows($pets_result) > 0) {
                        while ($row = mysqli_fetch_assoc($pets_result)) {
                            echo "<option value='" . $row['pet_id'] . "'>" . htmlspecialchars($row['name']) . "</option>";
                        }
                    } else {
                        echo "<option value=''>No pets found. Please add a pet first.</option>";
                    }
                    ?>
                </select>

                <label for="checkin_date">Check-in Date</label>
                <input type="date" id="checkin_date" name="checkin_date" required>

                <label for="checkout_date">Check-out Date</label>
                <input type="date" id="checkout_date" name="checkout_date" required>

                <!-- Hidden input to store selected hostel option -->
                <input type="hidden" name="hostelOption" id="hostelOption">

                <button class="book-btn" id="bookBtn" type="submit" onclick="validateHostelOption(event)">Book Now</button>
            </form>
        </section>

        <!-- Hostel Options Cards -->
        <section class="hostel-options">
            <div class="hostel-card" id="standardCard" onclick="selectHostel('Standard')">
                <img src="https://image.cnbcfm.com/api/v1/image/104661266-pet-hotels-2.jpg?v=1503071272" alt="Standard Hostel Image" class="hostel-image">
                <h3>Standard</h3>
                <p>Basic pet hostel with all essential services.</p>
            </div>
            <div class="hostel-card" id="kittyHouseCard" onclick="selectHostel('Kitty House')">
                <img src="https://luxurylaunches.com/wp-content/uploads/2017/07/Cover-Image-1170x651.jpg" alt="Kitty House Image" class="hostel-image">
                <h3>Kitty House</h3>
                <p>Premium hostel for your feline friends.</p>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <p>PetLife Co pvt ltd &copy; 2024</p>
            <p><a href="#">Contact Us</a> | <a href="#">About Us</a></p>
        </footer>
    </div>

    <script>
        function selectHostel(hostel) {
            // Set the hidden input value to the selected hostel type
            document.getElementById('hostelOption').value = hostel;

            // Remove 'selected' class from all cards
            const cards = document.querySelectorAll('.hostel-card');
            cards.forEach(card => card.classList.remove('selected'));

            // Add 'selected' class to the clicked card
            if (hostel === 'Standard') {
                document.getElementById('standardCard').classList.add('selected');
            } else if (hostel === 'Kitty House') {
                document.getElementById('kittyHouseCard').classList.add('selected');
            }
        }

        function validateHostelOption(event) {
            // Prevent form submission if no hostel option is selected
            const hostelOption = document.getElementById('hostelOption').value;
            if (!hostelOption) {
                alert("Please select a hostel option.");
                event.preventDefault();
            }
        }
    </script>
</body>

</html>



