<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_penelitian = $_POST['judul_penelitian'];
    $peneliti = $_POST['peneliti'];
    $bidang = $_POST['bidang'];

    $sql = "INSERT INTO penelitian (judul_penelitian, peneliti, bidang) VALUES ('$judul_penelitian', '$peneliti', '$bidang')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>