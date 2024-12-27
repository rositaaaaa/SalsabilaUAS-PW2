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

// Jika form login disubmit
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Query untuk mencari pengguna dengan username
    $sql = "SELECT * FROM tb_user WHERE username='$username' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verifikasi password yang di-hash
        if (password_verify($password, $user['password'])) {
            // Menyimpan session untuk login
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            // Mengarahkan ke halaman sesuai dengan role
            if ($user['role'] == 'Admin') {
                header("Location: dashboard_admin.php");
                exit();
            } elseif ($user['role'] == 'Pimpinan') {
                header("Location: laporan.php");
                exit();
            } elseif ($user['role'] == 'User') {
                header("Location: dasboard_user.php");
                exit();
            } else {
                $error_message = "Peran tidak dikenali!";
            }
        } else {
            $error_message = "Password salah!";
        }
    } else {
        $error_message = "Username tidak ditemukan!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        input[type="password"] {
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

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            margin-top: -15px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Login</h2>
        <form method="post" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" name="login">Login</button>

            <?php
            if (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
        </form>

        <p>Belum punya akun? <a href="register.php">Daftar sekarang</a></p>
    </div>

</body>

</html>