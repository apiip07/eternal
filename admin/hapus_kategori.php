<?php
include '../koneksi.php';

$id_kategori_sda = $_GET['id']; // Ambil id user dari parameter URL

// Hapus data user dari database
$hapus = mysqli_query($mysqli, "DELETE FROM kategori_sda WHERE id_kategori_sda = '$id_kategori_sda'") or die(mysqli_error($mysqli));

if($hapus) {
    // Redirect kembali ke halaman user.php setelah berhasil menghapus
    header("Location: tabelkategori.php");
    exit();
} else {
    echo "Gagal menghapus user.";
}
?>