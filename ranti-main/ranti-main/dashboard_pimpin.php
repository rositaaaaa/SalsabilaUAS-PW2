<?php
session_start();

// Periksa apakah pengguna sudah login dan apakah mereka memiliki peran 'pimpinan'
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'pimpinan') {
    header("Location: /login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Pimpinan</title>
</head>
<body>

    <h1>Selamat datang, Pimpinan!</h1>
    <p>Ini adalah halaman dashboard pimpinan. Anda dapat melihat laporan di sini.</p>
    
    <ul>
        <li><a href="/pimpinan/view_reports.php">Laporan</a></li>
        <li><a href="/pimpinan/statistics.php">Statistik</a></li>
        <li><a href="/logout.php">Logout</a></li>
    </ul>

</body>
</html>