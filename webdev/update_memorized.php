<?php
$setcode = $_POST['setcode'];
$question = $_POST['question'];
$memorized = $_POST['memorized'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update memorized status in the database
$sql = "UPDATE cards SET memorized = ? WHERE setcode = ? AND question = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $memorized, $setcode, $question);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

$stmt->close();
$conn->close();
?>
