<?php
include_once(__DIR__ . '/../config/Database.php'); // Mengimpor file Database

class Gudang {
    private $conn; // Variabel untuk menyimpan koneksi database

    // Konstruktor untuk inisialisasi koneksi database
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection(); // Mendapatkan koneksi database
    }

    // Fungsi untuk mengambil semua data gudang
    public function read() {
        $query = "SELECT * FROM gudang"; // Query untuk mengambil semua data gudang
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan hasil sebagai array asosiatif
    }

    // Fungsi untuk mengambil data gudang berdasarkan ID
    public function readById($id) {
        $query = "SELECT * FROM gudang WHERE id = ?"; // Query untuk mengambil data gudang berdasarkan ID
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC); // Mengembalikan hasil sebagai array asosiatif
    }

    // Fungsi untuk menambahkan gudang baru
    public function create($name, $location, $capacity, $opening_hour, $closing_hour) {
        $query = "INSERT INTO gudang (name, location, capacity, opening_hour, closing_hour) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$name, $location, $capacity, $opening_hour, $closing_hour]); // Menjalankan query
    }

    // Fungsi untuk memperbarui data gudang berdasarkan ID
    public function update($id, $name, $location, $capacity, $opening_hour, $closing_hour) {
        $query = "UPDATE gudang SET name = ?, location = ?, capacity = ?, opening_hour = ?, closing_hour = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$name, $location, $capacity, $opening_hour, $closing_hour, $id]); // Menjalankan query
    }

    // Fungsi untuk menghapus gudang berdasarkan ID
    public function delete($id) {
        $query = "DELETE FROM gudang WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id]); // Menjalankan query
    }

    // Fungsi untuk mengubah status gudang
    public function updateStatus($id, $status) {
        $query = "UPDATE gudang SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$status, $id]); // Menjalankan query
    }
}
?>
