<?php
include '../koneksi.php';

$id_masukan = $_GET['id']; // Ambil id user dari parameter URL

// Hapus data user dari database
$hapus = mysqli_query($mysqli, "DELETE FROM masukan WHERE id_masukan = '$id_masukan'") or die(mysqli_error($mysqli));

if($hapus) {
    // Redirect kembali ke halaman user.php setelah berhasil menghapus
    header("Location: tabelmasukan.php");
    exit();
} else {
    echo "Gagal menghapus user.";
}
?>