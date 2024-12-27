<?php
include "Orang.php";
include "BankCustomer.php";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hallo Praktikum 2</h1>
    <div class="di">
        <?php
            $nasabah = new BankCustomer();
            $nasabah->setCustomerName('Rosita');
            $nasabah->setAddress('Mendalo, Muara Jambi');
            $nasabah->setEmail('rositabangun57@gmail.com');
            $nasabah->setCard('Platinum');
            $nasabah->setAcc('Wadiah');

            $nasabah->insertCard();
            $nasabah->enterPIN(123456);
        ?>
    </div>
</body>
</html>
<!-- localhost/index.php?nama=Rosita -->
<!-- http:uinjambi.ac.id/berita?page=1&search=kuliah&orderBy=id -->