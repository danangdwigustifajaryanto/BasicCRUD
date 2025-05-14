<?php include '../config/koneksi.php';

// Tambah barang
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar = '';

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/" . $gambar);
    }

    mysqli_query($koneksi, "INSERT INTO barang (nama, harga, stok, gambar) VALUES ('$nama', '$harga', '$stok', '$gambar')");
}

// Tambah stok
if (isset($_POST['tambah_stok_btn'])) {
    $id = $_POST['id'];
    $tambah_stok = $_POST['tambah_stok'];
    mysqli_query($koneksi, "UPDATE barang SET stok = stok + $tambah_stok WHERE id = $id");
}

// Hapus barang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // Ambil nama gambar dari database
    $cek = mysqli_query($koneksi, "SELECT gambar FROM barang WHERE id = $id");
    $data = mysqli_fetch_assoc($cek);
    $nama_gambar = $data['gambar'];

    // Hapus file gambar jika ada
    if ($nama_gambar && file_exists("../assets/img/" . $nama_gambar)) {
        unlink("../assets/img/" . $nama_gambar);
    }

    // Hapus data dari database
    $hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE id = $id");
    echo $hapus ? "<script>alert('Berhasil dihapus'); location.href='gudang.php';</script>" :
                  "<script>alert('Gagal menghapus');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Gudang - Kelola Barang</title>
</head>
<body>

<!-- Layout utama -->
<div style="display: flex; gap: 30px; align-items: flex-start; justify-content: center; padding: 20px; flex-wrap: wrap;">

    <!-- Form Tambah Barang -->
    <div class="card" style="flex: 0 0 280px;">
        <h2>📦 Tambah Barang Baru</h2>
        <form method="POST" enctype="multipart/form-data">
            <label>Nama:</label><br>
            <input type="text" name="nama" required><br>
            <label>Harga:</label><br>
            <input type="number" name="harga" required><br>
            <label>Stok:</label><br>
            <input type="number" name="stok" required><br>
            <label>Gambar:</label><br>
            <input type="file" name="gambar"><br><br>
            <button type="submit" name="tambah" class="btn-tambah">➕ Tambah Barang</button>
        </form>
    </div>

    <!-- Daftar Barang -->
    <div class="card" style="flex: 1; min-width: 400px;">
        <h2>📃 Daftar Barang</h2>
        <table>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
            <?php
            $result = mysqli_query($koneksi, "SELECT * FROM barang");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>";
                if ($row['gambar']) {
                    echo "<img src='../assets/img/{$row['gambar']}' width='60'>";
                } else {
                    echo "<span style='color:#999;'>Tidak ada</span>";
                }
                echo "</td>
                    <td>{$row['nama']}</td>
                    <td>Rp" . number_format($row['harga'], 0, ',', '.') . "</td>
                    <td>{$row['stok']}</td>
                    <td>
                        <a href='../backend/edit_barang.php?id={$row['id']}' class='btn-edit'>✏️ Edit</a>
                        <a href='?hapus={$row['id']}' class='btn-hapus' onclick='return confirm(\"Yakin hapus?\")'>🗑️ Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>
