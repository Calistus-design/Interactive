<?php
// Attempt to establish a connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'capstone');

// Check connection status
if (!$conn) {
    // If connection fails, print an error message and terminate the script
    die('Database connection failed: ' . mysqli_connect_error());
} else {
    // If connection succeeds, print a success message
    //echo 'Database connection cali successful!';
}
?>
