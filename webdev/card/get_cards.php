
<h3>Your Question Cards</h3>
<div class="card-grid">
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

// Get the set code from the URL parameter
$setcode = $_GET['setcode'];

// Retrieve cards with the matching setcode from the database
$sql = "SELECT * FROM cards WHERE setcode = '$setcode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Display card question
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["question"] . '</h5>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No cards found for this set.";
}

// Close database connection
$conn->close();
?>
