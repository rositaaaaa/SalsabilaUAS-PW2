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
$querySeminarAkanDatang = "SELECT * FROM tb_seminar WHERE Tanggal >= CURDATE() ORDER BY Tanggal ASC LIMIT 1";
$seminarAkanDatang = $conn->query($querySeminarAkanDatang)->fetch_assoc();

// Data pengguna dummy (seharusnya diambil dari session setelah login)
$pengguna = [
    'nama' => 'John Smith',
    'email' => 'john.smith@example.com',
    'seminar_terdaftar' => 5
];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .sidebar {
            background-color: #2c3e50;
            color: #ecf0f1;
            width: 250px;
            padding: 20px;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 15px 0;
        }

        .sidebar ul li a {
            color: #ecf0f1;
            text-decoration: none;
            font-size: 18px;
        }

        .sidebar ul li a:hover {
            text-decoration: underline;
        }

        .content {
            flex: 1;
            padding: 20px;
            background-color: #f4f4f4;
            overflow-y: auto;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #3498db;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Dashboard Seminar</h2>
        <ul>
            <li><a href="home.php">Beranda</a></li>
            <li><a href="profile.php">Profil</a></li>
            <li><a href="upcoming.php">Seminar Mendatang</a></li>
            <li><a href="logout.php" id="logout-btn">Logout</a></li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <!-- Bagian Beranda -->
        <section id="home">
            <h1>Selamat Datang, <span id="user-name"><?= $pengguna['nama'] ?></span></h1>
            <p>Ikhtisar dashboard seminar Anda.</p>
        </section>

        <!-- Bagian Profil -->
        <section id="profile" class="card">
            <h2>Profil Anda</h2>
            <p><strong>Nama:</strong> <span id="profile-name"><?= $pengguna['nama'] ?></span></p>
            <p><strong>Email:</strong> <span id="profile-email"><?= $pengguna['email'] ?></span></p>
            <p><strong>Seminar Terdaftar:</strong> <span id="registered-seminars"><?= $pengguna['seminar_terdaftar'] ?></span></p>
        </section>

        <!-- Bagian Seminar Mendatang -->
        <?php if ($seminarAkanDatang): ?>
            <section id="upcoming" class="card">
                <h2>Seminar Mendatang</h2>
                <p><strong>Judul:</strong> <?= htmlspecialchars($seminarAkanDatang['Judul']) ?></p>
                <p><strong>Deskripsi:</strong> <?= htmlspecialchars($seminarAkanDatang['Deskripsi']) ?></p>
                <p><strong>Tanggal:</strong> <?= date('d-m-Y', strtotime($seminarAkanDatang['Tanggal'])) ?></p>
                <p><strong>Lokasi:</strong> <?= htmlspecialchars($seminarAkanDatang['Lokasi']) ?></p>
                <p><strong>Narasumber:</strong> <?= htmlspecialchars($seminarAkanDatang['Narasumber']) ?></p>
                <button id="join-seminar-btn">Ikuti Seminar</button>
            </section>
        <?php else: ?>
            <section id="upcoming" class="card">
                <h2>Tidak Ada Seminar Mendatang</h2>
                <p>Anda belum terdaftar untuk seminar mendatang.</p>
            </section>
        <?php endif; ?>
    </div>

    <script>
        // Muat data pengguna secara dinamis
        document.addEventListener("DOMContentLoaded", () => {
            const userName = document.getElementById("user-name").textContent;
            console.log(Pengguna $ {
                    userName
                }
                sedang login.);
        });

        // Tombol Ikuti Seminar
        document.getElementById("join-seminar-btn")?.addEventListener("click", () => {
            alert("Mengalihkan ke platform seminar...");
            // Logika untuk mengikuti seminar (misalnya, alihkan ke URL seminar)
        });

        // Tombol Logout
        document.getElementById("logout-btn").addEventListener("click", (e) => {
            e.preventDefault();
            alert("Anda telah keluar.");
            window.location.href = "login_seminar.php"; // Alihkan ke halaman login
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>