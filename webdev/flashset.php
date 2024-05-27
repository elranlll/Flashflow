

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

// Retrieve set name and set description from the "setit" and "setpg" tables based on the set code
$sql = "SELECT setit.setname, setpg.setcode, setpg.setdes
        FROM setit
        JOIN setpg ON setit.setcode = setpg.setcode
        WHERE setit.setcode = '$setcode'";
$result = $conn->query($sql);

$setName = "";
$setDescription = "";

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $setName = $row["setname"];
        $setDescription = $row["setdes"];
    }
} else {
    echo "0 results";
}

// Get the set code from the URL parameter
$setcode = $_GET['setcode'];

// Retrieve set name and set description from the "setit" and "setpg" tables based on the set code
$sql = "SELECT setit.setname, setpg.setcode, setpg.setdes
      FROM setit
      JOIN setpg ON setit.setcode = setpg.setcode
      WHERE setit.setcode = '$setcode'";
$result = $conn->query($sql);

$setName = "";
$setDescription = "";

if ($result->num_rows > 0) {
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
      $setName = $row["setname"];
      $setDescription = $row["setdes"];
  }
} else {
  echo "0 results";
}
// Close database connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FlashSet</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<style>
body {
  font-family: Arial, sans-serif;
  background-color: #CAF4FF;
}

.navbar {
  background-color: #3559E0; /* Navbar background color */
}

.navbar-brand, .navbar-text {
  color: white; /* Text color */
  font-family: "Playfair Display", serif;
  font-size: 20px;
}

.nav-link {
  color: white !important; /* Anchor link color */
  font-family: "Playfair Display", serif;
  font-size: 20px;
}

.nav-link:hover {
  color: #ccc !important; /* Anchor link color on hover */
}

.container {
  margin-top: 50px;
}



.form-container {
  max-width: 600px;
  margin: auto;
  padding: 20px;
  background-color: #5AB2FF;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  font-family: "Playfair Display", serif;
  font-size: 20px;
  
}

.card-container, .add-card-form-container {
  width: 95%;
  margin: 30px auto; /* Increased margin for further down placement */
  padding: 20px;
  background-color: #5AB2FF;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  font-family: "Playfair Display", serif;
  font-size: 18px;
}

.fixed-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #0056b3;
  font-family: "Playfair Display", serif;
}

.fixed-button:hover {
 background-color: #5AB2FF;
 font-family: "Playfair Display", serif;
}

.floating-button {
  position: fixed;
  bottom: 20px;
  left: 20px;
  background-color: #0056b3;
  color: white;
  border: none;
  padding: 15px 20px;
  border-radius: 50px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  font-size: 18px;
  font-family: "Playfair Display", serif;
}

.floating-button:hover {
  background-color: #5AB2FF;
  font-family: "Playfair Display", serif;
}

.search-bar-container {
  max-width: 520px;
  margin: 20px auto;
  padding: 10px;
  background-color: #5AB2FF;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  font-family: "Playfair Display", serif;
}

/* Custom CSS for search bar */
.search-bar-container input[type="text"] {
  border: 2px solid black;
  border-radius: 5px;
  padding: 10px; /* Adjust padding as needed */
  width: 500px; /* Adjust width as needed */
  height: 40px; /* Adjust height as needed */
  box-sizing: border-box; /* Include padding in width calculation */
}

/* Modal Styles */
.modal {
  display: none; /* Initially hidden */
  position: fixed; /* Stay */
}
.card-grid {
  display: flex;
  flex-wrap: wrap;
  gap: 20px; /* Adjust the spacing between cards */
}

.card {
  width: 200px; /* Adjust the width of each card */
  height: 200px; /* Adjust the height of each card */
  background-color: #ffffff; /* Adjust the background color of each card */
  border-radius: 10px; /* Adjust the border radius for rounded corners */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a shadow effect */
}
.rectangle {
  margin-bottom: 20px;
  width: 100%; /* Adjust the width of each card */
  padding: 10px; /* Add padding inside the card */
  background-color: #ffffff; /* Adjust the background color of each card */
  border-radius: 10px; /* Adjust the border radius for rounded corners */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a shadow effect */
}

