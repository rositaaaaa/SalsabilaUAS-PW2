Berikan kod<?php
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

            // Query untuk mendapatkan total seminar
            $sql_total_seminar = "SELECT COUNT(*) AS total_seminar FROM tb_seminar";
            $result_total_seminar = $conn->query($sql_total_seminar);
            $total_seminar = $result_total_seminar->fetch_assoc()['total_seminar'];

            // Query untuk mendapatkan jumlah seminar berdasarkan status (selesai/belum selesai)
            $sql_seminar_status = "SELECT 
                        COUNT(*) AS total_ongoing,
                        (SELECT COUNT(*) FROM tb_seminar WHERE Tanggal < NOW()) AS total_completed
                        FROM tb_seminar WHERE Tanggal >= NOW()";
            $result_seminar_status = $conn->query($sql_seminar_status);
            $seminar_status = $result_seminar_status->fetch_assoc();

            // Query untuk mendapatkan jumlah seminar berdasarkan narasumber
            $sql_seminar_narasumber = "SELECT Narasumber, COUNT(*) AS total_narasumber
                           FROM tb_seminar 
                           GROUP BY Narasumber";
            $result_seminar_narasumber = $conn->query($sql_seminar_narasumber);

            // Query untuk mendapatkan seminar berdasarkan lokasi
            $sql_seminar_lokasi = "SELECT Lokasi, COUNT(*) AS total_lokasi
                       FROM tb_seminar 
                       GROUP BY Lokasi";
            $result_seminar_lokasi = $conn->query($sql_seminar_lokasi);

            ?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Seminar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Statistik Seminar</h1>

        <!-- Statistik Total Seminar -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Seminar</h5>
                        <p class="card-text"><?= $total_seminar ?> seminar telah diselenggarakan</p>
                    </div>
                </div>
            </div>

            <!-- Statistik Seminar Berdasarkan Status -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Status Seminar</h5>
                        <p class="card-text"><?= $seminar_status['total_ongoing'] ?> seminar sedang berlangsung</p>
                        <p class="card-text"><?= $seminar_status['total_completed'] ?> seminar telah selesai</p>
                    </div>
                </div>
            </div>

            <!-- Statistik Seminar Berdasarkan Narasumber -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Seminar Berdasarkan Narasumber</h5>
                        <ul class="list-group">
                            <?php
                            if ($result_seminar_narasumber->num_rows > 0) {
                                while ($row = $result_seminar_narasumber->fetch_assoc()) {
                                    echo "<li class='list-group-item'>" . htmlspecialchars($row['Narasumber']) . " - " . $row['total_narasumber'] . " seminar</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Seminar Berdasarkan Lokasi -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Seminar Berdasarkan Lokasi</h5>
                        <ul class="list-group">
                            <?php
                            if ($result_seminar_lokasi->num_rows > 0) {
                                while ($row = $result_seminar_lokasi->fetch_assoc()) {
                                    echo "<li class='list-group-item'>" . htmlspecialchars($row['Lokasi']) . " - " . $row['total_lokasi'] . " seminar</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Menutup koneksi database
$conn->close();
?>
ingan