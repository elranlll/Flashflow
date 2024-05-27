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

// Get the set code and card details from the POST request
$setcode = $_POST['setcode'];
$cardQuestion = $_POST['cardQuestion'];
$cardAnswer = $_POST['cardAnswer'];

// Generate a unique itemcode
function generateRandom10DigitCode() {
    // Generate a unique identifier using uniqid() and md5()
    $uniqueId = md5(uniqid(mt_rand(), true));
    // Extract the first 10 characters to get a 10-digit code
    $code = substr($uniqueId, 0, 10);
    return $code;
}

// Generate a unique itemcode
function generateUniqueItemCode($conn) {
    do {
        // Generate a random 10-digit code
        $itemcode = generateRandom10DigitCode();
        
        // Check if the generated code already exists in the database
        $sql = "SELECT itemcode FROM cards WHERE itemcode = '$itemcode'";
        $result = $conn->query($sql);
    } while ($result->num_rows > 0); // If code exists, generate a new one

    return $itemcode;
}
$itemcode = generateUniqueItemCode($conn); // Generate a unique item code

// Insert the new card into the database
$sql = "INSERT INTO cards (setcode, question, answer, itemcode) VALUES ('$setcode', '$cardQuestion', '$cardAnswer', '$itemcode')";
if ($conn->query($sql) === TRUE) {
    echo "New card created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
