<?php
// register.php

require_once 'config.php';

// Get the registration details from the form
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];

// Create a new user
$query = "INSERT INTO users (username, password, email, role) VALUES (?,?,?, 'esearcher')";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $username, $password, $email);
$stmt->execute();

// Get the user ID
$user_id = $stmt->insert_id;

// Set the session variables
$_SESSION['user_id'] = $user_id;
$_SESSION['username'] = $username;
$_SESSION['role'] = 'esearcher';

header('Location: dashboard.php');
exit;
?>