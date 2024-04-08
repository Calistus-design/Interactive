<?php include('header.php'); ?>
<body id="login">
    <div class="container">
        <form id="login_form" class="form-signin" method="post">
            <h3 class="form-signin-heading"><i class="icon-lock"></i> Please Login</h3>
            <input type="text" class="input-block-level" id="username" name="username" placeholder="Username" required>
            <input type="password" class="input-block-level" id="password" name="password" placeholder="Password" required>
            <input type="checkbox" id="showPassword"> <!-- Add a checkbox for toggling password visibility -->
            <label for="showPassword">Show Password</label> <!-- Add a label for the checkbox -->

            <button type="submit" class="btn btn-info"><i class="icon-signin icon-"></i> Sign in</button>
        </form>
    </div> <!-- /container -->
    <?php include('script.php'); ?>
	<script>
		$(document).ready(function() {
    $('#showPassword').change(function() {
        var passwordField = $('#password');
        var fieldType = passwordField.attr('type');

        // Toggle the password field type between "password" and "text"
        if ($(this).is(':checked')) {
            passwordField.attr('type', 'text');
        } else {
            passwordField.attr('type', 'password');
        }
    });
});

	</script>
<script>
    document.getElementById('password').setAttribute('autocomplete', 'new-password');
</script>
<script>
    $(document).ready(function() {
        $('#login_form').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            
            var formData = $(this).serialize(); // Serialize form data
            
            $.ajax({
                type: 'POST',
                url: 'login.php',
                data: formData,
                success: function(response) {
                    // Parse JSON response
                    var result = JSON.parse(response);
                    // Check if login was successful
                    if (result.success) {
                        $.jGrowl("Welcome to CaliHMSC Learning Management System", {
    header: 'Access Granted',
    theme: 'custom-jgrowl', // Apply custom jGrowl theme
    life: 5000, // Message duration (milliseconds)
    //position: 'top-left', // Message position
    closer: true, // Disable closer button
    speed: 'slow' // Animation speed
});

                        var delay = 2000;
                        setTimeout(function() {
                            console.log("Redirecting to: " + result.redirect); // Log the redirect URL to the console
                            window.location.href = result.redirect;
                        }, delay);
                    } else {
                       $.jGrowl("Please Check your username and Password", { header: 'Login Failed' });
                        alert("Error: " + result.message); // Display error message with alert

                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    // Handle AJAX error, if any
                }
            });
        });
    });
</script>
<style>
    /* Custom jGrowl theme */
    .custom-jgrowl {
        position: fixed; /* Fixed position to stay on top of the page */
        top: 20px; /* Adjust the distance from the top */
        left: 20px; /* Adjust the distance from the left */
        background-color: #4CAF50; /* Green background color */
        color: white; /* White text color */
        border: 1px solid #388E3C; /* Darker green border */
        border-radius: 5px; /* Rounded corners */
        padding: 50px; /* Increase padding around the message */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Shadow effect */
        font-size: 50px; /* Increase font size */
    }
</style>




    </style>
</body>
</html>
