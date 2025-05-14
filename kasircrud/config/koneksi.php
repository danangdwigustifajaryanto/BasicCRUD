<?php
$koneksi = mysqli_connect("localhost", "root", "", "kasir_db");
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
}
?>

<!-- -- Buat database (jika belum ada)
CREATE DATABASE IF NOT EXISTS kasir_db;
USE kasir_db;

-- Tabel: barang
CREATE TABLE barang (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    harga INT(11) NOT NULL,
    stok INT(11) NOT NULL,
    PRIMARY KEY (id)
);

-- Tabel: transaksi
CREATE TABLE transaksi (
    id INT(11) NOT NULL AUTO_INCREMENT,
    tanggal DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total INT(11) NOT NULL,
    PRIMARY KEY (id)
);

-- Tabel: detail_transaksi
CREATE TABLE detail_transaksi (
    id INT(11) NOT NULL AUTO_INCREMENT,
    id_transaksi INT(11) NOT NULL,
    id_barang INT(11) NOT NULL,
    jumlah INT(11) NOT NULL,
    subtotal INT(11) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (id_transaksi) REFERENCES transaksi(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_barang) REFERENCES barang(id) ON DELETE CASCADE ON UPDATE CASCADE
); -->
