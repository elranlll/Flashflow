<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the set code, set name, and set description from the AJAX request
$setcode = $_POST['setcode'];
$setname = $_POST['setname'];
$setDescription = $_POST['setdescription'];

// Update set name and set description in the "setit" and "setpg" tables
$sql1 = "UPDATE setit SET setname='$setname' WHERE setcode='$setcode'";
$sql2 = "UPDATE setpg SET setdes='$setDescription' WHERE setcode='$setcode'";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
    echo "Set updated successfully";
} else {
    echo "Error: " . $conn->error;
}

// Close database connection
$conn->close();
?>