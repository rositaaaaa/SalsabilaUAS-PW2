<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ranti";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menangani form pendaftaran
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password']; // Password yang dimasukkan pengguna

    // Meng-hash password menggunakan bcrypt
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk menyimpan username dan hashed password ke dalam database
    $sql = "INSERT INTO tb_user (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pendaftaran</title>
</head>

<body>
    <form method="POST" action="">
        <h2>Daftar Akun</h2>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="register">Daftar</button>
    </form>
</body>

</html>