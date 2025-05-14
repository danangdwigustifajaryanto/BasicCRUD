<!-- Koneksi Database -->
<?php include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM barang WHERE id = $id"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $gambar_lama = $data['gambar']; // simpan nama gambar lama
    $gambar_baru = $gambar_lama;

    // Cek jika ada file gambar baru diupload
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar_baru = basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../assets/img/" . $gambar_baru);
    }

    // Update data ke database
    mysqli_query($koneksi, "UPDATE barang 
        SET nama='$nama', harga='$harga', stok='$stok', gambar='$gambar_baru' 
        WHERE id=$id");

    header("Location: ../halaman/gudang.php");
}
?>

<!-- Halaman HTML -->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
    <title>Edit Barang</title>
</head>
<body>
    <h2>Edit Barang</h2>
    <form method="POST" enctype="multipart/form-data">
        Nama: <input type="text" name="nama" value="<?= $data['nama'] ?>" required><br>
        Harga: <input type="number" name="harga" value="<?= $data['harga'] ?>" required><br>
        Stok: <input type="number" name="stok" value="<?= $data['stok'] ?>" required><br>

        <!-- Tampilkan gambar lama -->
        <?php if (!empty($data['gambar'])): ?>
            Gambar Saat Ini:<br>
            <img src="../assets/img/<?= $data['gambar'] ?>" width="100"><br>
        <?php endif; ?>

        Ganti Gambar (opsional): <input type="file" name="gambar"><br>
        <button type="submit" name="update">Simpan Perubahan</button>
    </form>
    <br><a href="gudang.php">⬅️ Kembali</a>
</body>
</html>
