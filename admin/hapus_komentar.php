<?php
include '../koneksi.php';

$id_comment = $_GET['id']; // Ambil id user dari parameter URL

// Hapus data user dari database
$hapus = mysqli_query($mysqli, "DELETE FROM komentar WHERE id_comment = '$id_comment'") or die(mysqli_error($mysqli));

if($hapus) {
    // Redirect kembali ke halaman user.php setelah berhasil menghapus
    header("Location: tabelkomentar.php");
    exit();
} else {
    echo "Gagal menghapus user.";
}
?>