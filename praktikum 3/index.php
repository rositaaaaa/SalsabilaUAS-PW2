<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Praktikum 3</title>
</head>
<body>
    <div class="">
        <?php
            include "Visibility.php";

            $visibility = new Visibility();
            $visibility->tampilkanData();

            echo "<br>";

            echo "Akses diluar kelas";
            echo "Public :" . $visibility->public . "<br>";
            //echo "Private :" . $visibility->private . "<br>";
            //echo "Protected :" . $visibility->protected . "<br>";
            echo "<br> <br>";
            echo "<h2> Komsep Pewarisan </h2>";

            include "Mahasiswa.php";

            $mahasiswa = new Mahasiswa ("Emely Smith");
            $mahasiswa->ucapSalam();

            $mahasiswaInggris = new MahasiswaAsing("John Walker");
            $mahasiswaInggris->ucapSalam();
        ?>
    </div>
</body>
</html>