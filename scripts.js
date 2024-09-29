// Function to open the side navigation
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

// Function to close the side navigation
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}




//------------------------------    Book Pet Hostel --------------------------------------

// Placeholder script for future functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page is fully loaded');
});

// JavaScript function to handle appointment booking
function bookAppointment(time) {
    window.location.href = `booking-confirmation.html?time=${time}`;
}

  







//---------------------------------    Book Pet Hostel ------------------------------------------------------

// JavaScript for selecting the hostel option and booking
let selectedHostel = ''; // To store the selected hostel

// Event listener for Standard card click
document.getElementById('standardCard').addEventListener('click', function() {
    selectedHostel = 'Standard'; // Set the selected hostel
    document.getElementById('standardCard').classList.add('selected'); // Highlight the selected card
    document.getElementById('kittyHouseCard').classList.remove('selected'); // Remove highlight from other card
});

// Event listener for Kitty House card click
document.getElementById('kittyHouseCard').addEventListener('click', function() {
    selectedHostel = 'Kitty House'; // Set the selected hostel
    document.getElementById('kittyHouseCard').classList.add('selected'); // Highlight the selected card
    document.getElementById('standardCard').classList.remove('selected'); // Remove highlight from other card
});

// Event listener for the Book Now button click
document.getElementById('bookBtn').addEventListener('click', function() {
    if (selectedHostel === '') {
        alert('Please select a hostel option before booking.'); // Ensure a hostel option is selected
    } else {
        // Set the selected hostel option in the hidden input
        document.getElementById('hostelOption').value = selectedHostel;
        alert("Booking for: " + selectedHostel + " is submitted!");
        // You can submit the form here if needed, e.g. document.getElementById('bookingForm').submit();
    }
});










// ---------------- USER PROFILE-----------------------------------------------------

// Event listener for Edit button click
document.getElementById('editProfile').addEventListener('click', function() {
    alert('Edit profile functionality coming soon!'); // Placeholder alert for edit functionality
});

// Event listener for Reset Password button click
document.getElementById('resetPassword').addEventListener('click', function() {
    alert('Reset password functionality coming soon!'); // Placeholder alert for reset password functionality
});

// Event listener for Delete Account button click
document.getElementById('deleteAccount').addEventListener('click', function() {
    if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
        alert('Account deletion functionality coming soon!'); // Placeholder alert for delete account functionality
    }
});






// ---------------- PET PROFILE-----------------------------------------------------

// Event listener for the "Add New Pet" button
document.getElementById('addPetBtn').addEventListener('click', function() {
    alert('Redirecting to add new pet page...'); // Placeholder action for adding a new pet
    // You can redirect to a new page or open a modal for adding a new pet
    // window.location.href = 'add-pet.html'; // Example of redirecting
});
