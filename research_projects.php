<?php
// Handles CRUD operations for research projects

// Create research project
function createResearchProject($title, $description, $researcher_id) {
    $sql = "INSERT INTO research_projects (title, description, researcher_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $researcher_id);
    $stmt->execute();
    $stmt->close();
}

// Read research project
function getResearchProject($id) {
    $sql = "SELECT * FROM research_projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_assoc();
}

// Update research project
function updateResearchProject($id, $title, $description) {
    $sql = "UPDATE research_projects SET title = ?, description = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $description, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete research project
function deleteResearchProject($id) {
    $sql = "DELETE FROM research_projects WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>