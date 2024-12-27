<?php

session_start();


echo 'Sesi sebelum logout: ' . print_r($_SESSION, true);


session_unset();
session_destroy();


echo 'Sesi setelah logout: ' . print_r($_SESSION, true);


header('Location: login&daftar.php');
exit;
?>