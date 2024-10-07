<?php
include_once(__DIR__ . '/../../controllers/GudangController.php'); // Mengimpor controller Gudang

$controller = new GudangController(); // Membuat objek GudangController

// Cek apakah metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Mengambil ID gudang dari form
    $name = $_POST['name']; // Mengambil nama gudang dari form
    $location = $_POST['location']; // Mengambil lokasi gudang dari form
    $capacity = $_POST['capacity']; // Mengambil kapasitas gudang dari form
    $opening_hour = $_POST['opening_hour']; // Mengambil waktu buka dari form
    $closing_hour = $_POST['closing_hour']; // Mengambil waktu tutup dari form

    // Memanggil metode updateGudang untuk memperbarui data gudang
    $controller->updateGudang($id, $name, $location, $capacity, $opening_hour, $closing_hour);
    header('Location: ../../index.php'); // Mengarahkan kembali ke halaman daftar gudang setelah mengupdate
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
    <title>Edit Gudang</title> <!-- Judul halaman -->
</head>
<body>
    <header>
        <div class="container"> <!-- Container utama -->
            <h1>Edit Gudang</h1> <!-- Judul halaman edit gudang -->
        </div>
    </header>
    <main>
        <div class="container"> <!-- Container untuk form -->
            <form method="POST"> <!-- Form untuk mengedit gudang -->
                <input type="hidden" name="id" value="<?= $current_gudang['id'] ?>"> <!-- Input tersembunyi untuk ID gudang -->
                <div class="mb-3"> <!-- Div untuk nama gudang -->
                    <label for="name" class="form-label">Nama Gudang</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($current_gudang['name']) ?>" required> <!-- Input untuk nama gudang -->
                </div>
                <div class="mb-3"> <!-- Div untuk lokasi gudang -->
                    <label for="location" class="form-label">Lokasi Gudang</label>
                    <input type="text" class="form-control" id="location" name="location" value="<?= htmlspecialchars($current_gudang['location']) ?>" required> <!-- Input untuk lokasi gudang -->
                </div>
                <div class="mb-3"> <!-- Div untuk kapasitas gudang -->
                    <label for="capacity" class="form-label">Kapasitas Gudang</label>
                    <input type="number" class="form-control" id="capacity" name="capacity" value="<?= htmlspecialchars($current_gudang['capacity']) ?>" required> <!-- Input untuk kapasitas gudang -->
                </div>
                <div class="mb-3"> <!-- Div untuk waktu buka -->
                    <label for="opening_hour" class="form-label">Waktu Buka</label>
                    <input type="time" class="form-control" id="opening_hour" name="opening_hour" value="<?= $current_gudang['opening_hour'] ?>" required> <!-- Input untuk waktu buka -->
                </div>
                <div class="mb-3"> <!-- Div untuk waktu tutup -->
                    <label for="closing_hour" class="form-label">Waktu Tutup</label>
                    <input type="time" class="form-control" id="closing_hour" name="closing_hour" value="<?= $current_gudang['closing_hour'] ?>" required> <!-- Input untuk waktu tutup -->
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button> <!-- Tombol untuk menyimpan perubahan -->
                <a href="../../index.php" class="btn btn-secondary">Kembali</a> <!-- Tombol untuk kembali ke halaman daftar gudang -->
            </form>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> <!-- Mengimpor Bootstrap JS -->
</body>
</html>
