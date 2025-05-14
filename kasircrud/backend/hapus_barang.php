<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// Ambil data gambar dulu dari database
$query = mysqli_query($conn, "SELECT gambar FROM barang WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);
$nama_gambar = $data['gambar'];

$lokasi_gambar = "../assets/img/" . $nama_gambar;

// Hapus gambar dari folder jika ada
if (file_exists($lokasi_gambar)) {
    unlink($lokasi_gambar);
}

// Hapus data dari database
mysqli_query($conn, "DELETE FROM barang WHERE id = '$id'");

// Redirect balik ke gudang atau halaman utama
header("Location: ../halaman/gudang.php?pesan=hapus-berhasil");
exit;
?>
