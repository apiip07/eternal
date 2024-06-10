<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit;
}

// Include file koneksi untuk menghubungkan ke database
include '../koneksi.php';

// Dapatkan username dari session
$username = $_SESSION['username'];

// Query untuk mendapatkan data user berdasarkan username dari session
$query_user = "SELECT username, email FROM user WHERE username = '$username'";
$result_user = mysqli_query($mysqli, $query_user);
$data_user = mysqli_fetch_assoc($result_user);

// Periksa apakah ada kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_kategori_sda = $_POST['id_kategori_sda'];
    $email = $data_user['email'];
    $isi_komentar = $_POST['isi_komentar'];

    // Query untuk menyimpan komentar ke database
    $query = "INSERT INTO komentar (id_kategori_sda,username, email, isi_komentar) VALUES ('$id_kategori_sda', '$username', '$email', '$isi_komentar')";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        header("Location: komentar.php"); // Redirect kembali ke halaman data user
        exit();
    } else {
        echo "Komentar gagal ditambahkan.";
    }
}

// Dapatkan id_kategori_sda dari parameter URL (jika disediakan)
$id_kategori_sda = isset($_GET['id']) ? $_GET['id'] : 0;

// Query untuk mendapatkan data kategori_sda berdasarkan id_kategori_sda
$query_kategori_sda = "SELECT * FROM kategori_sda WHERE id_kategori_sda = $id_kategori_sda";
$result_kategori_sda = mysqli_query($mysqli, $query_kategori_sda);

// Ambil data kategori_sda
$data_kategori_sda = mysqli_fetch_assoc($result_kategori_sda);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Form</title>
    <link rel="stylesheet" href="comment-form1.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">
           <h1>KOMENTAR</h1>
        </div>
        <ul class="nav-links">
            <li><a href="artikel.php">Home</a></li>
            <li><a href="komentar.php">Comment</a></li>
            <li><a href="masukan-form.php">Masukan</a></li>
            <li><a href="../index.php">Log Out</a></li>
        </ul>
    </nav>
    <section class="comment-form">
        <h2>Tambah Komentar untuk <?php echo $data_kategori_sda['jenis_sda']; ?></h2>
        <form method="POST" action="comment-form.php">
            <input type="hidden" name="id_kategori_sda" value="<?php echo $id_kategori_sda; ?>">
            <label for="username">Username:</label><br>
            <input type="text" name="username" value="<?php echo $data_user['username']; ?>" readonly><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" value="<?php echo $data_user['email']; ?>" readonly><br>
            <label for="isi_komentar">Komentar:</label><br>
            <textarea id="isi_komentar" name="isi_komentar" rows="4" cols="50"></textarea><br>
            <input type="submit" value="Submit" class="btn-submit">
        </form>
    </section>
</body>
</html>
