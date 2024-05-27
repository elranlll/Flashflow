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

// Check if itemcode is set
if(isset($_POST['itemcode'])) {
    // Get the item ID of the card to be deleted
    $itemcode = $_POST['itemcode'];

    // Delete the card from the database
    $sql = "DELETE FROM cards WHERE itemcode = '$itemcode'";
    if ($conn->query($sql) === TRUE) {
        echo "Card deleted successfully";
    } else {
        echo "Error deleting card: " . $conn->error;
    }
} else {
    // Handle case when itemcode is not set
    echo "Error: Itemcode is not set.";
}


// Close database connection
$conn->close();
?>
