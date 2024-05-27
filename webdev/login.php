<?php
session_start();
require 'config.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['login'])) {
        // Debugging statement to check if this block is executed
        

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

                        

                        // Debugging statement to check if redirection block is reached
                      
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
    }
}
?>
