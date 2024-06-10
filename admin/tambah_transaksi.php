<?php
include '../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $id_produk = $_POST['id_produk'];
    $jumlah = $_POST['jumlah'];

    // Ambil data produk dari database
    $result = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $produk = mysqli_fetch_assoc($result);
    
    if ($produk) {
        $stok = $produk['stok'];
        
        if ($jumlah > $stok) {
            echo "<div class='alert alert-danger'>Jumlah yang diminta melebihi stok yang tersedia.</div>";
        } else {
            $stok_baru = $stok - $jumlah;
            $harga = $produk['harga'];
            $total_harga = $harga * $jumlah;

            // Update stok produk di database
            $update_stok = mysqli_query($mysqli, "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$id_produk'");

            if ($update_stok) {
                // Insert transaksi ke tabel transaksi
                $insert_transaksi = mysqli_query($mysqli, "INSERT INTO transaksi (username, id_produk, jumlah, total_harga) VALUES ('$username', '$id_produk', '$jumlah', '$total_harga')");

                if ($insert_transaksi) {
                    header("Location: tabeltransaksi.php");
                } else {
                    echo "<div class='alert alert-danger'>Terjadi kesalahan saat memproses transaksi.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengupdate stok.</div>";
            }
        }
    } else {
        echo "<div class='alert alert-danger'>Produk tidak ditemukan.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="tambah.css">
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
        <h1 class="heading">Tambah Transaksi</h1>
        <br>
        <form method="post" action="tambah_transaksi.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="id_produk">Produk:</label>
            <select id="id_produk" name="id_produk" required>
                <?php
                $query_produk = mysqli_query($mysqli, "SELECT * FROM produk");
                while ($produk = mysqli_fetch_array($query_produk)) {
                    echo "<option value='".$produk['id_produk']."'>".$produk['nama_produk']."</option>";
                }
                ?>
            </select>
            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" required>
            <button type="submit" class="btn">Tambah</button>
        </form>
        <br><br>
    </section>
    <script src="main.js"></script>
</body>
</html>
