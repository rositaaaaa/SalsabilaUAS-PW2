<?php
// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = getenv('DB_PASSWORD'); // Menggunakan variabel lingkungan untuk keamanan
$dbname = "ranti";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data form saat dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $kapasitas = $_POST['kapasitas'];
    $harga_kategori = $_POST['harga_kategori'];
    $narasumber = $_POST['narasumber'];
    $kategori = $_POST['kategori'];
    $foto = $_FILES['foto']['name']; // Menangani file upload
    $role = $_POST['role'];

    // Menyimpan foto di folder "uploads"
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // SQL query untuk menyimpan data seminar
        $sql = "INSERT INTO tb_admin (judul, deskripsi, tanggal, lokasi, kapasitas, harga_kategori, narasumber, foto, created_at, updated_at, kategori, role)
                VALUES ('$judul', '$deskripsi', '$tanggal', '$lokasi', '$kapasitas', '$harga_kategori', '$narasumber', '$foto', NOW(), NOW(), '$kategori', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "Data admin berhasil ditambahkan!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah foto.";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Admin</title>
    <style>
        form {
            width: 600px;
            margin: 20px auto;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
            background-color: #f8d7da;
            /* Background form merah */
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px 15px;
            border-radius: 4px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group a {
            display: block;
            text-align: center;
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: purple;
            /* Warna ungu */
            background-color: white;
            /* Background putih */
            padding: 10px;
            border: 1px solid purple;
            border-radius: 5px;
            text-decoration: none;
        }

        .form-group a:hover {
            color: darkviolet;
            /* Warna lebih gelap saat hover */
            background-color: #f8f9fa;
            /* Background lebih terang saat hover */
        }
    </style>
</head>

<body>
    <form action="simpan_admin.php" method="post" enctype="multipart/form-data">
        <h2>Data Admin</h2>

        <div class="form-group">
            <label for="judul">Id_Admin:</label>
            <input type="text" id="judul" name="judul" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Nama:</label>
            <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="tanggal">Username:</label>
            <input type="date" id="tanggal" name="tanggal" required>
        </div>

        <div class="form-group">
            <label for="lokasi">Password:</label>
            <input type="text" id="lokasi" name="lokasi" required>
        </div>

        <div class="form-group">
            <label for="kapasitas">Email:</label>
            <input type="number" id="kapasitas" name="kapasitas" required>
        </div>

        <div class="form-group">
            <label for="harga_kategori">Telepon:</label>
            <input type="text" id="harga_kategori" name="harga_kategori" required>
        </div>

        <div class="form-group">
            <label for="narasumber">Jabatan:</label>
            <input type="text" id="narasumber" name="narasumber" required>
        </div>

        <div class="form-group">
            <label for="kategori">Alamat:</label>
            <input type="text" id="kategori" name="kategori" required>
        </div>

        <div class="form-group">
            <label for="foto">Profile:</label>
            <input type="file" id="foto" name="foto" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="admin">Admin</option>
                <option value="pemimpin">Pemimpin</option>
            </select>
        </div>

        <!-- Tombol lanjut dengan tampilan yang sudah diminta -->
        <div class="form-group">
            <a href="tb_Seminar.php">Lanjut</a>
        </div>
    </form>
</body>

</html>