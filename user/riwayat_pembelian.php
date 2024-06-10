<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

// Mendapatkan data transaksi dari tabel transaksi
$username = $_SESSION['username'];
$query = "SELECT transaksi.*, produk.nama_produk FROM transaksi JOIN produk ON transaksi.id_produk = produk.id_produk WHERE username = '$username' ORDER BY id_transaksi DESC";
$result = mysqli_query($mysqli, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link rel="stylesheet" href="riwayat_pembelian.css">
</head>
<body>
    <header class="navbar">
        <a href="produk.php" class="nav-item">Kembali ke Produk</a>
        <a href="transaksi_berhasil.php" class="nav-item">Transaksi Berhasil</a>
    </header>
    <section class="history">
        <h1 class="heading">Riwayat Pembelian</h1>
        <div class="transactions">
            <?php while ($transaksi = mysqli_fetch_assoc($result)): ?>
                <div class="transaction">
                    <ul>
                        <li><strong>Produk:</strong> <?php echo $transaksi['nama_produk']; ?></li>
                        <li><strong>Jumlah:</strong> <?php echo $transaksi['jumlah']; ?></li>
                        <li><strong>Total Harga:</strong> <?php echo $transaksi['total_harga']; ?></li>
                        <li><strong>Tanggal:</strong> <?php echo $transaksi['tanggal']; ?></li>
                    </ul>
                </div>
            <?php endwhile; ?>
        </div>
    </section>
</body>
</html>
