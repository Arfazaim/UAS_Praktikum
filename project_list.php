<?php
// project_list.php

require_once 'config.php';

// Retrieve the list of research projects
$query = "SELECT * FROM research_projects";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<h2>" . $row['title'] . "</h2>";
        echo "<p>" . $row['abstract'] . "</p>";
        echo "<p>Keywords: " . $row['keywords'] . "</p>";
        echo "<p>Status: " . $row['status'] . "</p>";
        echo "<hr>";
    }
} else {
    echo "No research projects found.";
}
?>