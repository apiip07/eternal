<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman data USER</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="styleadmin1.css">
</head>
<body>
    <header>
        <a href="#" class="logo">
            <img src="img/logo1.png" alt="">
        </a>
        <i class='bx bx-menu' id="menu-icon"></i>
        <ul class="navbar">
            <li><a href="user.php">User</a></li>
            <li><a href="tabelkomentar.php">Komentar</a></li>
            <li><a href="tabelmasukan.php">Masukan</a></li>
            <li><a href="tabelkategori.php">Kategori</a></li>
            <li><a href="tabelproduk.php">produk</a></li>
            <li><a href="tabeltransaksi.php">transaksi</a></li>
        </ul>
        </div>
    </header>
    <section class="user">
    <h1 class="heading">Data Masukan</h1>
    <br>
        <a href="tambah_kategori.php" class="btn">Tambah Kategori</a>
        <br>
        <br>
        <table border="1" class="table">
            <tr>
                <th>Nomer</th>
                <th>id_kategori_sda</th>
                <th>jenis_sda</th>
                <th>gambar</th>
                <th>teks</th>
                <th>aksi</th>
                <th>aksi</th>
            </tr>
            <?php
            include '../koneksi.php';
            $query_mysql = mysqli_query($mysqli, "SELECT * FROM kategori_sda") or die(mysqli_error($mysqli));
            $nomor = 1;
            while($data = mysqli_fetch_array($query_mysql)) { 
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['id_kategori_sda']; ?></td>
                <td><?php echo $data['jenis_sda']; ?></td>
                <td class="image-col"><img src="uploaded_img/<?php echo $data["gambar"]; ?>" alt="Gambar" width="100"></td>
                <td><?php echo $data['teks']; ?></td>
                <td><a href="hapus_kategori.php?id=<?php echo $data['id_kategori_sda']; ?>" class="btn-hapus">Hapus</a> <!-- Tombol hapus --></td>
                <td><a href="update_kategori.php?id=<?php echo $data['id_kategori_sda']; ?>" class="btn-update">Update</a> <!-- Tombol update --></td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <br>
    <a href="../index.php" class="btn">Log Out</a>
    </section>
    

    <script src="main.js"></script>
</body>
</html>
