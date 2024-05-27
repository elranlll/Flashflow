<?php
session_start();
// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: homepage.php");
    exit;
}
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Login form submitted
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email format.';
        } else {
            // Prevent SQL injection
            $email = mysqli_real_escape_string($conn, $email);

            // Retrieve the password from the database
            $sql = "SELECT id, username, pass FROM users WHERE email = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $stored_password);
                    $stmt->fetch();

                    // Check if the stored password is hashed
                    $is_hashed = password_verify($password, $stored_password);

                    // Compare the entered password with the stored password
                    if (($is_hashed && password_verify($password, $stored_password)) || (!$is_hashed && $password === $stored_password)) {
                        // Start the session and store user information
                        $_SESSION['user_id'] = $id;
                        $_SESSION['user_name'] = $name;

                        // Redirect to homepage
                        header('Location: homepage.php');
                        exit(); // Ensure script stops execution after redirection
                    } else {
                        $error = 'Incorrect email or password.';
                    }
                } else {
                    $error = 'Incorrect email or password.';
                }

                $stmt->close();
            } else {
                $error = 'Error preparing SQL statement: ' . $conn->error;
            }
        }
    } elseif (isset($_POST['signup'])) {
        // Signup form submitted
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_pass = $_POST['confirm_pass'];

        // Check if name already exists in the database
        $sql_check_name = "SELECT id FROM users WHERE name = ?";
        $stmt_check_name = $conn->prepare($sql_check_name);
        $stmt_check_name->bind_param("s", $name);
        $stmt_check_name->execute();
        $stmt_check_name->store_result();

        if ($stmt_check_name->num_rows > 0) {
            $name_error = 'Name already exists.';
        }

        // Check if email already exists in the database
        $sql_check_email = "SELECT id FROM users WHERE email = ?";
        $stmt_check_email = $conn->prepare($sql_check_email);
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $stmt_check_email->store_result();

        if ($stmt_check_email->num_rows > 0) {
            $email_error = 'Email already exists.';
        }

        // If there are no errors, proceed with signup
        if (empty($name_error) && empty($email_error)) {
            if (strlen($name) < 4) {
                $error = 'Name must have a minimum of 4 letters.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = 'Invalid email format.';
            } elseif (!preg_match("/^(?=.*[0-9])(?=.*[~`!@#$%^&*()-_+={}[\]|\\;:'\",.<>\/?])(?=.*[A-Z])[0-9A-Za-z~`!@#$%^&*()-_+={}[\]|\\;:'\",.<>\/?]{8,16}$/", $password)) {
                $error = 'Password must contain at least 1 numeric character [0-9], 1 special character, 1 uppercase letter, and be 8-16 characters long.';
            } elseif ($password !== $confirm_pass) {
                $error = 'Password and confirm password do not match.';
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user data into the database
                $sql_insert = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                $stmt_insert = $conn->prepare($sql_insert);
                $stmt_insert->bind_param("sss", $name, $email, $hashed_password);

                if ($stmt_insert->execute()) {
                    // Redirect to login page after successful signup
                    header('Location: login_register.php');
                    exit();
                } else {
                    $error = 'Error: Unable to sign up. Please try again later.';
                }
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login and Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style> 
 .error-message {
            color: red;
            font-size: 0.8em;
            margin-top: 5px;
        }
        .modal {
        display: none;
        position: absolute;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
        justify-content: center;
        align-items: center;
    }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            border-radius: 10px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
</style>
  </head>
<body>
<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
            <img src="images/frontImg.jpg" alt="">
            <div class="text">
                <span class="text-1">Every new friend is a <br> new adventure</span>
                <span class="text-2">Let's get connected</span>
            </div>
        </div>
        <div class="back">
            <img class="backImg" src="images/backImg.jpg" alt="">
            <div class="text">
                <span class="text-1">Complete miles of journey <br> with one step</span>
                <span class="text-2">Let's get started</span>
            </div>
        </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="login-form">
                <div class="title">Login</div>
                <form action="login.php" method="post">
                    <div class="input-boxes">
            <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="pass" placeholder="Enter your password" required>
                <span class="show-password" onclick="togglePassword('pass')">Show</span>
            </div>
            <div class="error-message"><?php echo $error; ?></div> <!-- Display error message here -->
                        <div class="text"><a href="#">Forgot password?</a></div>
                        <div class="button input-box">
                            <input type="submit" name="login" value="Submit">
                        </div>
                        <div class="text sign-up-text">Don't have an account? <label for="flip">Sign up now</label></div>
                    </div>
                </form>
            </div>
            <div class="signup-form">
                <div class="title">Signup</div>
                <form action="signup.php" method="post" onsubmit="return validateForm()">
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" name="name" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="error-message" id="name-error"></div> <!-- Error message box for name -->

                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="email" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="error-message" id="email-error"></div> <!-- Error message box for email -->

                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" id="password" placeholder="Enter your password" required>
                        <span class="show-password" onclick="togglePassword('password')">Show</span>
                    </div>
                    <div class="error-message" id="password-error"></div> <!-- Error message box for password -->

                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="confirm_pass" id="confirm_password" placeholder="Confirm your password" required>
                        <span class="show-password" onclick="togglePassword('confirm_password')">Show</span>
                    </div>
                    <div class="error-message" id="confirm-pass-error"></div> <!-- Error message box for confirm password -->

                    <div class="button input-box">
                        <input type="submit" name="signup" value="Submit">
                    </div>
                    <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
                </form>
            </div>
        </div>
    </div>
</div>
 <!-- Forgot Password Modal -->
 <div id="forgotPasswordModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Reset Password</h2>
            <form id="forgotPasswordForm">
                <div class="input-box">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" id="reset-username" placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="reset-email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="new_password" id="reset-password" placeholder="Enter your new password" required>
                    <span class="show-password" onclick="togglePassword('reset-password')">Show</span>
                </div>
                <div class="error-message" id="reset-password-error"></div>
                <div class="input-box">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="confirm_new_password" id="reset-confirm-password" placeholder="Confirm your new password" required>
                    <span class="show-password" onclick="togglePassword('reset-confirm-password')">Show</span>
                </div>
                <div class="error-message" id="reset-confirm-password-error"></div>
                <div class="error-message" id="reset-error"></div>
                <div class="button input-box">
                    <input type="submit" value="Reset Password">
                </div>
            </form>
        </div>
    </div>

<Script>
document.addEventListener("DOMContentLoaded", function() {
            var nameInput = document.getElementById('name');
            var emailInput = document.getElementById('email');

            nameInput.addEventListener('input', function() {
                var nameValue = this.value.trim();
                if (nameValue !== '') {
                    checkNameExistence(nameValue);
                } else {
                    hideError('name-error');
                }
            });

            emailInput.addEventListener('input', function() {
                var emailValue = this.value.trim();
                if (emailValue !== '') {
                    checkEmailExistence(emailValue);
                } else {
                    hideError('email-error');
                }
            });
        });

        function checkNameExistence(name) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.exists) {
                        showError('name-error', 'Name already exists.');
                    } else {
                        hideError('name-error');
                    }
                }
            };
            xhr.open("GET", "check_name.php?name=" + encodeURIComponent(name), true);
            xhr.send();
        }

        function checkEmailExistence(email) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.exists) {
                        showError('email-error', 'Email already exists.');
                    } else {
                        hideError('email-error');
                    }
                }
            };
            xhr.open("GET", "check_email.php?email=" + encodeURIComponent(email), true);
            xhr.send();
        }

