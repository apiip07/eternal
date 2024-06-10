<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include '../koneksi.php';

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_produk = input($_POST["id_produk"]);
    $jumlah = input($_POST["jumlah"]);

    // Ambil data produk dari database
    $result = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $produk = mysqli_fetch_assoc($result);

    if ($produk) {
        $stok = $produk['stok'];
        
        if ($jumlah > $stok) {
            echo "<div class='alert alert-danger'>Jumlah yang diminta melebihi stok yang tersedia.</div>";
        } else {
            $stok_baru = $stok - $jumlah;

            // Update stok produk di database
            $update_stok = mysqli_query($mysqli, "UPDATE produk SET stok = '$stok_baru' WHERE id_produk = '$id_produk'");

            if ($update_stok) {
                // Insert transaksi ke tabel transaksi
                $username = $_SESSION['username'];
                $harga = $produk['harga'];
                $total_harga = $harga * $jumlah;

                $insert_transaksi = mysqli_query($mysqli, "INSERT INTO transaksi (username, id_produk, jumlah, total_harga) VALUES ('$username', '$id_produk', '$jumlah', '$total_harga')");
                if ($insert_transaksi) {
                    echo "<div class='alert alert-success'>Pembelian berhasil!</div>";
                    echo "<script>window.location = 'transaksi_berhasil.php';</script>";
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
} else {
    $id_produk = input($_GET["id"]);
    $result = mysqli_query($mysqli, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $produk = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembelian</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="beli_produk.css">
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
        <h1 class="heading">Pembelian Produk</h1>
        <br>
        <div class="product-card">
            <?php if ($produk): ?>
                <img src="../admin/foto_img/<?php echo $produk["foto"]; ?>" alt="foto" class="product-img">
                <div class="product-details">
                    <h3><?php echo $produk['nama_produk']; ?></h3>
                    <p>Harga: <?php echo $produk['harga']; ?></p>
                    <p>Stok: <?php echo $produk['stok']; ?></p>
                    <p><?php echo $produk['deskripsi']; ?></p>
                    <form method="post" action="beli_produk.php">
                        <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
                        <label for="jumlah">Jumlah:</label>
                        <input type="number" id="jumlah" name="jumlah" min="1" max="<?php echo $produk['stok']; ?>" required>
                        <button type="submit" class="btn-buy">Beli</button>
                    </form>
                </div>
            <?php else: ?>
                <p>Produk tidak ditemukan.</p>
            <?php endif; ?>
        </div>
        <br>
        <br>
    </section>
    <script src="main.js"></script>
</body>
</html>
