<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="comment-form.css">
</head>
<body>
<header class="admin-header"></header>
<br> <br>
<div class="container">
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
        
        $Foto = $_FILES['Foto']['name']; // Use 'Foto' instead of 'foto'
        $Foto_tmp_nama = $_FILES['Foto']['tmp_name']; // Use 'Foto' instead of 'foto'
        $Foto_folder = 'foto_img/' . $Foto;

        $harga = input($_POST["harga"]);
        $stok = input($_POST["stok"]);
        $deskripsi = input($_POST["deskripsi"]);

        // Query untuk menginput data ke dalam tabel produk
        $sql = "INSERT INTO produk (nama_produk, foto, harga, stok, deskripsi) VALUES ('$nama_produk', '$Foto', '$harga', '$stok', '$deskripsi')";
        
        if (mysqli_query($mysqli, $sql)) {
            // Jika berhasil memasukkan data, pindahkan gambar ke folder yang ditentukan
            move_uploaded_file($Foto_tmp_nama, $Foto_folder);
           
            echo "<div class='alert alert-success'> Data berhasil disimpan.</div>";
            header("Location: tabelproduk.php");
            // Kosongkan nilai input setelah pengiriman sukses
            $_POST['nama_produk'] = $_POST['harga'] = $_POST['stok'] = $_POST['deskripsi'] = '';
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data Produk</h2><br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nama Produk:</label>
            <input type="text" name="nama_produk" class="form-control" placeholder="Masukan nama produk" required/>
        </div>
        <div class="form-group">
            <label for="Foto">Foto:</label><br>
            <input type="file" id="Foto" name="Foto" class="input-field" accept="image/png, image/jpeg, image/jpg" required>
        </div>
        <div class="form-group">
            <label>Harga:</label>
            <input type="number" name="harga" class="form-control" placeholder="Masukan harga" required/>
        </div>
        <div class="form-group">
            <label>Stok:</label>
            <input type="number" name="stok" class="form-control" placeholder="Masukan stok" required/>
        </div>
        <div class="form-group">
            <label>Deskripsi:</label>
            <input type="text" name="deskripsi" class="form-control" placeholder="Masukan deskripsi produk" required/>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="tabelproduk.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>
