<?php
// Main page of the platform

// Display a list of research projects and publications
$sql = "SELECT research_projects.*, publications.id AS publication_id, publications.title AS publication_title, publications.abstract AS publication_abstract FROM research_projects LEFT JOIN publications ON research_projects.id = publications.research_project_id";
$result = $conn->query($sql);

echo "<h1>Research Projects</h1>";
echo "<table>";
echo "<tr><th>Title</th><th>Description</th><th>Publications</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>";
    if ($row['publication_id']) {
        echo "<a href='publication.php?id=" . $row['publication_id'] . "'>" . $row['publication_title'] . "</a>";
        echo "<p>" . $row['publication_abstract'] . "</p>";
    } else {
        echo "No publications";
    }
    echo "</td>";
    echo "</tr>";
}

echo "</table>";

// Display a link to create a new research project
echo "<a href='create_research_project.php'>Create New Research Project</a>";

// Display a link to create a new publication
echo "<a href='create_publication.php'>Create New Publication</a>";

$conn->close();
?>