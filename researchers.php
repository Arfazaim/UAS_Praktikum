<?php
// researchers.php
// Handles CRUD operations for researchers

// Create researcher
function createResearcher($name, $email, $password) {
    $sql = "INSERT INTO researchers (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
    $stmt->close();
}

// Read researcher
function getResearcher($id) {
    $sql = "SELECT * FROM researchers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result->fetch_assoc();
}

// Update researcher
function updateResearcher($id, $name, $email, $password) {
    $sql = "UPDATE researchers SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $email, $password, $id);
    $stmt->execute();
    $stmt->close();
}

// Delete researcher
function deleteResearcher($id) {
    $sql = "DELETE FROM researchers WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>