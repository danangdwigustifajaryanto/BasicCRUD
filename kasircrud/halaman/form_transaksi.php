<?php include '../config/koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Form Transaksi</title>
</head>
<body>
    <form method="POST" action="../backend/simpan_transaksi.php">
        <table>
                <h2>🛒 Form Pembelian</h2>
            <tr>
                <th>Pilih</th>
                <th>Gambar</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Jumlah</th>
            </tr>
            <?php
            // Ambil semua barang yang stok-nya masih ada
            $barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE stok > 0");
            while ($b = mysqli_fetch_assoc($barang)) {
                echo "<tr>
                    <td><input type='checkbox' name='barang[{$b['id']}][cek]' value='1'></td>
                    <td>";
                if (!empty($b['gambar'])) {
                    echo "<img src='../assets/img/{$b['gambar']}' width='60'>";
                } else {
                    echo "<span style='color: #888;'>Tidak ada gambar</span>";
                }
                echo "</td>
                    <td>{$b['nama']}</td>
                    <td>Rp" . number_format($b['harga'], 0, ',', '.') . "</td>
                    <td>{$b['stok']}</td>
                    <td><input type='number' name='barang[{$b['id']}][jumlah]' value='0' min='0' max='{$b['stok']}'></td>
                </tr>";
            }
            ?>
        </table>
        <div style="margin-top: 15px;">
            <button type="submit">🧾 Checkout</button>
            <a href="kasir.php"><button type="button" style="background-color: #6c757d;">⬅️ Kembali</button></a>
        </div>
    </form>
</body>
</html>
