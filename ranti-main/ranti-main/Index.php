<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Universitas UIN Sutha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    /* Top Bar */
    .top-bar {
      background-color: #002f4b;
      color: #fff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }

    .contact-info span {
      margin-right: 15px;
    }

    .auth-links a {
      margin-left: 15px;
      color: #fff;
      text-decoration: none;
      transition: color 0.3s ease-in-out;
    }

    .auth-links a:hover {
      color: #00bcd4;
    }

    /* Navbar Header */
    .navbar-header {
      background-image: url('PABLIK.jpg'); /* Pastikan gambar tersedia */
      background-size: cover;
      background-position: center center;
      background-repeat: no-repeat;
      height: 500px;
      position: relative;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .navbar-header h1 {
      background: rgba(0, 0, 0, 0.6);
      padding: 20px 40px;
      border-radius: 5px;
      font-size: 50px;
      text-align: center;
    }

    /* Main Content */
    .main-content {
      background-color: #f9f9f9;
      padding: 50px 20px;
      text-align: center;
    }

    .page-title {
      font-size: 40px;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
    }

    .breadcrumb {
      margin-bottom: 20px;
      color: #666;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
      .navbar-header h1 {
        font-size: 30px;
        padding: 10px 20px;
      }

      .top-bar {
        flex-direction: column;
        text-align: center;
      }

      .auth-links a {
        display: block;
        margin: 5px 0;
      }
    }

    /* Button Styling */
    .btn-custom {
      background-color: #00bcd4;
      color: #fff;
      padding: 10px 20px;
      border-radius: 5px;
      text-decoration: none;
      transition: background 0.3s ease-in-out;
    }

    .btn-custom:hover {
      background-color: #008ba3;
      color: #fff;
    }
  </style>
</head>
<body>
  <!-- Top Bar -->
  <header class="top-bar">
    <div class="contact-info">
      <span>Seminar Online</span>
    </div>
    <div class="auth-links">
    </div>
  </header>

  <!-- Login Link -->
  <div class="text-end px-3 py-2">
    <a href="login&daftar.php" class="btn-custom">Login</a>
  </div>

  <!-- Navbar Header -->
  <section class="navbar-header">
    <h1>Welcome to Seminar Online</h1>
  </section>

  <!-- Main Content -->
  <main class="main-content">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
      <span>Home</span> &bull; <span>Seminars</span>
    </div>
    
    <!-- Titles -->
    <h1 class="page-title">Universitas Islam Negeri Sultan Thaha Saifudin Jambi</h1>
    
    <!-- Call to Action -->
    <div class="mt-4">
    </div>
  </main>
</body>
</html>