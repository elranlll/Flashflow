<?php
// Include your database connection file
include 'config.php';

// Start the session

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // Fetch username from the database
    $sql = "SELECT username FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        echo $username;
    } else {
        echo "Error: Username not found";
    }
} else {
    echo "Error: User not logged in";
}
?>
