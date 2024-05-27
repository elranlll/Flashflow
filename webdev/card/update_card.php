<?php
// update_card.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$itemcode = $_POST['itemcode'];
$question = $_POST['question'];
$answer = $_POST['answer'];

$sql = "UPDATE cards SET question=?, answer=? WHERE itemcode=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ssi', $question, $answer, $itemcode);

if ($stmt->execute()) {
    echo "Card updated successfully.";
} else {
    echo "Error updating card: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