.rectangle-body {
  display: flex;
  flex-direction: column;
}

.button-group {
  display: flex;
  justify-content: space-between;
  margin-top: 10px; /* Adjust the margin as needed */
}

.rectangle-body .form-control {
  margin-bottom: 10px; /* Ensure inputs have space between them */
}

/* Adjustments for square buttons and text below the icons */
.modal-body  {
  display: flex;
    justify-content: center;
    margin: 1opx;
}

.btn-primary.rounded-circle {
  width: 100px; /* Adjust button width */
  height: 100px; /* Adjust button height */
  border-radius: 50%; /* Make the button circular */
  margin: 10px; /* Adjust spacing between buttons */
}

.btn-primary.rounded-circle img {
  display: flex;
  margin: auto; /* Center the icon */
}

.btn-third {
  width: 150px; /* Adjust button width */
  height: 150px; /* Adjust button height */
  border-radius: 10px; /* Remove border radius */
  margin: 10px; /* Adjust spacing between buttons */
  border: 2px solid black; /* Add black border */
}

.btn-primary img {
  display: flex;
  margin: auto; /* Center the icon */
}

.button-text {
  margin-top: 5px; /* Adjust spacing between icon and text */
}
/* Style for All Cards tab */
.all-tab {
    background-color: #007bff; /* Blue */
    color: white;
}

.all-tab:hover {
    background-color: #0056b3; /* Darker blue */
    color: white;
}

/* Style for Memorized Cards tab */
.memorized-tab {
    background-color: #28a745; /* Green */
    color: white;
}

.memorized-tab:hover {
    background-color: #218838; /* Darker green */
    color: white;
}

/* Style for Not Memorized Cards tab */
.not-memorized-tab {
    background-color: #dc3545; /* Red */
    color: white;
}

.not-memorized-tab:hover {
    background-color: #c82333; /* Darker red */
    color: white;
}

/* Style for active tab */
.nav-link.active {
    background-color: white !important; /* Dark gray */
    color: black !important;
}
.h1c{
  color: black;
}

