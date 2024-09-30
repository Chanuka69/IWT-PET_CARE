<?php
session_start(); // Start the session

// Check if the user is logged in by checking if 'userId' exists in the session
if (!isset($_SESSION['userId'])) {
    die("Error: You must be logged in to access this page."); // If not logged in, display an error message
}

require "connect_dbshop.php"; // Include the database connection file

// Fetch doctors from the database
$query = "SELECT * FROM Employee WHERE role='vet' LIMIT 6"; // Adjust the query to match your doctors table structure
$result = mysqli_query($conn, $query);

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['userId']; // Get the user ID from the session
    $appointmentTime = $_POST['time']; // Get the appointment time from the form
    $vetId = $_POST['vet_id']; // Get the selected vet ID from the form

    // Check if the appointment time is not empty
    if (!empty($appointmentTime)) {
        // Use a prepared statement to insert a new appointment
        $stmt = $conn->prepare("INSERT INTO Appointment (customer_id, vet_id, appointment_time) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $userId, $vetId, $appointmentTime);

        // Execute the statement and check if the insertion was successful
        if ($stmt->execute()) {
            $message = "Appointment booked successfully!";
        } else {
            $message = "Error booking appointment: " . $stmt->error; // Display the error if it fails
        }

        $stmt->close(); // Close the statement
    } else {
        $message = "Error: Appointment time cannot be empty."; // Handle empty appointment time
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Basic styling for the cards and container */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 16px;
            margin: 16px;
            width: 200px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Book an Appointment</h1>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p> <!-- Display the message after form submission -->
        <?php endif; ?>

        <?php while ($doctor = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <h2><?php echo htmlspecialchars($doctor['first_name'] . ' ' . $doctor['last_name']); ?></h2> <!-- Display doctor name -->
                <p><?php echo htmlspecialchars($doctor['service_provided']); ?></p> <!-- Display doctor specialization -->
                <form action="test_vet.php" method="post"> <!-- Form for each vet -->
                    <input type="hidden" name="vet_id" value="<?php echo $doctor['emp_id']; ?>"> <!-- Hidden field for vet ID -->
                    <label for="time">Appointment Time:</label>
                    <input type="datetime-local" id="time" name="time" required> <!-- Input for appointment time -->
                    <button type="submit">Book with <?php echo htmlspecialchars($doctor['first_name']); ?></button> <!-- Button to book appointment -->
                </form>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
