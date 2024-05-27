<?php
require 'config.php';

$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Validate password
    if (!preg_match("/^(?=.*[0-9])(?=.*[~`!@#$%^&*()-_+={}[\]|\\;:'\",.<>\/?])(?=.*[A-Z])[0-9A-Za-z~`!@#$%^&*()-_+={}[\]|\\;:'\",.<>\/?]{8,16}$/", $new_password)) {
        $response['message'] = 'Password must contain at least 1 numeric character [0-9], 1 special character, 1 uppercase letter, and be 8-16 characters long.';
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Check if the username and email match
        $sql = "SELECT id FROM users WHERE username = ? AND email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                // Update the password
                $stmt->bind_result($id);
                $stmt->fetch();
                $sql_update = "UPDATE users SET pass = ? WHERE id = ?";
                if ($stmt_update = $conn->prepare($sql_update)) {
                    $stmt_update->bind_param("si", $hashed_password, $id);
                    if ($stmt_update->execute()) {
                        $response['success'] = true;
                    } else {
                        $response['message'] = 'Error updating the password. Please try again later.';
                    }
                    $stmt_update->close();
                }
            } else {
                $response['message'] = 'Username and email do not match.';
            }
            $stmt->close();
        } else {
            $response['message'] = 'Error preparing SQL statement: ' . $conn->error;
        }
    }
}

echo json_encode($response);
?>
