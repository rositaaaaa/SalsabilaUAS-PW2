<?php
// Dummy data pengguna (seharusnya diambil dari session login atau database)
$user = [
    'name' => 'John Smith',
    'email' => 'john.smith@example.com',
    'phone' => '081234567890',
    'address' => 'Jl. Merdeka No. 123, Jakarta',
];

// Proses edit profil (seharusnya disimpan ke database)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user['name'] = $_POST['name'];
    $user['email'] = $_POST['email'];
    $user['phone'] = $_POST['phone'];
    $user['address'] = $_POST['address'];
    $message = "Profil berhasil diperbarui!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Seminar Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #2980b9;
            border: none;
        }
        .btn-primary:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Profil</h1>
        <p>Kelola informasi pribadi Anda dan perbarui detail profil Anda di bawah ini.</p>
        
        <!-- Pesan Sukses -->
        <?php if (isset($message)): ?>
            <div class="alert alert-success">
                <?= $message ?>
            </div>
        <?php endif; ?>
        
        <!-- Informasi Profil -->
        <div class="mb-4">
            <h3>Profil Anda</h3>
            <p><strong>Nama:</strong> <?= htmlspecialchars($user['name']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Telepon:</strong> <?= htmlspecialchars($user['phone']) ?></p>
            <p><strong>Alamat:</strong> <?= htmlspecialchars($user['address']) ?></p>
        </div>

        <!-- Form Edit Profil -->
        <form method="POST" action="profile.php">
            <h3>Perbarui Profil</h3>
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Alamat</label>
                <textarea class="form-control" id="address" name="address" required><?= htmlspecialchars($user['address']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Perbarui Profil</button>
        </form>

        <!-- Tombol Logout -->
        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Keluar</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>