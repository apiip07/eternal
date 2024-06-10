<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Produk User</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="produk.css">
</head>
<body>
    <header>
        <a href="../index.php" class="btn">Log Out</a>
        <img src="img/logo1.png" alt="">
        <ul class="navbar">
        <li><a href="artikel.php">Home</a></li>
            <li><a href="komentar.php">Komentar</a></li>
            <li><a href="masukan-form.php">Masukan</a></li>
            <li><a href="lp.php">Back</a></li>
        </ul>
    </header>
    <section class="user">
        <h1 class="heading">Daftar Produk</h1>
        <br>
        <div class="product-grid">
            <?php
            include '../koneksi.php';
            $query_mysql = mysqli_query($mysqli, "SELECT * FROM produk") or die(mysqli_error($mysqli));
            while($data = mysqli_fetch_array($query_mysql)) { 
            ?>
            <div class="card">
                <img src="../admin/foto_img/<?php echo $data["foto"]; ?>" alt="foto" class="card-img">
                <div class="card-content">
                    <h3><?php echo $data['nama_produk']; ?></h3>
                    <p>Harga: <?php echo $data['harga']; ?></p>
                    <p>Stok: <?php echo $data['stok']; ?></p>
                    <p><?php echo $data['deskripsi']; ?></p>
                    <a href="beli_produk.php?id=<?php echo $data['id_produk']; ?>" class="btn-buy">Beli</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <br>
        <br>
    </section>
    <script src="main.js"></script>
</body>
</html>
