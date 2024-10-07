<?php
include_once(__DIR__ . '/../../controllers/GudangController.php'); // Mengimpor controller Gudang

$controller = new GudangController(); // Membuat objek GudangController

// Cek apakah metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $name = $_POST['name'];
    $location = $_POST['location'];
    $capacity = $_POST['capacity'];
    $opening_hour = $_POST['opening_hour'];
    $closing_hour = $_POST['closing_hour'];

    // Memanggil metode tambahGudang untuk menyimpan data
    $controller->tambahGudang($name, $location, $capacity, $opening_hour, $closing_hour);
    header('Location: DaftarGudang.php'); // Mengarahkan ke halaman daftar gudang setelah berhasil menambah
    exit; // Menghentikan eksekusi skrip
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css"> <!-- Mengimpor file CSS khusus -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- Mengimpor Bootstrap CSS -->
    <title>Tambah Gudang</title> <!-- Judul halaman -->
</head>
<body>
    <header>
        <div class="container"> <!-- Container utama -->
            <h1>Tambah Gudang</h1> <!-- Judul form tambah gudang -->
        </div>
    </header>
    <main>
        <div class="container"> <!-- Container untuk form -->
            <form method="POST"> <!-- Form untuk menambah gudang -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Gudang</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Masukkan Nama Gudang"> <!-- Input untuk nama gudang -->
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi Gudang</label>
                    <input type="text" class="form-control" id="location" name="location" required placeholder="Masukkan Lokasi Gudang"> <!-- Input untuk lokasi gudang -->
                </div>
                <div class="mb-3">
                    <label for="capacity" class="form-label">Kapasitas Gudang</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" required placeholder="Masukkan Jumlah Kapasitas Gudang"> <!-- Input untuk kapasitas gudang -->
                </div>
                <div class="mb-3">
                    <label for="opening_hour" class="form-label">Waktu Buka</label>
                    <input type="time" class="form-control" id="opening_hour" name="opening_hour" required> <!-- Input untuk waktu buka -->
                </div>
                <div class="mb-3">
                    <label for="closing_hour" class="form-label">Waktu Tutup</label>
                    <input type="time" class="form-control" id="closing_hour" name="closing_hour" required> <!-- Input untuk waktu tutup -->
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button> <!-- Tombol untuk menyimpan data -->
                <a href="DaftarGudang.php" class="btn btn-secondary">Kembali</a> <!-- Tombol untuk kembali ke halaman daftar gudang -->
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> <!-- Mengimpor Bootstrap JS -->
</body>
</html>
