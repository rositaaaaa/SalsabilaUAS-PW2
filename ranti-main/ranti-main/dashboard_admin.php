<?php
session_start();

// Periksa apakah pengguna sudah login dan apakah mereka memiliki peran 'admin'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'Admin') {
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <!-- Menggunakan CDN Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <h1 class="mt-4">Selamat datang, Admin!</h1>
        <p>Ini adalah halaman dashboard admin. Anda dapat mengelola semua data di sini.</p>

        <ul class="list-group">
            <li class="list-group-item"><a href="data_seminar.php" class="text-decoration-none">Kelola Seminar</a></li>
            <li class="list-group-item"><a href="data_peserta.php" class="text-decoration-none">Kelola Peserta</a></li>
            <li class="list-group-item"><a href="Laporan.php" class="text-decoration-none">Laporan</a></li>
            <li class="list-group-item"><a href="logout.php" class="text-decoration-none">Logout</a></li>
        </ul>

    </div>

</body>

</html>