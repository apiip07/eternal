<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman data Produk</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="styleadmin1.css">
</head>
<body>
    <header>
    <a href="../index.php" class="btn">Log Out</a>
            <img src="img/logo1.png" alt="">
        </a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <ul class="navbar">
            <li><a href="user.php">User</a></li>
            <li><a href="tabelkomentar.php">Komentar</a></li>
            <li><a href="tabelmasukan.php">Masukan</a></li>
            <li><a href="tabelkategori.php">Kategori</a></li>
            <li><a href="tabelproduk.php">produk</a></li>
            <li><a href="produk.php">transaksi</a></li>
        </ul>
        </div>
    </header>
    <section class="user">
    <h1 class="heading">Data Produk</h1>
    <br>
        <a href="tambah_produk.php" class="btn">Tambah produk</a>
        <br>
        <br>
        <table border="1" class="table">
            <tr>
                <th>Nomer</th>
                <th>nama produk</th>
                <th>foto</th>
                <th>harga</th>
                <th>stok</th>
                <th>deskripsi</th>
                <th>aksi</th>   
                <th>aksi</th>
            </tr>
            <?php
            include '../koneksi.php';
            $query_mysql = mysqli_query($mysqli, "SELECT * FROM produk") or die(mysqli_error($mysqli));
            $nomor = 1;
            while($data = mysqli_fetch_array($query_mysql)) { 
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['nama_produk']; ?></td>
                <td class="image-col"><img src="foto_img/<?php echo $data["foto"]; ?>" alt="foto" width="100"></td>
                <td><?php echo $data['harga']; ?></td>
                <td><?php echo $data['stok']; ?></td>
                <td><?php echo $data['deskripsi']; ?></td>
                <td><a href="hapus_produk.php?id=<?php echo $data['id_produk']; ?>" class="btn-hapus">Hapus</a> <!-- Tombol hapus --></td>
                <td><a href="update_produk.php?id=<?php echo $data['id_produk']; ?>" class="btn-update">Update</a> <!-- Tombol update --></td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <br>
    </section>
    

    <script src="main.js"></script>
</body>
</html>
