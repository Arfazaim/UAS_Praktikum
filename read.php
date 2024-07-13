<?php
$sql = "SELECT * FROM penelitian";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['judul_penelitian'] . "</td>";
    echo "<td>" . $row['peneliti'] . "</td>";
    echo "<td>" . $row['bidang'] . "</td>";
    echo "<td><a href='edit.php?id=" . $row['id'] . "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
    echo "</tr>";
}
?>