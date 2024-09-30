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




//------------------------------    Book Pet vet--------------------------------------

// Placeholder script for future functionality
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page is fully loaded');
});

// JavaScript function to handle appointment booking
function bookAppointment(time) {
    window.location.href = `booking-confirmation.html?time=${time}`;
}

  








//---------------------------------    Book Pet Hostel ------------------------------------------------------

function selectHostel(hostel) {
    // Highlight the selected card and set the hidden input value
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
