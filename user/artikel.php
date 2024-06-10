<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php");
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
    <title>User Comments</title>
    <link rel="stylesheet" href="artikel.css">
</head>
<body>
<nav class="navbar">
        <div class="logo">
           <h1>KOMENTAR</h1>
        </div>
        <ul class="nav-links">
            <li><a href="artikel.php">Home</a></li>
            <li><a href="komentar.php">Comment</a></li>
            <li><a href="masukan-form.php">masukan</a></li>
            <li><a href="lp.php">Back</a></li>
        </ul>
    </nav>
    <section class="comments">
        <?php
        include '../koneksi.php';
        $query_mysql = mysqli_query($mysqli, "SELECT * FROM kategori_sda") or die(mysqli_error($mysqli));
        while($data = mysqli_fetch_array($query_mysql)) { 
        ?>
        <div class="comment">
            <h1><?php echo $data['jenis_sda']; ?></h1>
            <img src="../admin/uploaded_img/<?php echo $data["gambar"]; ?>" alt="Gambar" width="200">
            <p><?php echo $data['teks']; ?></p>
            <a href="comment-form.php?id= <?php echo $data['id_kategori_sda']; ?>" class="btn">Tambah komentar</a>
        </div>  
        <?php } ?>
    </section>
</body>
</html>
