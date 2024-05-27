<?php
// Start session to access user ID
session_start();

// Check if user is logged in and user ID is available in session
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page or handle the case where the user is not logged in
    exit("User is not logged in");
}

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve button name, code, and user ID from AJAX request
$name = $_POST['name'];
$code = $_POST['code'];

// Insert button name, code, and user ID into the "setit" table
$sql1 = "INSERT INTO setit (setname, setcode, user_id) VALUES (?, ?, ?)";
$stmt1 = $conn->prepare($sql1);
$stmt1->bind_param("ssi", $name, $code, $user_id);

if ($stmt1->execute()) {
    // Insert set code into the "setpg" table
    $sql2 = "INSERT INTO setpg (setcode) VALUES (?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("i", $code);

    if ($stmt2->execute()) {
        echo "Button added successfully";
    } else {
        echo "Error: " . $stmt2->error;
    }
} else {
    echo "Error: " . $stmt1->error;
}

// Close prepared statements and database connection
$stmt1->close();
$stmt2->close();
$conn->close();
?>
