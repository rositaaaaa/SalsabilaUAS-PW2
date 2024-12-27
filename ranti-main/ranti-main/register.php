<?php
session_start();

// Menghubungkan ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ranti";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika form pendaftaran disubmit
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_DEFAULT); // Enkripsi password
    $role = $_POST['role'];

    // Query untuk menyimpan data pengguna
    $sql = "INSERT INTO tb_user (username, password, role) VALUES ('$username', '$password_hash', '$role')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Pendaftaran berhasil! Silakan login.";
        header("Location: login_seminar.php");
        exit();
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #333333;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555555;
        }

        input[type="text"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 20px;
            color: #555555;
        }

        .error-message {
            color: red;
            margin-top: -15px;
            margin-bottom: 15px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Daftar Akun Baru</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <!-- <option value="admin">Admin</option>
                <option value="pimpinan">Pimpinan</option> -->
            </select>

            <button type="submit" name="register">Daftar</button>

            <?php
            if (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
        </form>
        <p>Sudah punya akun? <a href="login_seminar.php">Login di sini</a></p>
    </div>

</body>

</html>