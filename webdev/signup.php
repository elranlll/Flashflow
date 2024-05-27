<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prevent SQL injection
    $name = mysqli_real_escape_string($conn, $name);
    $email = mysqli_real_escape_string($conn, $email);

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Insert user data into the database with hashed password
        $sql = "INSERT INTO users (username, email, pass) VALUES ('$name', '$email', '$hashed_password')";
        if ($conn->query($sql) === TRUE) {
            // Redirect to login page after successful signup
            header('Location: login_register.php');
            exit();
        } else {
            // If signup fails for any other reason, redirect back to login_register.php with a generic error message
            $_SESSION['signup_error'] = 'Signup failed. Please try again.';
            header('Location: login_register.php');
            exit();
        }
    } catch (mysqli_sql_exception $e) {
        // If a MySQL error occurs (e.g., duplicate entry for email), redirect back to signup page with an error message
        $_SESSION['signup_error'] = 'Email already exists. Please use a different email address.';
        header('Location: login_register.php');
        exit();
    }
}

// Close database connection
$conn->close();
?>
