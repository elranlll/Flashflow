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

// Retrieve button code from AJAX request
$code = $_POST['code'];

// Delete button from the "setit" table
$sql1 = "DELETE FROM setit WHERE setcode='$code'";
$sql2 = "DELETE FROM setpg WHERE setcode='$code'";

if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
  echo "Button deleted successfully";
} else {
  echo "Error: " . $conn->error;
}

// Close database connection
$conn->close();
?>

