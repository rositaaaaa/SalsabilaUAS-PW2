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

// Misalkan kita mendapatkan password dari form registrasi
$user_password = $_POST['Online']; // Password dari form

// Hash password menggunakan bcrypt
$hashed_password = password_hash($user_password, PASSWORD_BCRYPT);

// Simpan username dan hashed password di database
$username = $_POST['Ranti']; // Username dari form

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Pendaftaran berhasil!";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
