
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

        // JavaScript functions for handling button actions
        function openEditForm() {
            // Logic to open the edit form
            const editFormHTML = `
                <form id="editForm" action="edit_profile.php" method="POST">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" value="${document.querySelector('[data-fname]').innerText}">
                    
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="${document.querySelector('[data-lname]').innerText}">
                    
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" value="${document.querySelector('[data-phone]').innerText}">
                    
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="${document.querySelector('[data-email]').innerText}">
                    
                    <button type="submit">Save</button>
                </form>
            `;
            document.getElementById('main').innerHTML = editFormHTML;
        }

        function openResetPasswordForm() {
            // Logic to open reset password form
            const resetFormHTML = `
                <form id="resetPasswordForm" action="reset_password.php" method="POST">
                    <label for="current_password">Current Password:</label>
                    <input type="password" name="current_password" required>
                    
                    <label for="new_password">New Password:</label>
                    <input type="password" name="new_password" required>
                    
                    <button type="submit">Reset Password</button>
                </form>
            `;
            document.getElementById('main').innerHTML = resetFormHTML;
        }

        function confirmDelete() {
            if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
                // Redirect to a PHP script to handle account deletion
                window.location.href = "delete_account.php";
            }
        }

        function logout() {
            // Logic to log out the user
            window.location.href = "logout.php"; // Redirect to a logout handler
        }

  