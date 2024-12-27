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

// Ambil data seminar yang akan datang
$sql = "SELECT * FROM tb_seminar WHERE Tanggal >= CURDATE() ORDER BY Tanggal ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminari Mendatang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .seminar-item {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            background-color: #fff;
        }

        .seminar-item h3 {
            margin: 0;
            color: #2c3e50;
        }

        .seminar-item p {
            margin: 5px 0;
        }

        .btn-primary {
            background-color: #2980b9;
            border: none;
        }

        .btn-primary:hover {
            background-color: #3498db;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4">Seminari Mendatang</h1>

        <!-- Daftar Seminar -->
        <?php if ($result->num_rows > 0): ?>
            <?php while ($seminar = $result->fetch_assoc()): ?>
                <div class="seminar-item">
                    <h3><?= htmlspecialchars($seminar['Judul']) ?></h3>
                    <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($seminar['Tanggal'])) ?></p>
                    <p><strong>Lokasi:</strong> <?= htmlspecialchars($seminar['Lokasi']) ?></p>
                    <p><strong>Narasumber:</strong> <?= htmlspecialchars($seminar['Narasumber']) ?></p>
                    <p><?= htmlspecialchars($seminar['Deskripsi']) ?></p>
                    <a href="register2.php" class="btn btn-secondary">Daftar </a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Tidak ada seminar mendatang yang tersedia.</p>
        <?php endif; ?>

        <div class="mt-4">
            <a href="home.php" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Tutup koneksi database
$conn->close();
?>