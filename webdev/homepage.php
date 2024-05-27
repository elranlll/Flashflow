
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Homes</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  background-color: #CAF4FF;
}

nav {
  background-color: #3559E0;
  color: white;
  overflow: hidden;
  padding: 10px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  height: 100px; /* Fixed height for the navbar */
}

.logo {
  height: 150px;
  width: 150px; /* Auto width to maintain aspect ratio */
}

.name {
  font-size: 30px;
  color: white;
  cursor: pointer;
  top: 1px;
  font-family: "Playfair Display", serif;
}

.search {
  height: 30px;

}

.search input {
  border: none;
  outline: none;
  background: white;
  height: 100%;
  padding: 0 5px;
  font-size: 20px;
  width: 500px;
  margin-left: 20px;
  font-family: "Playfair Display", serif;
  border-radius: 10px;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

li {
  display: inline-block;
  margin-right: 20px;
  font-family: "Playfair Display", serif;
  font-size: 20px;
}

a {
  text-decoration: none;
  color: inherit;
  font-weight: bold;
}

a:hover {
  color: #ccc;
}

.floating-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background-color: #007bff;
  color: white;
  border: none;
  padding: 15px 20px;
  border-radius: 50px;
  box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  font-size: 16px;
  font-family: "Playfair Display", serif;
}

.floating-button:hover {
  background-color: #0056b3;
}

#item-container {
  display: flex;
  flex-wrap: wrap;
  margin: 20px;
  padding: 20px;
  border: 1px solid black;
  border-radius: 10px;
  background-color: #f9f9f9;
  min-height: 200px;
  justify-content: center; 
  align-items: center; 
}

.new-button {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px 20px;
  margin: 10px;
  border: 1px solid #007bff;
  border-radius: 4px;
  background-color: #007bff;
  color: white;
  cursor: pointer;
  font-size: 16px;
  text-align: left;
  width: 200px;
  height: 100px;
}

.new-button img.icon {
  width: 30px;
  height: 30px;
  margin-left: 10px;
  cursor: pointer;
}
.header {
  text-align: center; /* Center the text horizontally */
  margin-top: 20px;
  font-family: "Playfair Display", serif;
}

</style>
</head>

<body>

<nav>
  <table>
    <tr>
      <td> 
        <div class="logo" style="float:left">
          <a href="homepage.php">
            <img class="logo" src="images/Flash.png" alt="Logo">
          </a>
        </div> 
      </td>
      <td>
        <div class="name" style="float:left">
          <h1>FlashFlow</h1>
        </div>
      </td>
      <td>
        <div class="search" style="float:center">
          <input type="search" placeholder="Search Set" id="searchInput">
          <span class="fa fa-search"></span>
        </div>
      </td>
    </tr>
  </table>
  <ul>
    <li style="float:right"><a href="#" id="logout-link">Log out</a></li>
    <li style="float:right"><a href="aboutus.php">About</a></li>
</ul>
</nav>
<h1 class="header">Created Sets</h1>
<div id="item-container">
  <?php include 'button/display_buttons.php'; ?>
</div>

<button class="floating-button" onclick="addItem()">Add Set</button>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this Set?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to log out?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="logoutConfirmButton">Logout</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="addSetModal" tabindex="-1" aria-labelledby="addSetModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addSetModalLabel">Add Set</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addSetForm">
          <div class="mb-3">
            <label for="setName" class="form-label">Set Name:</label>
            <input type="text" class="form-control" id="setName" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Set</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  window.history.pushState(null, "", window.location.href);
window.onpopstate = function () {
    window.history.pushState(null, "", window.location.href);
};
function confirmDelete(event, code) {
  event.preventDefault(); // Prevent default link behavior

  // Get a reference to the modal element
  var modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));

  // Open the modal
  modal.show();

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
          modal.hide();
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

document.addEventListener('DOMContentLoaded', function() {
  // Show Add Set Modal
  document.querySelector('.floating-button').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('addSetModal'));
    modal.show();
  });

  // Handle Add Set Form Submission
  document.getElementById('addSetForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const name = document.getElementById('setName').value.trim();
    if (name === '') {
      alert('Please enter a valid set name.');
      return;
    }
    const code = Math.floor(1000 + Math.random() * 9000);
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          // Refresh button container after successful addition
          refreshContainer();
          // Close the modal after addition
          var modal = bootstrap.Modal.getInstance(document.getElementById('addSetModal'));
          modal.hide();
        } else {
          alert('Error: ' + xhr.responseText);
        }
      }
    };
    xhr.open('POST', 'button/add_button.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send('name=' + encodeURIComponent(name) + '&code=' + encodeURIComponent(code));
  });

  // Function to refresh button container
  function refreshContainer() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          document.getElementById('item-container').innerHTML = xhr.responseText;
        } else {
          alert('Error: ' + xhr.responseText);
        }
      }
    };
    xhr.open('GET', 'button/display_buttons.php');
    xhr.send();
  }
});

// Function to filter buttons based on search query
document.querySelector('input[type="search"]').addEventListener('input', function() {
  const searchQuery = this.value.toLowerCase();
  const buttons = document.querySelectorAll('.new-button');

  buttons.forEach(button => {
    const buttonName = button.textContent.toLowerCase();
    if (buttonName.includes(searchQuery)) {
      button.style.display = 'block';
    } else {
      button.style.display = 'none';
    }
  });
});

// Trigger the modal when logout link is clicked
document.getElementById('logout-link').addEventListener('click', function(event) {
    event.preventDefault();
    var logoutModal = new bootstrap.Modal(document.getElementById('logoutModal'));
    logoutModal.show();
  });

  // Handle logout when user confirms
  document.getElementById('logoutConfirmButton').addEventListener('click', function() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
          window.location.href = 'login_register.php'; // Redirect to logout page
        } else {
          alert('Error: ' + xhr.responseText);
        }
      }
    };
    xhr.open('POST', 'logout.php'); // Adjust URL if needed
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();
  });
</script>

</body>
</html>
