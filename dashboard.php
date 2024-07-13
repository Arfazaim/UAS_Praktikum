<?php
// dashboard.php

require_once 'config.php';

// Display the dashboard
echo "<h1>Dashboard</h1>";
echo "<p>Welcome, ". $_SESSION['username']. "!</p>";
echo "<p><a href='create_project.php'>Create a new research project</a></p>";
echo "<p><a href='project_list.php'>View research projects</a></p>";
?>