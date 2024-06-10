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
    <title>Landing page</title>
    <link rel="stylesheet" href="landing1.css">

    <!-- parallax js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="parallax.js/path/to/parallax.js"></script>
</head>

<body>

    <!-- header -->
    <header class="parallax-window" data-parallax="scroll" data-image-src="image/header-bg.jpg">
        <nav>
            <ul class="nav-bottom">
                <li><a href="artikel.php">Home</a></li>
                <li><a href="komentar.php">comment</a></li>
                <li><a href="masukan-form.php">masukkan</a></li>
                <li><a href="produk.php">produk</a></li>
            </ul>
            <div>

                <a href="profil.php" class="btn-sign-up">Profil</a>
                <a href="../index.php" class="btn-sign-up">Log Out</a>
            </div>
        </nav>
        <div class="header-title">Sumber Daya Alam</div>
        <div class="header-bottom">

        </div>
    </header>


    <!-- about -->
    <section id="about">
        <div class="about-container">
            <div class="image-gallery">
                <div class="image-box">
                    <img src="image/img-1.jpg" alt="image">
                    <div class="txt-img">Sumber</div>
                </div>
                <div class="image-box">
                    <img src="image/img-2.jpg" alt="image">
                    <div class="txt-img">Daya</div>
                </div>
                <div class="image-box">
                    <img src="image/img-3.jpg" alt="image">
                    <div class="txt-img">Alam</div>
                </div>
                <div class="image-box">
                    <img src="image/img-4.jpg" alt="image">
                    <div class="txt-img">Lestari</div>
                </div>
            </div>
            <div class="about-info">
               Website ini dibuat untuk mengajak kepada semua orang untuk menjaga dan melestarikan sumber daya alam yang ada di indonesia. Anda juga bisa menngeksplorasi apa saja sumber daya alam yang kita miliki di negara kita ini dari segala kategori.
            </div>
        </div>
    </section>

    <!-- footer -->
    <footer>Created by Rafif Arsalan</footer>
</body>

</html>