<?php

// Koneksi ke database
$servername = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "ranti"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses form jika dikirimkan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    $posisi = $_POST['posisi'];
    $kategori = $_POST['kategori'];
    $kehadiran = $_POST['kehadiran'];
    $foto = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];

    // Upload foto
    $target_dir = "uploads/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . basename($foto);
    move_uploaded_file($foto_tmp, $target_file);

    // Simpan data ke database
    $sql = "INSERT INTO tb_peserta (nama, email, telepon, alamat, posisi, kategori, kehadiran, Upload_file)
            VALUES ('$nama', '$email', '$telepon', '$alamat', '$posisi', '$kategori', '$kehadiran', '$foto')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data peserta berhasil disimpan!'); window.location.href='dasboard_user.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi
    $conn->close();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Formulir Daftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .form-container {
            width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background-color: #f8d7da;
            /* Background form merah */
        }

        .form-container h2 {
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .form-group input[type="file"] {
            padding: 3px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
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
    <div class="form-container">
        <h2>Data Peserta</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon:</label>
                <input type="text" id="telepon" name="telepon" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea id="alamat" name="alamat" required></textarea>
            </div>
            <div class="form-group">
                <label for="posisi">Posisi:</label>
                <input type="text" id="posisi" name="posisi" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori:</label>
                <select id="kategori" name="kategori">
                    <option value="Umum">Umum</option>
                    <option value="Mahasiswa">Mahasiswa</option>
                    <option value="Dosen">Dosen</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kehadiran">Kehadiran:</label>
                <select id="kehadiran" name="kehadiran">
                    <option value="Hadir">Hadir</option>
                    <option value="Tidak Hadir">Tidak Hadir</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>
            <!-- Tombol simpan dengan tampilan yang sudah diminta -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <!-- <a href="Index.php">Simpan</a> -->
            </div>
        </form>
    </div>
</body>

</html>