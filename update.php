<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $judul_penelitian = $_POST['judul_penelitian'];
    $peneliti = $_POST['peneliti'];
    $bidang = $_POST['bidang'];

    $sql = "UPDATE penelitian SET judul_penelitian='$judul_penelitian', peneliti='$peneliti', bidang='$bidang' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>