</style>
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const form = document.getElementById('updateForm');
    const addEditButton = document.getElementById('addEditButton');
    const floatingButton = document.getElementById('floatingButton');
    const cardContainer = document.getElementById('cardContainer');
    const addCardFormContainer = document.getElementById('addCardFormContainer');
    const addCardButton = document.getElementById('addCardButton');
    const searchBarContainer = document.querySelector('.search-bar-container');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const setcode = "<?php echo $setcode; ?>";
        const setname = document.getElementById('setName').value;
        const setdescription = document.getElementById('setDescription').value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "card/update_set.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        if (xhr.status === 200) {
            // Handle successful deletion
            document.getElementById('modalMessage').innerText = xhr.responseText;
            // Reload the page or update the card container and add card form container
            location.reload(); // Reload the page
            // Alternatively, you can update the card container and add card form container dynamically without reloading the page
        } else {
            // Handle errors
            document.getElementById('modalMessage').innerText = "Error: " + xhr.statusText;
        }
        // Show the response modal
        var responseModal = new bootstrap.Modal(document.getElementById('responseModal'), {
            keyboard: false
        });
        responseModal.show();
    }}

        xhr.send("setcode=" + encodeURIComponent(setcode) + "&setname=" + encodeURIComponent(setname) + "&setdescription=" + encodeURIComponent(setdescription));
    });

    addEditButton.addEventListener('click', function() {
        cardContainer.style.display = 'none';
        addCardFormContainer.style.display = 'block';
        addEditButton.style.display = 'none';
        addCardButton.style.display = 'block';
        floatingButton.innerText = "Done";
        floatingButton.style.backgroundColor = '#007bff'; // Change color to blue
        searchBarContainer.style.display = 'none'; // Hide search bar
    });

    floatingButton.addEventListener('click', function() {
        if (floatingButton.innerText === "Done") {
            cardContainer.style.display = 'block';
            addCardFormContainer.style.display = 'none';
            addEditButton.style.display = 'block';
            addCardButton.style.display = 'none';
            floatingButton.innerText = "Study";
            floatingButton.style.backgroundColor = '#28a745'; // Revert color to green
            searchBarContainer.style.display = 'block'; // Show search bar
        }
    });

    // Event listener for opening modal
    document.getElementById('addCardButton').addEventListener('click', function() {
        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('addCardModal'), {
            keyboard: false
        });
        myModal.show();
    });

    // Event listener for submitting form within modal
    document.getElementById('submitCardModal').addEventListener('click', function() {
        const setcode = "<?php echo $setcode; ?>";
        const cardQuestion = document.getElementById('cardTitleModal').value;
        const cardAnswer = document.getElementById('cardDescriptionModal').value;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "card/add_card.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('modalMessage').innerText = xhr.responseText;

                // Show the response modal
                var responseModal = new bootstrap.Modal(document.getElementById('responseModal'), {
                    keyboard: false
                });
                responseModal.show();

                // Optionally, you can reload the page or update the card container to show the new card
                location.reload();
            }
        };

        xhr.send("setcode=" + encodeURIComponent(setcode) + "&cardQuestion=" + encodeURIComponent(cardQuestion) + "&cardAnswer=" + encodeURIComponent(cardAnswer));

        // Close the modal after submission
        var myModal = bootstrap.Modal.getInstance(document.getElementById('addCardModal'));
        myModal.hide();
    });
});
document.addEventListener('DOMContentLoaded', (event) => {
    // Event listener for delete buttons
    document.querySelectorAll('.delete-card').forEach(button => {
        button.addEventListener('click', function() {
            const itemcode = this.getAttribute('data-itemcode');
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "card/delete_card.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
              xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
        // Check if itemcode is set
        if (xhr.responseText.trim() === "Itemcode is not set.") {
            // Do nothing if itemcode is not set
            return;
        }
        // Handle successful deletion
        document.getElementById('modalMessage').innerText = xhr.responseText;
        var responseModal = new bootstrap.Modal(document.getElementById('responseModal'), {
            keyboard: false
        });
        responseModal.show();
        
        // Update card container and add card form container dynamically
        updateContainers();
    }
};

// Function to update card container and add card form container dynamically
function updateContainers() {
    // Get the set code from the URL parameter
    const setcode = "<?php echo $setcode; ?>";
    
    // Fetch updated data for card container
    fetch("card/get_cards.php?setcode=" + setcode)
    .then(response => response.text())
    .then(data => {
        document.getElementById('cardContainer').innerHTML = data;
    });

    // Fetch updated data for add card form container
    fetch("card/get_add_card_form.php?setcode=" + setcode)
    .then(response => response.text())
    .then(data => {
        document.getElementById('addCardFormContainer').innerHTML = data;
    });
}


            };
            xhr.send("itemcode=" + encodeURIComponent(itemcode));
        });
    });
});
document.addEventListener('DOMContentLoaded', (event) => {
    // Other event listeners...

    document.querySelectorAll('.update-card').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const itemcode = this.getAttribute('data-itemcode');
            const question = this.closest('.rectangle-body').querySelector('input[name="cardQuestion[]"]').value;
            const answer = this.closest('.rectangle-body').querySelector('input[name="cardAnswer[]"]').value;

            const xhr = new XMLHttpRequest();
            xhr.open("POST", "card/update_card.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('modalMessage').innerText = xhr.responseText;

                    var responseModal = new bootstrap.Modal(document.getElementById('responseModal'), {
                        keyboard: false
                    });
                    responseModal.show();

                    updateContainers(); // Refresh containers
                }
            };

            xhr.send("itemcode=" + encodeURIComponent(itemcode) + "&question=" + encodeURIComponent(question) + "&answer=" + encodeURIComponent(answer));
        });
    });
});

