<?php

session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    session_destroy();
    exit();
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "flashfinal";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the logged-in user's ID from the session
$loggedInUserId = $_SESSION['user_id'];

// Prepare and execute SQL query to retrieve buttons from the "setit" table for the logged-in user
$sql = "SELECT setname, setcode FROM setit WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $loggedInUserId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<a href="flashset.php?setcode=' . $row["setcode"] . '" class="new-button">' . $row["setname"] . ' <img src="images/trash.png" class="icon" alt="Icon" onclick="confirmDelete(event, ' . $row["setcode"] . ')"></a>';
    }
} else {
    echo "No Sets found";
}

// Close statement and database connection
$stmt->close();
$conn->close();
?>
<script>
// Function to confirm deletion using a modal
function confirmDelete(event, code) {
  event.preventDefault(); // Prevent default link behavior

  // Open the modal
  $('#confirmDeleteModal').modal('show');

  // Capture click event on Delete button inside the modal
  document.getElementById('confirmDeleteButton').addEventListener('click', function() {
    // Perform deletion if confirmed
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Refresh button container after successful deletion
          refreshContainer();
          // Close the modal after deletion
          $('#confirmDeleteModal').modal('hide');
        } else {
          alert('Error: ' + xhr.responseText);
        }
      }
    };
    xhr.open('POST', 'button/delete_button.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('code=' + encodeURIComponent(code));
  });
}
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zGx59sgZekYD8HP7DsLe+OY6rFto5qRGvFXOdJ" crossorigin="anonymous"></script>

<!-- Bootstrap JavaScript Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>