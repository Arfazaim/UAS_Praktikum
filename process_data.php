<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "penelitian_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $judul_penelitian = $_POST['judul_penelitian'];
  $peneliti = $_POST['peneliti'];
  $bidang = $_POST['bidang'];

  $sql = "INSERT INTO penelitian (judul_penelitian, peneliti, bidang)
  VALUES ('$judul_penelitian', '$peneliti', '$bidang')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['katakunci'])) {
  $katakunci = $_GET['katakunci'];
  $sql = "SELECT * FROM penelitian WHERE judul_penelitian LIKE '%$katakunci%' OR peneliti LIKE '%$katakunci%' OR bidang LIKE '%$katakunci%'";
} else {
  $sql = "SELECT * FROM penelitian";
}

$result = $conn->query($sql);
$conn->close();
?>
