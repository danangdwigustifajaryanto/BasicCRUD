<?php include '../config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">
    <h2>📜 Riwayat Transaksi</h2>

    <table>
        <tr>
            <th>ID Transaksi</th>
            <th>Tanggal</th>
            <th>Gambar</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Subtotal</th>
        </tr>
        <?php
        $query = mysqli_query($koneksi, "
            SELECT t.id AS id_transaksi, t.tanggal, b.nama AS nama_barang, b.harga, dt.jumlah, dt.subtotal, b.gambar
            FROM transaksi t
            JOIN detail_transaksi dt ON t.id = dt.id_transaksi
            JOIN barang b ON dt.id_barang = b.id
            ORDER BY t.tanggal DESC, t.id DESC
        ");

        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>
                <td>{$row['id_transaksi']}</td>
                <td>{$row['tanggal']}</td>
                <td>";
                if (!empty($row['gambar'])) {
                    echo "<img src='../assets/img/{$row['gambar']}' width='50'>";
                } else {
                    echo "<span style='color:#999;'>-</span>";
                }
            echo "</td>
                <td>{$row['nama_barang']}</td>
                <td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                <td>{$row['jumlah']}</td>
                <td>Rp" . number_format($row['subtotal'], 0, ',', '.') . "</td>
            </tr>";
        }
        ?>
    </table>

    <div class="nav-buttons" style="margin-top: 30px;">
        <a href="kasir.php" class="btn-kembali">⬅️ Kembali ke Kasir</a>
    </div>
</div>

</body>
</html>
