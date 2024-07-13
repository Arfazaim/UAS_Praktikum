<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Platform Penelitian dan Publikasi Ilmiah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body class="bg-light">
    <main class="container">
        <!-- Config -->
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "penelitian_db";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
            $judul_penelitian = $_POST['judul_penelitian'];
            $peneliti = $_POST['peneliti'];
            $bidang = $_POST['bidang'];

            if ($_POST['submit'] == 'SIMPAN') {
                $sql = "INSERT INTO penelitian (judul_penelitian, peneliti, bidang) VALUES ('$judul_penelitian', '$peneliti', '$bidang')";
            } elseif ($_POST['submit'] == 'UPDATE') {
                $id = $_POST['id'];
                $sql = "UPDATE penelitian SET judul_penelitian='$judul_penelitian', peneliti='$peneliti', bidang='$bidang' WHERE id='$id'";
            }

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Record updated successfully</div>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        if (isset($_GET['delete_id'])) {
            $id = $_GET['delete_id'];
            $sql = "DELETE FROM penelitian WHERE id='$id'";
            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Record deleted successfully</div>";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }

        $edit_data = null;
        if (isset($_GET['edit_id'])) {
            $id = $_GET['edit_id'];
            $sql = "SELECT * FROM penelitian WHERE id='$id'";
            $result = $conn->query($sql);
            $edit_data = $result->fetch_assoc();
        }
        ?>

        <!-- START FORM -->
        <form action='' method='post'>
            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <div class="mb-3 row">
                    <label for="judul_penelitian" class="col-sm-2 col-form-label">Judul Penelitian</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='judul_penelitian' id="judul_penelitian" value="<?= $edit_data['judul_penelitian'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="peneliti" class="col-sm-2 col-form-label">Peneliti</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='peneliti' id="peneliti" value="<?= $edit_data['peneliti'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="bidang" class="col-sm-2 col-form-label">Bidang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name='bidang' id="bidang" value="<?= $edit_data['bidang'] ?? '' ?>">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="jurusan" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <?php if ($edit_data): ?>
                            <input type="hidden" name="id" value="<?= $edit_data['id'] ?>">
                            <button type="submit" class="btn btn-primary" name="submit" value="UPDATE">UPDATE</button>
                        <?php else: ?>
                            <button type="submit" class="btn btn-primary" name="submit" value="SIMPAN">SIMPAN</button>
                        <?php endif; ?>
                    </div>
                </div>
            </form>
        </div>
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <!-- FORM PENCARIAN -->
            <div class="pb-3">
                <form class="d-flex" action="" method="get">
                    <input class="form-control me-1" type="search" name="katakunci" value="<?= $_GET['katakunci'] ?? '' ?>" placeholder="Masukkan kata kunci" aria-label="Search">
                    <button class="btn btn-secondary" type="submit">Cari</button>
                </form>
            </div>

            <!-- TOMBOL TAMBAH DATA -->
            <div class="pb-3">
                <a href='<?= $_SERVER['PHP_SELF'] ?>' class="btn btn-primary">+ Tambah Data</a>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Judul Penelitian</th>
                        <th class="col-md-4">Peneliti</th>
                        <th class="col-md-2">Bidang</th>
                        <th class="col-md-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM penelitian";
                    if (isset($_GET['katakunci'])) {
                        $katakunci = $_GET['katakunci'];
                        $sql .= " WHERE judul_penelitian LIKE '%$katakunci%' OR peneliti LIKE '%$katakunci%' OR bidang LIKE '%$katakunci%'";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['judul_penelitian'] . "</td>";
                            echo "<td>" . $row['peneliti'] . "</td>";
                            echo "<td>" . $row['bidang'] . "</td>";
                            echo "<td><a href='?edit_id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> <a href='?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Delete</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </div>
        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>
