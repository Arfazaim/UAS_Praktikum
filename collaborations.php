<?php
// collaborations.php
// Handles CRUD operations for collaborations

// Create collaboration
function createCollaboration($conn, $researcher_id, $research_project_id) {
    $sql = "INSERT INTO collaborations (researcher_id, research_project_id) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $researcher_id, $research_project_id);
    $stmt->execute();
    $stmt->close();
}

// Read collaboration
function getCollaboration($conn, $id) {
    $sql = "SELECT * FROM collaborations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_assoc();
}

// Update collaboration
function updateCollaboration($conn, $id, $researcher_id, $research_project_id) {
    $sql = "UPDATE collaborations SET researcher_id = ?, research_project_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $researcher_id, $research_project_id, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete collaboration
function deleteCollaboration($conn, $id) {
    $sql = "DELETE FROM collaborations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>