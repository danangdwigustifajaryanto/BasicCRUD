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

<!-- contoh data dummy
-- Insert ke tabel barang
INSERT INTO barang (id, nama, harga, stok) VALUES
(1, 'Pensil 2B', 2000, 100),
(2, 'Buku Tulis', 5000, 50),
(3, 'Penghapus', 1500, 75),
(4, 'Penggaris 30cm', 4000, 40),
(5, 'Bolpoin Biru', 2500, 60);

-- Insert ke tabel transaksi
INSERT INTO transaksi (id, tanggal, total) VALUES
(1, '2025-05-14 08:30:00', 9500),
(2, '2025-05-14 10:15:00', 13500),
(3, '2025-05-14 14:45:00', 6500);

-- Insert ke tabel detail_transaksi
INSERT INTO detail_transaksi (id, id_transaksi, id_barang, jumlah, subtotal) VALUES
(1, 1, 1, 2, 4000),       -- 2x Pensil = 4000
(2, 1, 3, 1, 1500),       -- 1x Penghapus = 1500
(3, 1, 5, 1, 2500),       -- 1x Bolpoin = 2500

(4, 2, 2, 2, 10000),      -- 2x Buku = 10000
(5, 2, 3, 1, 1500),       -- 1x Penghapus = 1500
(6, 2, 1, 1, 2000),       -- 1x Pensil = 2000

(7, 3, 4, 1, 4000),       -- 1x Penggaris = 4000
(8, 3, 5, 1, 2500);       -- 1x Bolpoin = 2500 -->
