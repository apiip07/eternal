<?php
include '../koneksi.php';

$id_produk = $_GET['id']; // Ambil id user dari parameter URL

// Hapus data user dari database
$hapus = mysqli_query($mysqli, "DELETE FROM produk WHERE id_produk = '$id_produk'") or die(mysqli_error($mysqli));

if($hapus) {
    // Redirect kembali ke halaman user.php setelah berhasil menghapus
    header("Location: tabelproduk.php");
    exit();
} else {
    echo "Gagal menghapus user.";
}
?>