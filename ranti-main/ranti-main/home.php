<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Seminar Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .hero {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 50px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 20px;
            margin-bottom: 30px;
        }
        .btn-primary {
            background-color: #2980b9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3498db;
        }
        .seminar-list {
            padding: 20px 0;
        }
        .seminar-item {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Seminar Online</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Dashboard</a>
                    </li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <h1>Selamat Datang di Seminar Online</h1>
        <p>Jelajahi dan daftarkan diri Anda untuk seminar-seminar menarik untuk meningkatkan pengetahuan dan keterampilan Anda!</p>
        <a href="dashboard.php" class="btn btn-primary btn-lg">Masuk ke Dashboard</a>
    </section>

    <!-- Daftar Seminar -->
    <div class="container seminar-list">
        <h2 class="mb-4">Seminar Mendatang</h2>
        <div class="seminar-item">
            <h3>Pemrograman Web Lanjutan</h3>
            <p><strong>Tanggal:</strong> 20 Desember 2024</p>
            <p><strong>Lokasi:</strong> Online</p>
            <p><strong>Narasumber:</strong> John Doe</p>
            <button class="btn btn-primary">Daftar</button>
        </div>
        <div class="seminar-item">
            <h3>Pengenalan ke AI</h3>
            <p><strong>Tanggal:</strong> 15 Januari 2025</p>
            <p><strong>Lokasi:</strong> Hybrid (Online & Onsite)</p>
            <p><strong>Narasumber:</strong> Jane Smith</p>
            <button class="btn btn-primary">Daftar</button>
        </div>
    </div>

    <!-- Bagian Tentang -->
    <div class="container my-5" id="about">
        <h2>Tentang Seminar Online</h2>
        <p>
            Seminar Online adalah platform yang menghubungkan para profesional dan penggemar dengan berbagai kesempatan untuk berbagi pengetahuan.
            Kami menyediakan akses ke seminar online dan onsite yang diselenggarakan oleh para pemimpin industri dan ahli.
        </p>
    </div>

    <!-- Bagian Kontak -->
    <footer class="bg-dark text-white py-4" id="contact">
        <div class="container text-center">
            <p>Hubungi kami di: seminar@online.com | Telepon: +62 82234352818</p>
            <p>Ikuti kami di: <a href="https://www.facebook.com/profile.php?id=61550618720950" class="text-white">Facebook</a> | <a href="https://www.instagram.com/rantiasmara09?igsh=djltbmN2YjdieDU1" class="text-white">Instagram</a> |</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>