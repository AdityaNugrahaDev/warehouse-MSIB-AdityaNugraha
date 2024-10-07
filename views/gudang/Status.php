<?php
include_once(__DIR__ . '/../../controllers/GudangController.php'); // Mengimpor controller Gudang

$controller = new GudangController(); // Membuat objek GudangController

// Mengambil ID dan status dari query string
$id = $_GET['id'] ?? null;
$status = $_GET['status'] ?? null;

if ($id && $status) {
    // Mengubah status gudang menggunakan metode dari controller
    $result = $controller->ubahStatusGudang($id, $status); // Pastikan metode ini ada dalam GudangController

    // Menentukan pesan berdasarkan hasil operasi
    if ($result) {
        header('Location: DaftarGudang.php?status=success'); // Redirect ke daftar gudang dengan status sukses
    } else {
        header('Location: DaftarGudang.php?status=error'); // Redirect dengan pesan error
    }
    exit;
} else {
    header('Location: DaftarGudang.php'); // Jika tidak ada ID atau status, kembali ke daftar gudang
    exit;
}
?>
