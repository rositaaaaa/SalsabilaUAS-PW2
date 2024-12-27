<?php
require __DIR__ . '/vendor/autoload.php'; // Autoload composer

use Mpdf\Mpdf;

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

// Memulai instance mPDF
$mpdf = new Mpdf(['format' => 'A4-L']); // Format A4 landscape
$mpdf->SetTitle('Laporan Seminar');

// HTML untuk laporan
$html = '<h1 style="text-align: center;">Laporan Seminar</h1>';
$html .= '
<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse; font-size: 12px;">
    <thead>
        <tr style="background-color: #f2f2f2;">
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
    <tbody>';

// Tambahkan data dari database ke dalam tabel
$no = 1;
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $html .= '<tr>
            <td style="text-align: center;">' . $no++ . '</td>
            <td>' . htmlspecialchars($row['Judul']) . '</td>
            <td>' . htmlspecialchars(substr($row['Deskripsi'], 0, 50)) . '...</td>
            <td style="text-align: center;">' . date('d-m-Y', strtotime($row['Tanggal'])) . '</td>
            <td>' . htmlspecialchars($row['Lokasi']) . '</td>
            <td style="text-align: center;">' . $row['Kapasitas'] . '</td>
            <td style="text-align: right;">Rp ' . number_format($row['Harga'], 0, ',', '.') . '</td>
            <td>' . htmlspecialchars($row['Narasumber']) . '</td>
            <td style="text-align: center;">' . date('d-m-Y H:i:s', strtotime($row['Dibuat'])) . '</td>
        </tr>';
    }
} else {
    $html .= '<tr><td colspan="9" style="text-align: center;">Tidak ada data seminar.</td></tr>';
}

$html .= '</tbody></table>';

// Menambahkan HTML ke PDF
$mpdf->WriteHTML($html);

// Output file PDF ke browser
$mpdf->Output('Laporan_Seminar.pdf', 'D'); // 'D' untuk download
