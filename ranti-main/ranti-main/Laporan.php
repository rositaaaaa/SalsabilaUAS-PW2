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

// Query untuk mengambil data seminar
$sql = "SELECT * FROM tb_seminar";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Laporan Seminar</h1>

        <!-- Tombol untuk download laporan PDF -->
        <div class="text-end mb-3">
            <a href="generate_report.php" class="btn btn-success">Unduh Laporan PDF</a>
        </div>

        <!-- Tabel Laporan Seminar -->
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
                        echo "<td>" . date('d-m-Y H:i:s', strtotime($row['Dibuat'])) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data seminar.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>