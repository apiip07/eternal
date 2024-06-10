<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Transaksi Admin</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="styleadmin1.css">
</head>
<body>
    <header>
        <a href="../logout.php" class="btn">Log Out</a>
        <img src="img/logo1.png" alt="">
        <ul class="navbar">
            <li><a href="user.php">User</a></li>
            <li><a href="tabelkomentar.php">Komentar</a></li>
            <li><a href="tabelmasukan.php">Masukan</a></li>
            <li><a href="tabelkategori.php">Kategori</a></li>
            <li><a href="tabelproduk.php">Produk</a></li>
            <li><a href="tabeltransaksi.php">Transaksi</a></li>
        </ul>
    </header>
    <section class="admin">
        <h1 class="heading">Data Transaksi</h1>
        <br>
        <a href="tambah_transaksi.php" class="btn">Tambah Transaksi</a>
        <br><br>
        <table border="1" class="table">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
            <?php
            include '../koneksi.php';
            $query_mysql = mysqli_query($mysqli, "SELECT transaksi.*, produk.nama_produk FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk") or die(mysqli_error($mysqli));
            $nomor = 1;
            while ($data = mysqli_fetch_array($query_mysql)) {
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['nama_produk']; ?></td>
                <td><?php echo $data['jumlah']; ?></td>
                <td><?php echo $data['total_harga']; ?></td>
                <td><?php echo $data['tanggal']; ?></td>
                <td><a href="hapus_transaksi.php?id=<?php echo $data['id_transaksi']; ?>" class="btn-hapus">Hapus</a></td>
            </tr>
            <?php } ?>
        </table>
        <br><br>
    </section>
    <script src="main.js"></script>
</body>
</html>
