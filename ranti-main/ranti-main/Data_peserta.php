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

// Proses CRUD peserta
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Menyimpan data peserta
    if ($action == 'simpan' && isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];
        $posisi = $_POST['posisi'];
        $kategori = $_POST['kategori'];
        $kehadiran = $_POST['kehadiran'];

        // Handle upload file
        $upload_file = $_FILES['file']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($upload_file);
        move_uploaded_file($_FILES['file']['tmp_name'], $target_file);

        $sql = "INSERT INTO tb_peserta (Nama, Email, Telepon, Alamat, Posisi, Kategori, Kehadiran, Upload_file) 
                VALUES ('$nama', '$email', '$telepon', '$alamat', '$posisi', '$kategori', '$kehadiran', '$upload_file')";
        $conn->query($sql);
        header("Location:data_peserta.php");
    }

    // Menghapus peserta
    if ($action == 'hapus' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM tb_peserta WHERE Id_Peserta = $id";
        $conn->query($sql);
        header("Location: data_peserta.php");
    }

    // Menampilkan form edit peserta
    if ($action == 'edit' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_peserta WHERE Id_Peserta = $id";
        $result = $conn->query($sql);
        $peserta = $result->fetch_assoc();
    }

    // Memperbarui data peserta
    if ($action == 'update' && isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $telepon = $_POST['telepon'];
        $alamat = $_POST['alamat'];
        $posisi = $_POST['posisi'];
        $kategori = $_POST['kategori'];
        $kehadiran = $_POST['kehadiran'];

        // Handle upload file
        if ($_FILES['file']['name'] != '') {
            $upload_file = $_FILES['file']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($upload_file);
            move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
        } else {
            // Jika tidak ada file yang diupload, pakai file lama
            $upload_file = $_POST['existing_file'];
        }

        $sql = "UPDATE tb_peserta SET 
                Nama = '$nama', Email = '$email', Telepon = '$telepon', Alamat = '$alamat', 
                Posisi = '$posisi', Kategori = '$kategori', Kehadiran = '$kehadiran', 
                Upload_file = '$upload_file' WHERE Id_Peserta = $id";
        $conn->query($sql);
        header("Location: data_peserta.php");
    }
}

// Query untuk mengambil data dari tabel tb_peserta
$sql = "SELECT * FROM tb_peserta";
$result = $conn->query($sql);

// Pencarian peserta
$searchQuery = '';
if (isset($_GET['query'])) {
    $searchQuery = $_GET['query'];
    $sql = "SELECT * FROM tb_peserta WHERE Nama LIKE '%$searchQuery%' OR Posisi LIKE '%$searchQuery%'";
    $result = $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Data Peserta</h1>

        <!-- Tombol Tambah Peserta -->
        <a href="?action=tambah" class="btn btn-primary mb-3">Tambah Peserta</a>

        <!-- Tabel Data Peserta -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Posisi</th>
                    <th>Kategori</th>
                    <th>Kehadiran</th>
                    <th>Foto</th>
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
                        echo "<td>" . htmlspecialchars($row['Nama']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Telepon']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Alamat']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Posisi']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Kategori']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['Kehadiran']) . "</td>";

                        // Menampilkan foto dari folder uploads berdasarkan field Upload_file
                        $fotoPath = !empty($row['Upload_file']) ? "uploads/" . $row['Upload_file'] : "assets/images/default.jpg";
                        echo "<td><img src='" . htmlspecialchars($fotoPath) . "' alt='Foto Peserta' style='width: 80px; height: 80px; object-fit: cover; border-radius: 5px;'></td>";

                        // Pastikan 'Dibuat' ada sebelum digunakan
                        if (isset($row['Dibuat'])) {
                            echo "<td>" . date('d-m-Y H:i:s', strtotime($row['Dibuat'])) . "</td>";
                        } else {
                            echo "<td>-</td>"; // Jika tidak ada 'Dibuat', tampilkan tanda '-'
                        }

                        echo "<td>
                        <div class='d-flex justify-content-start'>
                            <a href='?action=edit&id=" . $row['Id_Peserta'] . "' class='btn btn-warning btn-sm me-2'>Edit</a>
                            <a href='?action=hapus&id=" . $row['Id_Peserta'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                        </div>
                      </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Tidak ada data peserta.</td></tr>";
                }
                ?>
            </tbody>
        </table>



        <!-- Form untuk pencarian peserta -->
        <form class="mt-4" method="GET" action="">
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" value="<?= $searchQuery ?>" placeholder="Cari peserta...">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
    </div>

    <?php
    // Form untuk menambah atau mengedit peserta
    if (isset($_GET['action']) && ($_GET['action'] == 'tambah' || $_GET['action'] == 'edit')) {
        $isEdit = ($_GET['action'] == 'edit');
        $pesertaData = $isEdit ? $peserta : null;
    ?>

        <div class="container">
            <h1><?= $isEdit ? 'Edit Peserta' : 'Tambah Peserta' ?></h1>
            <form action="?action=<?= $isEdit ? 'update' : 'simpan' ?>" method="POST" enctype="multipart/form-data">
                <?php if ($isEdit) { ?>
                    <input type="hidden" name="id" value="<?= $pesertaData['Id_Peserta'] ?>">
                    <input type="hidden" name="existing_file" value="<?= $pesertaData['Upload_file'] ?>">
                <?php } ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= $isEdit ? $pesertaData['Nama'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $isEdit ? $pesertaData['Email'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input type="text" class="form-control" id="telepon" name="telepon" value="<?= $isEdit ? $pesertaData['Telepon'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" required><?= $isEdit ? $pesertaData['Alamat'] : '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="posisi" class="form-label">Posisi</label>
                    <input type="text" class="form-control" id="posisi" name="posisi" value="<?= $isEdit ? $pesertaData['Posisi'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= $isEdit ? $pesertaData['Kategori'] : '' ?>" required>
                </div>
                <div class="mb-3">
                    <label for="kehadiran" class="form-label">Kehadiran</label>
                    <select class="form-control" id="kehadiran" name="kehadiran">
                        <option value="Hadir" <?= $isEdit && $pesertaData['Kehadiran'] == 'Hadir' ? 'selected' : '' ?>>Hadir</option>
                        <option value="Tidak Hadir" <?= $isEdit && $pesertaData['Kehadiran'] == 'Tidak Hadir' ? 'selected' : '' ?>>Tidak Hadir</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Upload File</label>
                    <input type="file" class="form-control" id="file" name="file">
                    <?php if ($isEdit && $pesertaData['Upload_file']) { ?>
                        <p><a href="uploads/<?= $pesertaData['Upload_file'] ?>" target="_blank">Lihat file yang diupload</a></p>
                    <?php } ?>
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