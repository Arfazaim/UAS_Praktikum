<?php
// login.php

require_once 'config.php';

// Get the login credentials from the form
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists
$query = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $username, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful, set the session variables
    $user_data = $result->fetch_assoc();
    $_SESSION['user_id'] = $user_data['user_id'];
    $_SESSION['username'] = $user_data['username'];
    $_SESSION['role'] = $user_data['role'];

    header('Location: dashboard.php');
    exit;
} else {
    echo "Invalid username or password.";
}
?>nnnnn