<h3>Add/Edit Cards</h3>
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
         // Display card details with delete and edit buttons
         echo '<div class="rectangle">';
         echo '<div class="rectangle-body">';
         echo '<p>Question:</p>';
         echo '<input type="text" class="form-control mb-2" name="cardQuestion[]" value="' . $row["question"] . '" placeholder="Enter question">';
         echo '<p>Answer:</p>';
         echo '<input type="text" class="form-control mb-2" name="cardAnswer[]" value="' . $row["answer"] . '" placeholder="Enter answer">';
         echo '<input type="hidden" name="itemcode[]" value="' . $row["itemcode"] . '">';
         echo '<div class="button-group">';
         echo '<button type="button" class="btn btn-danger delete-card" data-itemcode="' . $row["itemcode"] . '">Delete</button>';
         echo '<a href="update_card.php" class="btn btn-primary edit-card" data-itemcode="' . $row["itemcode"] . '">Update</a>';
         echo '</div>';
         echo '</div>';
         echo '</div>';
     }
 } else {
     echo "No cards found for this set.";
 }

 // Close database connection
 $conn->close();
 ?>
</div>