function updateContainers() {
    const setcode = "<?php echo $setcode; ?>";

    fetch("card/get_cards.php?setcode=" + setcode)
        .then(response => response.text())
        .then(data => {
            document.getElementById('cardContainer').innerHTML = data;
        });

    fetch("card/get_add_card_form.php?setcode=" + setcode)
        .then(response => response.text())
        .then(data => {
            document.getElementById('addCardFormContainer').innerHTML = data;

            // Re-add event listeners for the newly loaded content
            document.querySelectorAll('.delete-card').forEach(button => {
                button.addEventListener('click', function() {
                    const itemcode = this.getAttribute('data-itemcode');
                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "card/delete_card.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById('modalMessage').innerText = xhr.responseText;
                            var responseModal = new bootstrap.Modal(document.getElementById('responseModal'), {
                                keyboard: false
                            });
                            responseModal.show();
                            updateContainers();
                        }
                    };
                    xhr.send("itemcode=" + encodeURIComponent(itemcode));
                });
            });

            document.querySelectorAll('.update-card').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const itemcode = this.getAttribute('data-itemcode');
                    const question = this.closest('.rectangle-body').querySelector('input[name="cardQuestion[]"]').value;
                    const answer = this.closest('.rectangle-body').querySelector('input[name="cardAnswer[]"]').value;

                    const xhr = new XMLHttpRequest();
                    xhr.open("POST", "card/update_card.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            document.getElementById('modalMessage').innerText = xhr.responseText;

                            var responseModal = new bootstrap.Modal(document.getElementById('responseModal'), {
                                keyboard: false
                            });
                            responseModal.show();

                            updateContainers(); // Refresh containers
                        }
                    };

                    xhr.send("itemcode=" + encodeURIComponent(itemcode) + "&question=" + encodeURIComponent(question) + "&answer=" + encodeURIComponent(answer));
                });
            });
        });
}
document.addEventListener('DOMContentLoaded', (event) => {
    // Event listener for opening study mode modal
    document.getElementById('floatingButton').addEventListener('click', function() {
        // Show the study mode modal
        var studyModeModal = new bootstrap.Modal(document.getElementById('studyModeModal'), {
            keyboard: false
        });
        studyModeModal.show();
    });

    // Event listener for selecting study mode
    document.querySelectorAll('.btn-study-mode').forEach(button => {
        button.addEventListener('click', function() {
            const mode = this.getAttribute('data-mode');
            const setcode = "<?php echo $_GET['setcode']; ?>"; // Get set code from URL
            
            // Redirect to study.php with mode and setcode parameters
            window.location.href = `study.php?mode=${mode}&setcode=${setcode}`;
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const cards = document.querySelectorAll('.card');

    searchInput.addEventListener('input', function() {
        const searchTerm = searchInput.value.trim().toLowerCase();
        cards.forEach(card => {
            const question = card.querySelector('.card-title').innerText.toLowerCase();
            if (question.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const allTab = document.getElementById('all-tab');
    const memorizedTab = document.getElementById('memorized-tab');
    const notMemorizedTab = document.getElementById('not-memorized-tab');

    allTab.addEventListener('click', function() {
      showTab('allCards');
    });

    memorizedTab.addEventListener('click', function() {
      showTab('memorizedCards');
    });

    notMemorizedTab.addEventListener('click', function() {
      showTab('notMemorizedCards');
    });

    function showTab(tabId) {
      const tabs = document.querySelectorAll('.tab-pane');
      tabs.forEach(tab => {
        if (tab.id === tabId) {
          tab.classList.add('show', 'active');
        } else {
          tab.classList.remove('show', 'active');
        }
      });
    }
  });
</script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">FlashFlow</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="homepage.php">Home</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Add Card Modal -->
<div class="modal" id="addCardModal">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title">Add Card</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <!-- Modal Body -->
      <div class="modal-body">
        <!-- Input fields for card question and answer -->
        <div class="form-group">
          <label for="cardTitleModal">Question:</label>
          <input type="text" class="form-control" id="cardTitleModal" placeholder="Enter question">
        </div>
        <div class="form-group">
          <label for="cardDescriptionModal">Answer:</label>
          <input type="text" class="form-control" id="cardDescriptionModal" placeholder="Enter answer">
        </div>
      </div>
      
      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitCardModal">Add Card</button>
      </div>
      
    </div>
  </div>
</div>

<!-- Response Modal -->
<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="responseModalLabel">Response</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="modalMessage"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <div class="form-container">
    <form id="updateForm">
      <div class="form-group">
        <label for="setName">Set Name:</label>
        <input type="text" class="form-control" id="setName" name="setname" value="<?php echo htmlspecialchars($setName); ?>" placeholder="Enter set name">
      </div>
      <div class="form-group">
        <label for="setDescription">Set Description:</label>
        <input type="text" class="form-control" id="setDescription" name="setdescription" value="<?php echo htmlspecialchars($setDescription); ?>" placeholder="Enter set description">
      </div>
      <button type="submit" class="btn btn-primary mt-3">Update</button>
    </form>
  </div>
</div>


<!-- Study Mode Modal -->
<div class="modal fade" id="studyModeModal" tabindex="-1" aria-labelledby="studyModeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title" id="studyModeModalLabel">Choose Study Mode</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- Modal Body -->
      <div class="modal-body">
        <div class="d-flex justify-content-around">
          <!-- Flashcards Mode -->
          <div class="text-center">
            <a href="study.php?mode=flashcards&setcode=<?php echo $setcode; ?>" class="btn btn-third">
              <img src="images/flashcard.svg" alt="Flashcards" width="48" height="48">
              <div class="button-text">Flashcards</div>
            </a>
          </div>
          <!-- Multiple Choice Mode -->
          <div class="text-center">
            <a href="study.php?mode=multiple_choice&setcode=<?php echo $setcode; ?>" class="btn btn-third">
              <img src="images/search.svg" alt="Multiple Choice" width="48" height="48">
              <div class="button-text">Multiple Choice</div>
            </a>
          </div>
          <!-- Writing Mode -->
          <div class="text-center">
            <a href="study.php?mode=writing&setcode=<?php echo $setcode; ?>" class="btn btn-third">
              <img src="images/writing.svg" alt="Writing" width="48" height="48">
              <div class="button-text">Writing</div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>






<!-- Search bar -->
<div class="search-bar-container">
  <input type="text" class="form-control" id="searchInput" placeholder="Search card">
</div>



<!-- Card Container -->
<div id="cardContainer" class="card-container">
  <h1 class="h1c">Your Question Cards</h1>
  <!-- Tabs -->
  <ul class="nav nav-tabs mb-3" id="cardTabs" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#allCards" type="button" role="tab" aria-controls="allCards" aria-selected="true">All</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="memorized-tab" data-bs-toggle="tab" data-bs-target="#memorizedCards" type="button" role="tab" aria-controls="memorizedCards" aria-selected="false">Memorized</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="not-memorized-tab" data-bs-toggle="tab" data-bs-target="#notMemorizedCards" type="button" role="tab" aria-controls="notMemorizedCards" aria-selected="false">Not Memorized</button>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content" id="cardTabContent">
    <!-- All Cards Tab -->
    <div class="tab-pane fade show active" id="allCards" role="tabpanel" aria-labelledby="all-tab">
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
      </div>
    </div>
    <!-- Memorized Cards Tab -->
    <div class="tab-pane fade" id="memorizedCards" role="tabpanel" aria-labelledby="memorized-tab">
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

    // Retrieve memorized cards with the matching setcode from the database
    $sql = "SELECT * FROM cards WHERE setcode = '$setcode' AND memorized = 1";
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
        echo "No memorized cards found for this set.";
    }

    // Close database connection
    $conn->close();
    ?>
      </div>
    </div>
    <!-- Not Memorized Cards Tab -->
    <div class="tab-pane fade" id="notMemorizedCards" role="tabpanel" aria-labelledby="not-memorized-tab">
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

    // Retrieve not memorized cards with the matching setcode from the database
    $sql = "SELECT * FROM cards WHERE setcode = '$setcode' AND memorized = 0";
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
        echo "No not memorized cards found for this set.";
    }

    // Close database connection
    $conn->close();
    ?>
      </div>
    </div>
  </div>
</div>
<div id="addCardFormContainer" class="add-card-form-container" style="display: none;">
  <h1>Add/Edit Cards</h1>
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
          echo '<a href="" class="btn btn-primary update-card" data-itemcode="' . $row["itemcode"] . '">Update</a>';
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


<a href="#" id="addEditButton" class="btn btn-success fixed-button">Add/Edit Cards</a>
<a href="#" id="addCardButton" class="btn btn-primary fixed-button" style="display: none;">Add Cards</a>
<a href="#" id="floatingButton" class="floating-button">Study</a>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>