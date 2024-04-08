<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
include('dbcon.php');
session_start();

// Check if the username and password are provided via POST request
if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $query = "SELECT * FROM users WHERE username=? AND password=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check the number of rows returned
    if(mysqli_num_rows($result) > 0) {
        // If the user exists, set session variable
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id'] = $row['user_id'];

        // Insert login information into the user_log table
        date_default_timezone_set('Africa/Nairobi');
        $login_date = date('Y-m-d H:i:s');
        $user_id = $row['user_id'];
        $insert_query = "INSERT INTO user_log (username, login_date, user_id) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_prepare($conn, $insert_query);
        mysqli_stmt_bind_param($stmt_insert, 'ssi', $username, $login_date, $user_id);
        mysqli_stmt_execute($stmt_insert);

        // Return JSON response indicating success and redirect URL
        echo json_encode(array('success' => true, 'redirect' => 'dashboard.php'));
    } else {
        // If the user doesn't exist, return JSON response indicating failure
        echo json_encode(array('success' => false));
    }
} else {
    // If username or password is not provided, return JSON response indicating failure
    echo json_encode(array('success' => false, 'message' => 'Username or password is not provided'));
}
?>
