<?php

// Include file koneksi untuk menghubungkan ke database
include '../koneksi.php';

// Query untuk mendapatkan semua data dari tabel komentar dan kategori_sda
$query = "SELECT komentar.username, komentar.email, kategori_sda.jenis_sda, komentar.isi_komentar 
          FROM komentar 
          JOIN kategori_sda ON komentar.id_kategori_sda = kategori_sda.id_kategori_sda";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Komentar</title>
    <link rel="stylesheet" href="komentar1.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
           <h1>USER KOMENTAR</h1>
        </div>
        <ul class="nav-links">
            <li><a href="artikel.php">Home</a></li>
            <li><a href="komentar.php">Komentar</a></li>
            <li><a href="masukan-form.php">Masukan</a></li>
            <li><a href="lp.php">Back</a></li>
        </ul>
    </nav>
    <section class="user-comments">
        <h2>Daftar Komentar</h2>
        <?php
        while ($data = mysqli_fetch_assoc($result)) {
        ?>
        <div class="comment-box">
            <div class="comment-header">
                <h3><?php echo $data['username']; ?></h3>
                <p><strong>Sumber Daya Alam:</strong> <?php echo $data['jenis_sda']; ?></p>
            </div>
            <div class="comment-body">
                <p><?php echo $data['isi_komentar']; ?></p>
            </div>
        </div>
        <?php } ?>
    </section>
</body>
</html>
