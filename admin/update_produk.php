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

    $nama_produk = input($_POST["nama_produk"]);
    $Foto = $_FILES['foto']['name'];
    $Foto_tmp_nama = $_FILES['foto']['tmp_name'];
    $Foto_folder = 'foto_img/' . $Foto;
    $harga = input($_POST["harga"]);
    $stok = input($_POST["stok"]);
    $deskripsi = input($_POST["deskripsi"]);
    $id_produk = input($_POST["id_produk"]);

    // Validasi file gambar
    $allowed_extensions = array('png', 'jpeg', 'jpg');
    $file_extension = strtolower(pathinfo($Foto, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<div class='alert alert-danger'>Hanya file gambar PNG, JPEG, atau JPG yang diperbolehkan.</div>";
    } else {
        // Pindahkan file gambar yang diunggah ke folder tujuan
        move_uploaded_file($Foto_tmp_nama, $Foto_folder);

        //Query update data pada tabel produk
        $sql = "UPDATE produk SET
        nama_produk='$nama_produk',
        foto='$Foto',
        harga='$harga',
        stok='$stok',
        deskripsi='$deskripsi'
        WHERE id_produk='$id_produk'";
    
        //Mengeksekusi atau menjalankan query diatas
        $hasil = mysqli_query($mysqli, $sql);
        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location: tabelproduk.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
}

// Mendapatkan id_produk dari parameter URL (jika disediakan)
$id_produk = isset($_GET['id']) ? input($_GET['id']) : 0;

// Query untuk mendapatkan data produk berdasarkan id_produk
$query_produk = "SELECT * FROM produk WHERE id_produk = $id_produk";

// Eksekusi query
$result = mysqli_query($mysqli, $query_produk);

// Periksa apakah data ditemukan
if(mysqli_num_rows($result) > 0) {
    // Ambil data dari hasil query
    $data = mysqli_fetch_assoc($result);
} else {
    // Tampilkan pesan jika data tidak ditemukan
    echo "Data produk tidak ditemukan.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <link rel="icon" type="image/png" href="img/logotitle.png">
    <link rel="stylesheet" href="styleupdate.css">
</head>
<body>
<div class="container">
    <header>
        <h1 class="title">Update Produk</h1>
    </header>
    <section class="form">
        <form method="POST" action="update_produk.php" enctype="multipart/form-data">
            <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>">

            <input type="text" id="nama_produk" name="nama_produk" placeholder="nama produk" value="<?php echo $data['nama_produk']; ?>"><br>

            <input type="file" id="foto" name="foto" placeholder="foto"><br>

            <input type="number" id="harga" name="harga" placeholder="harga" value="<?php echo $data['harga']; ?>"><br>

            <input type="number" id="stok" name="stok" placeholder="stok" value="<?php echo $data['stok']; ?>"><br>

            <input type="text" id="deskripsi" name="deskripsi" placeholder="deskripsi" value="<?php echo $data['deskripsi']; ?>"><br>

            <input type="submit" name="update" value="Update" class="button">
        </form>
    </section>
</div>
</body>
</html>
