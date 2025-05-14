<?php
// Menghubungkan ke database
include '../config/koneksi.php';

// Ambil data input dari form (jika ada),
$barang_input = $_POST['barang'] ?? [];

$total = 0;              // Untuk menyimpan total seluruh transaksi
$items = [];             // Untuk menyimpan data item yang dibeli

// Proses setiap barang yang diinput oleh user
foreach ($barang_input as $id_barang => $data) {
    if (isset($data['cek']) && $data['cek'] == '1') {
        $jumlah = intval($data['jumlah']); // Pastikan jumlah dalam bentuk angka bulat

        if ($jumlah > 0) {
            // Ambil data barang dari database
            $barang = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $id_barang"));

            // Hitung subtotal dan total transaksi
            $subtotal = $barang['harga'] * $jumlah;
            $total += $subtotal; //Harga total keseluruhan transaksi

            // Simpan ke array item
            $items[] = [
                'id' => $id_barang,
                'jumlah' => $jumlah,
                'subtotal' => $subtotal
            ];

            // Kurangi stok barang di database
            mysqli_query($koneksi, "UPDATE barang SET stok = stok - $jumlah WHERE id = $id_barang");
        }
    }
}

// Jika total lebih dari 0, maka simpan transaksi
if ($total > 0) {
    // Simpan ke tabel transaksi utama
    mysqli_query($koneksi, "INSERT INTO transaksi (tanggal, total) VALUES (NOW(), $total)");
    $id_transaksi = mysqli_insert_id($koneksi); // Ambil ID transaksi terakhir

    // Simpan detail transaksi per barang
    foreach ($items as $item) {
        mysqli_query($koneksi, "INSERT INTO detail_transaksi (id_transaksi, id_barang, jumlah, subtotal)
            VALUES ($id_transaksi, {$item['id']}, {$item['jumlah']}, {$item['subtotal']})");
    }
}

// Redirect kembali ke halaman kasir
header("Location: ../halaman/kasir.php");
?>