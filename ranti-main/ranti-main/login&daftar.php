<?php

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login atau Daftar</title>
    <style>
        /* Gaya untuk form */
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 10px 0;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login atau Daftar</h2>
        <a href="login_seminar.php" class="btn">Login</a>
        <a href="register.php" class="btn">Daftar</a>
    </div>
</body>
</html>