// Function to show error messages
function showError(inputId, errorMessage) {
        var errorElement = document.getElementById(inputId + '-error');
        errorElement.innerHTML = errorMessage;
        errorElement.style.display = 'block';
    }

    // Function to hide error messages
    function hideError(inputId) {
        var errorElement = document.getElementById(inputId + '-error');
        errorElement.style.display = 'none';
    }

    // Function to validate name
    function validateName() {
        var nameInput = document.getElementById('name');
        var name = nameInput.value.trim();
        if (name.length < 4) {
            showError('name', 'Name must have a minimum of 4 letters.');
            return false;
        } else {
            hideError('name');
            return true;
        }
    }

    // Function to validate email
    function validateEmail() {
        var emailInput = document.getElementById('email');
        var email = emailInput.value.trim();
        if (!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
            showError('email', 'Invalid email format.');
            return false;
        } else {
            hideError('email');
            return true;
        }
    }

    // Function to validate password
    function validatePassword() {
        var passwordInput = document.getElementById('password');
        var password = passwordInput.value.trim();
        if (!/^(?=.*[0-9])(?=.*[~`!@#$%^&*()-_+={}[\]|\\;:'",.<>\/?])(?=.*[A-Z])[0-9A-Za-z~`!@#$%^&*()-_+={}[\]|\\;:'",.<>\/?]{8,16}$/.test(password)) {
            showError('password', 'Password must contain at least 1 numeric character [0-9], 1 special character, 1 uppercase letter, and be 8-16 characters long.');
            return false;
        } else {
            hideError('password');
            return true;
        }
    }

    // Function to validate confirm password
    function validateConfirmPassword() {
        var passwordInput = document.getElementById('password');
        var confirmPasswordInput = document.getElementById('confirm_password');
        var confirmPassword = confirmPasswordInput.value.trim();
        var password = passwordInput.value.trim();
        if (confirmPassword !== password) {
            showError('confirm-pass', 'Password and confirm password do not match.');
            return false;
        } else {
            hideError('confirm-pass');
            return true;
        }
    }

    // Function to validate all fields before form submission
    function validateForm() {
        var isValid = true;
        if (!validateName()) {
            isValid = false;
        }
        if (!validateEmail()) {
            isValid = false;
        }
        if (!validatePassword()) {
            isValid = false;
        }
        if (!validateConfirmPassword()) {
            isValid = false;
        }
        return isValid;
    }
    function togglePassword(inputId) {
        var passwordInput = document.getElementById(inputId);
        var showPasswordButton = passwordInput.nextElementSibling;

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            showPasswordButton.textContent = "Hide";
        } else {
            passwordInput.type = "password";
            showPasswordButton.textContent = "Show";
        }
    }
   // Forgot Password Modal JavaScript
   var modal = document.getElementById("forgotPasswordModal");
        var btn = document.querySelector(".text a"); // Assuming this is the "Forgot Password?" link
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Function to toggle password visibility
        function togglePassword(inputId) {
            var passwordInput = document.getElementById(inputId);
            var showPasswordButton = passwordInput.nextElementSibling;

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordButton.textContent = "Hide";
            } else {
                passwordInput.type = "password";
                showPasswordButton.textContent = "Show";
            }
        }

        // Handle Forgot Password form submission
        document.getElementById("forgotPasswordForm").onsubmit = function(event) {
            event.preventDefault();
            var username = document.getElementById("reset-username").value;
            var email = document.getElementById("reset-email").value;
            var newPassword = document.getElementById("reset-password").value;
            var confirmNewPassword = document.getElementById("reset-confirm-password").value;

            // Validate new password
            var passwordValid = /^(?=.*[0-9])(?=.*[~`!@#$%^&*()-_+={}[\]|\\;:'\",.<>\/?])(?=.*[A-Z])[0-9A-Za-z~`!@#$%^&*()-_+={}[\]|\\;:'\",.<>\/?]{8,16}$/.test(newPassword);
            if (!passwordValid) {
                document.getElementById("reset-password-error").innerText = 'Password must contain at least 1 numeric character [0-9], 1 special character, 1 uppercase letter, and be 8-16 characters long.';
                return;
            } else {
                document.getElementById("reset-password-error").innerText = '';
            }

            // Validate confirm new password
            if (newPassword !== confirmNewPassword) {
                document.getElementById("reset-confirm-password-error").innerText = 'Password and confirm password do not match.';
                return;
            } else {
                document.getElementById("reset-confirm-password-error").innerText = '';
            }

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "reset_password.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        modal.style.display = "none";
                        alert("Password reset successful. Please log in with your new password.");
                    } else {
                        document.getElementById("reset-error").innerText = response.message;
                    }
                }
            };
            xhr.send("username=" + encodeURIComponent(username) + "&email=" + encodeURIComponent(email) + "&new_password=" + encodeURIComponent(newPassword));
        }
    </script>
</Script>
</body>
</html>
