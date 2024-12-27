<?php
$password = 'Seminar'; // Ganti dengan password yang Anda inginkan
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Menggunakan BCRYPT untuk hashing
echo $hashed_password;
?>