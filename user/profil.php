<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

// Include file koneksi untuk menghubungkan ke database
include '../koneksi.php';

// Dapatkan username dari session
$username = $_SESSION['username'];

// Query untuk mendapatkan data user berdasarkan username
$query = "SELECT * FROM user WHERE username='$username'";
$result = mysqli_query($mysqli, $query);

// Periksa apakah data ditemukan
if (mysqli_num_rows($result) > 0) {
    // Ambil data dari hasil query
    $data = mysqli_fetch_assoc($result);
} else {
    // Tampilkan pesan jika data tidak ditemukan
    echo "Data user tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Anda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .parallax-window {
            min-height: 400px;
            position: relative;
            overflow: hidden;
            text-align: center;
            color: #fff;
        }

        .parallax-window nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1;
        }

        .logo a {
            color: #fff;
            text-decoration: none;
            font-size: 24px;
        }

        .btn-sign-up {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-sign-up:hover {
            background-color: #45a049;
        }

        .profil-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .profil-container h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .profil-container p {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .header-bottom {
            background-color: #f4f4f4;
            padding: 10px 0;
        }

        .today-date {
            margin: 0;
        }

        .nav-bottom {
            list-style-type: none;
            padding: 0;
        }

        .nav-bottom li {
            display: inline-block;
            margin: 0 10px;
        }

        .nav-bottom a {
            color: #333;
            text-decoration: none;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <!-- header -->
    <header class="parallax-window" data-parallax="scroll" data-image-src="image/header-bg.jpg">
        <nav>
            <h1 class="logo">
                <a href="/">Indonesia</a>
            </h1>
            <a href="../index.php" class="btn-sign-up">Log Out</a>
            <a href="lp.php" class="btn-sign-up">Back</a>
        </nav>
    </header>

    <!-- profil -->
    <section id="profil">
        <div class="profil-container">
            <h2>Profil Anda</h2>
            <p>Username: <?php echo $data['username']; ?></p>
            <p>Email: <?php echo $data['email']; ?></p>
        </div>
    </section>

    <!-- footer -->
    <footer>Created by Rafif Arsalan</footer>

    <!-- parallax js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="parallax.js/path/to/parallax.js"></script>
</body>

</html>
