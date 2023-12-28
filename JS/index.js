
$(document).ready(function() {
    $("#logout-link").click(function(e) {
        e.preventDefault();

        // Make an AJAX request to logout.php
        $.ajax({
            url: "logout.php",
            type: "POST", // or "GET" depending on your server-side logic
            success: function(response) {
                // Redirect the user to the login page or handle the response as needed
                window.location.href = "login.php";
            },
            error: function(error) {
                // Handle the error if needed
                console.error("Logout failed:", error);
            }
        });
    });
});
