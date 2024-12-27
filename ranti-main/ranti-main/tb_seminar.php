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

    // Menyimpan foto di folder "uploads"
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // SQL query untuk menyimpan data seminar
        $sql = "INSERT INTO tb_seminar (judul, deskripsi, tanggal, lokasi, kapasitas, harga_kategori, narasumber, foto, created_at, updated_at, kategori)
                VALUES ('$judul', '$deskripsi', '$tanggal', '$lokasi', '$kapasitas', '$harga_kategori', '$narasumber', '$foto', NOW(), NOW(), '$kategori')";

        if ($conn->query($sql) === TRUE) {
            echo "Data seminar berhasil ditambahkan!";
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
    <title>Form Seminar</title>
    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Form Seminar</title>
        <style>
            form {
                width: 600px;
                margin: 20px auto;
                border: 1px solid #ccc;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 2px 2px 12px rgba(0, 0, 0, 0.1);
                background-color: #f8d7da;
                /* Background form menjadi merah */
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

            input[type="submit"]:hover {
                background-color: #218838;
            }

            .link-simpan {
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

            .link-simpan:hover {
                color: darkviolet;
                /* Warna lebih gelap saat hover */
                background-color: #f8f9fa;
                /* Background lebih terang saat hover */
            }
        </style>
    </head>

<body>
    <?php
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tb_mahasiswa");
    if (!$result) {
        echo "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
    } else {
        $data = mysqli_fetch_assoc($result);
        echo "<h3>" . $data['total'] . "</h3>";
    }
    ?>

    <!-- Tambahkan link simpan di tengah form -->
    <a href="selesai.php" class="link-simpan">Simpan</a>
    </form>
</body>

</html>