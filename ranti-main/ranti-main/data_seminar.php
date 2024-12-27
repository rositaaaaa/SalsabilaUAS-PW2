<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ranti";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses CRUD seminar
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Menyimpan data seminar
    if ($action == 'simpan' && isset($_POST['submit'])) {
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];
        $lokasi = $_POST['lokasi'];
        $kapasitas = $_POST['kapasitas'];
        $harga = $_POST['harga'];
        $narasumber = $_POST['narasumber'];

        $sql = "INSERT INTO tb_seminar (Judul, Deskripsi, Tanggal, Lokasi, Kapasitas, Harga, Narasumber) 
                VALUES ('$judul', '$deskripsi', '$tanggal', '$lokasi', '$kapasitas', '$harga', '$narasumber')";
        $conn->query($sql);
        header("Location: data_seminar.php");
    }

    // Menghapus seminar
    if ($action == 'hapus' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM tb_seminar WHERE ID = $id";
        $conn->query($sql);
        header("Location: data_seminar.php");
    }

    // Menampilkan form edit seminar
    if ($action == 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_seminar WHERE ID = $id";
        $result = $conn->query($sql);
        $seminar = $result->fetch_assoc();
    }

    // Memperbarui data seminar
    if ($action == 'update' && isset($_POST['submit'])) {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $deskripsi = $_POST['deskripsi'];
        $tanggal = $_POST['tanggal'];
        $lokasi = $_POST['lokasi'];
        $kapasitas = $_POST['kapasitas'];
        $harga = $_POST['harga'];
        $narasumber = $_POST['narasumber'];

        $sql = "UPDATE tb_seminar SET 
                Judul = '$judul', Deskripsi = '$deskripsi', Tanggal = '$tanggal', 
                Lokasi = '$lokasi', Kapasitas = '$kapasitas', Harga = '$harga', 
                Narasumber = '$narasumber' WHERE ID = $id";
        $conn->query($sql);
        header("Location: data_seminar.php");
    }
}

// Query untuk mengambil data dari tabel tb_seminar
$sql = "SELECT * FROM tb_seminar";
$result = $conn->query($sql);

// Pencarian seminar
$searchQuery = '';
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $sql = "SELECT * FROM tb_seminar WHERE Judul LIKE '%$searchQuery%' OR Deskripsi LIKE '%$searchQuery%'";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Data Seminar</h1>

        <!-- Tombol Tambah Seminar -->
        <a href="?action=tambah" class="btn btn-primary mb-3">Tambah Seminar</a>

        <!-- Tabel Data Seminar -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Tanggal</th>
                    <th>Lokasi</th>
                    <th>Kapasitas</th>
                    <th>Harga</th>
                    <th>Narasumber</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . htmlspecialchars($row['Judul']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Deskripsi']) . "</td>";
                        echo "<td>" . date('d-m-Y', strtotime($row['Tanggal'])) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Lokasi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Kapasitas']) . "</td>";
                        echo "<td>Rp " . number_format($row['Harga'], 0, ',', '.') . "</td>";
                        echo "<td>" . htmlspecialchars($row['Narasumber']) . "</td>";


                        // Pastikan 'created_at' ada sebelum digunakan
                        if (isset($row['Dibuat'])) {
                            echo "<td>" . date('d-m-Y H:i:s', strtotime($row['Dibuat'])) . "</td>";
                        } else {
                            echo "<td>-</td>"; // Jika tidak ada 'created_at', tampilkan tanda '-'
                        }

                        echo "<td>
                                <div class='d-flex justify-content-start'>
                                    <a href='?action=edit&id=" . $row['ID'] . "' class='btn btn-warning btn-sm me-2'>Edit</a>
                                    <a href='?action=hapus&id=" . $row['ID'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                </div>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>Tidak ada data seminar.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Form untuk pencarian seminar -->
        <form class="mt-4" method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" value="<?= $searchQuery ?>" placeholder="Cari seminar...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <?php
    // Form untuk menambah atau mengedit seminar
    if (isset($_GET['action']) && ($_GET['action'] == 'tambah' || $_GET['action'] == 'edit')) {
        $isEdit = ($_GET['action'] == 'edit');
        $seminarData = $isEdit ? $seminar : null;
    ?>

        <div class="container">
            <h1><?= $isEdit ? 'Edit Seminar' : 'Tambah Seminar' ?></h1>
            <form action="?action=<?= $isEdit ? 'update' : 'simpan' ?>" method="POST">
                <?php if ($isEdit) { ?>
                    <input type="hidden" name="id" value="<?= $seminarData['ID'] ?>">
                <?php } ?>
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="judul" name="judul" value="<?= $isEdit ? $seminarData['Judul'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" required><?= $isEdit ? $seminarData['Deskripsi'] : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= $isEdit ? $seminarData['Tanggal'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="lokasi" class="form-label">Lokasi</label>
                    <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= $isEdit ? $seminarData['Lokasi'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="number" class="form-control" id="kapasitas" name="kapasitas" value="<?= $isEdit ? $seminarData['Kapasitas'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="<?= $isEdit ? $seminarData['Harga'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="narasumber" class="form-label">Narasumber</label>
                    <input type="text" class="form-control" id="narasumber" name="narasumber" value="<?= $isEdit ? $seminarData['Narasumber'] : '' ?>" required>
                </div>
                <button type="submit" name="submit" class="btn btn-primary"><?= $isEdit ? 'Update' : 'Simpan' ?></button>
            </form>
        </div>
    <?php
    }
    ?>

</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>