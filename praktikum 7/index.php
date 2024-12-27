<?php

include "Controller/BukuController.php";

$aplikasi =  new BukuController();

$request = $_SERVER['REQUEST_URI'];
$request = parse_url($request, PHP_URL_PATH);

switch($request){
    case '/';
    case '/index.php';
    $aplikasi->jalankan();
    break;
    case '/index.php/buku/simpan';
    $aplikasi->simpan();
    break;
    case '/index.php/hapus';
    $aplikasi->hapus();
    break;
}