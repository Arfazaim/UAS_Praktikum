<?php// publications.php
// Handles CRUD operations for publications

// Create publication
function createPublication($conn, $title, $abstract, $research_project_id) {
    $sql = "INSERT INTO publications (title, abstract, research_project_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $abstract, $research_project_id);
    $stmt->execute();
    $stmt->close();
}

// Read publication
function getPublication($id) {
    $sql = "SELECT * FROM publications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_assoc();
}

// Update publication
function updatePublication($id, $title, $abstract) {
    $sql = "UPDATE publications SET title = ?, abstract = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $abstract, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete publication
function deletePublication($id) {
    $sql = "DELETE FROM publications WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>