<?php
$setcode = $_POST['setcode'];

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

// Calculate total correct and incorrect answers
$sql = "SELECT SUM(memorized) AS total_correct, COUNT(*) - SUM(memorized) AS total_incorrect FROM cards WHERE setcode = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $setcode);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_assoc();
$totalCorrect = $row['total_correct'];
$totalIncorrect = $row['total_incorrect'];

$stmt->close();
$conn->close();

echo json_encode(['totalCorrect' => $totalCorrect, 'totalIncorrect' => $totalIncorrect]);
?>
