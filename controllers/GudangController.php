<?php
include_once(__DIR__ . '/../models/Gudang.php'); // Mengimpor model Gudang

class GudangController {
    private $gudang; // Variabel untuk menyimpan objek Gudang

    // Konstruktor untuk inisialisasi objek Gudang
    public function __construct() {
        $this->gudang = new Gudang();
    }

    // Fungsi untuk menambahkan gudang baru
    public function tambahGudang($name, $location, $capacity, $opening_hour, $closing_hour) {
        return $this->gudang->create($name, $location, $capacity, $opening_hour, $closing_hour);
    }

    // Fungsi untuk mengambil data semua gudang
    public function ambilGudang() {
        return $this->gudang->read(); // Pastikan ini mengembalikan array
    }

    // Fungsi untuk mengambil gudang berdasarkan ID
    public function getGudangById($id) {
        return $this->gudang->readById($id); // Memanggil metode readById dari model
    }

    // Fungsi untuk memperbarui data gudang berdasarkan ID
    public function updateGudang($id, $name, $location, $capacity, $opening_hour, $closing_hour) {
        return $this->gudang->update($id, $name, $location, $capacity, $opening_hour, $closing_hour);
    }

    // Fungsi untuk menghapus gudang berdasarkan ID
    public function hapusGudang($id) {
        return $this->gudang->delete($id);
    }

    // Fungsi untuk mengubah status gudang
    public function ubahStatusGudang($id, $status) {
        return $this->gudang->updateStatus($id, $status);
    }
}
?>
