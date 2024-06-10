<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

        $jenis_sda = input($_POST["jenis_sda"]);
        
        $Gambar = $_FILES['gambar']['name'];
        $Gambar_tmp_nama = $_FILES['gambar']['tmp_name'];
        $Gambar_folder = 'uploaded_img/' . $Gambar;

        $teks = input($_POST["teks"]);

        // Query untuk menginput data ke dalam tabel ikan
        $sql = "INSERT INTO kategori_sda (jenis_sda, gambar, teks) VALUES ('$jenis_sda', '$Gambar', '$teks')";
        
        if (mysqli_query($mysqli, $sql)) {
            // Jika berhasil memasukkan data, pindahkan gambar ke folder yang ditentukan
            move_uploaded_file($Gambar_tmp_nama, $Gambar_folder);
           
            echo "<div class='alert alert-success'> Data berhasil disimpan.</div>";
            header("Location:tabelkategori.php");
            // Kosongkan nilai input setelah pengiriman sukses
            $_POST['jenis_sda'] = $_POST['teks'] ='';
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    }
    ?>
    <h2>Input Data Kategori</h2><br>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Jenis Sda:</label>
            <input type="text" name="jenis_sda" class="form-control" placeholder="Masukan Jenis sumber daya" required/>
        </div>
        <div class="form-group">
            <label for="gambar">Gambar:</label><br>
            <input type="file" id="gambar" name="gambar" class="input-field" accept="image/png, image/jpeg, image/jpg" required>
        </div>
        <div class="form-group">
            <label>Teks:</label>
            <input type="text" name="teks" class="form-control" placeholder="Masukan teks" required/>
        </div><br>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="tabelkategori.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>