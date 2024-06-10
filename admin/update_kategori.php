<?php
// Include file koneksi, untuk menghubungkan ke database
include "../koneksi.php";

// Fungsi untuk mencegah inputan karakter yang tidak sesuai
function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Cek apakah ada kiriman form dari method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $jenis_sda = input($_POST["jenis_sda"]);
    $Gambar = $_FILES['gambar']['name'];
    $Gambar_tmp_nama = $_FILES['gambar']['tmp_name'];
    $Gambar_folder = 'uploaded_img/' . $Gambar;
    $teks = input($_POST["teks"]);
    $id_kategori_sda = input($_POST["id_kategori_sda"]);

    // Validasi file gambar
    $allowed_extensions = array('png', 'jpeg', 'jpg');
    $file_extension = strtolower(pathinfo($Gambar, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<div class='alert alert-danger'>Hanya file gambar PNG, JPEG, atau JPG yang diperbolehkan.</div>";
    } else {
        // Pindahkan file gambar yang diunggah ke folder tujuan
        move_uploaded_file($Gambar_tmp_nama, $Gambar_folder);

        //Query update data pada tabel kategori_sda
        $sql = "UPDATE kategori_sda SET
        jenis_sda='$jenis_sda',
        gambar='$Gambar',
        teks='$teks'
        WHERE id_kategori_sda='$id_kategori_sda'";
    
        //Mengeksekusi atau menjalankan query diatas
        $hasil = mysqli_query($mysqli, $sql);
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location: tabelkategori.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
}

// Mendapatkan id_kategori_sda dari parameter URL (jika disediakan)
$id_kategori_sda = isset($_GET['id']) ? input($_GET['id']) : 0;

// Query untuk mendapatkan data kategori_sda berdasarkan id_kategori_sda
$query_pantai = "SELECT * FROM kategori_sda WHERE id_kategori_sda = $id_kategori_sda";

// Eksekusi query
$result = mysqli_query($mysqli, $query_pantai);

// Periksa apakah data ditemukan
if(mysqli_num_rows($result) > 0) {
    // Ambil data dari hasil query
    $data = mysqli_fetch_assoc($result);
} else {
    // Tampilkan pesan jika data tidak ditemukan
    echo "Data kategori tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="styleuptade.css">
</head>
<body>
<div class="container">
    <header>
        <h1 class="title">Update kategori</h1>
    </header>
    <section class="form">
        <form method="POST" action="update_kategori.php" enctype="multipart/form-data">
            <input type="hidden" name="id_kategori_sda" value="<?php echo $data['id_kategori_sda']; ?>">

            <input type="text" id="jenis_sda" name="jenis_sda" placeholder="jenis_sda" value="<?php echo $data['jenis_sda']; ?>"><br>

            <input type="file" id="gambar" name="gambar" placeholder="gambar"><br><br>

            <input type="text" id="teks" name="teks" placeholder="teks" value="<?php echo $data['teks']; ?>">
            <input type="submit" name="update" value="Update" class="button">
        </form>
    </section>
</div>
</body>
</html>
