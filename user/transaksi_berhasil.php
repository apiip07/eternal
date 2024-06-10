<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

// Mendapatkan data transaksi terakhir dari tabel transaksi
$username = $_SESSION['username'];
$query = "SELECT transaksi.*, produk.nama_produk FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE username = '$username' ORDER BY id_transaksi DESC LIMIT 1";
$result = mysqli_query($mysqli, $query);
$transaksi = mysqli_fetch_assoc($result);

if (!$transaksi) {
    header("Location: riwayat_pembelian.php");
    exit;
}

$produk = $transaksi['nama_produk'];
$jumlah = $transaksi['jumlah'];
$total_harga = $transaksi['total_harga'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi Berhasil</title>
    <link rel="stylesheet" href="transaksi_berhasil.css">
</head>
<body>
    <header class="navbar">
        <a href="produk.php" class="nav-item">Back</a>
        <a href="riwayat_pembelian.php" class="nav-item">Riwayat Pembelian</a>
    </header>
    <section class="success">
        <h1 class="heading">Transaksi Berhasil</h1>
        <p>Terima kasih telah melakukan pembelian. Detail transaksi Anda:</p>
        <ul>
            <li><strong>Username:</strong> <?php echo $_SESSION['username']; ?></li>
            <li><strong>Produk:</strong> <?php echo $produk; ?></li>
            <li><strong>Jumlah:</strong> <?php echo $jumlah; ?></li>
            <li><strong>Total Harga:</strong> <?php echo $total_harga; ?></li>
        </ul>
    </section>
</body>
</html>
