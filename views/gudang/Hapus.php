<?php
include_once(__DIR__ . '/../../controllers/GudangController.php'); // Mengimpor controller Gudang

$controller = new GudangController(); // Membuat objek GudangController

// Cek apakah metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Mengambil ID gudang dari form
    $controller->hapusGudang($id); // Memanggil metode hapusGudang untuk menghapus data
    header('Location: DaftarGudang.php'); // Mengarahkan kembali ke halaman daftar gudang setelah menghapus
    exit; // Menghentikan eksekusi skrip
}

$gudang_id = $_GET['id']; // Mengambil ID gudang dari query string
$gudangs = $controller->ambilGudang(); // Mengambil daftar gudang
$current_gudang = array_filter($gudangs, fn($gudang) => $gudang['id'] == $gudang_id); // Mencari gudang yang sesuai dengan ID
$current_gudang = reset($current_gudang); // Mengambil elemen pertama dari hasil filter
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css"> <!-- Mengimpor file CSS khusus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- Mengimpor Bootstrap CSS -->
    <title>Hapus Gudang</title> <!-- Judul halaman -->
</head>
<body>
    <div class="container"> <!-- Container utama -->
        <h1>Hapus Gudang</h1> <!-- Judul halaman hapus gudang -->
        <p>Apakah Anda yakin ingin menghapus gudang <strong><?= htmlspecialchars($current_gudang['name']) ?></strong>?</p> <!-- Konfirmasi penghapusan -->
        <form method="POST"> <!-- Form untuk konfirmasi penghapusan -->
            <input type="hidden" name="id" value="<?= $current_gudang['id'] ?>"> <!-- Input tersembunyi untuk ID gudang -->
            <button type="submit" class="btn btn-danger">Hapus</button> <!-- Tombol untuk menghapus gudang -->
            <a href="DaftarGudang.php" class="btn btn-secondary">Kembali</a> <!-- Tombol untuk kembali ke halaman daftar gudang -->
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> <!-- Mengimpor Bootstrap JS -->
</body>
</html>
