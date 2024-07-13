<?php
// create_project.php

require_once 'config.php';

// Get the project details from the form
$project_title = $_POST['title'];
$project_abstract = $_POST['abstract'];
$project_keywords = $_POST['keywords'];

// Create a new research project
$query = "INSERT INTO research_projects (title, abstract, keywords, status) VALUES (?,?,?, 'ongoing')";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss", $project_title, $project_abstract, $project_keywords);
$stmt->execute();

// Get the project ID
$project_id = $stmt->insert_id;

// Create a new collaboration for the project leader
$query = "INSERT INTO collaborations (project_id, user_id, role) VALUES (?,?, 'leader')";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $project_id, $_SESSION['user_id']);
$stmt->execute();

header('Location: project_list.php');
exit;
?>