<?php
include_once(__DIR__ . '/controllers/GudangController.php'); // Mengimpor controller Gudang

$controller = new GudangController(); // Membuat objek GudangController
$gudangs = $controller->ambilGudang(); // Mengambil data gudang dari controller

// Pastikan $gudangs adalah array
if (!is_array($gudangs)) {
    $gudangs = []; // Atur ke array kosong jika bukan
}

// Cek apakah ada pencarian
$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    // Filter data berdasarkan pencarian
    $gudangs = array_filter($gudangs, function($gudang) use ($searchQuery) {
        return stripos($gudang['name'], $searchQuery) !== false || 
               stripos($gudang['location'], $searchQuery) !== false; // Memfilter gudang berdasarkan nama atau lokasi
    });
}

// Pagination
$itemsPerPage = 5; // Jumlah item yang ditampilkan per halaman
$totalItems = count($gudangs); // Total jumlah item
$totalPages = ceil($totalItems / $itemsPerPage); // Total halaman
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Halaman saat ini
$currentPage = max(1, min($totalPages, $currentPage)); // Memastikan halaman saat ini berada dalam rentang yang valid

// Mengiris array untuk halaman saat ini
$offset = ($currentPage - 1) * $itemsPerPage; // Menghitung offset
$gudangsForCurrentPage = array_slice($gudangs, $offset, $itemsPerPage); // Mengambil data gudang untuk halaman saat ini
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Mengimpor file CSS khusus -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"> <!-- Memuat font Poppins -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> <!-- Mengimpor Bootstrap CSS -->
    <title>Daftar Gudang MSIB</title> <!-- Judul halaman -->
</head>
<body>
    <div class="container mt-4">
        <header>
            <h2 class="mb-5 text-center">WAREHOUSE MSIB <br> PT Citra Gama Sakti</h2>
        </header>
        <main>
            <div class="d-flex justify-content-between mb-4">
                <form class="d-flex me-2" method="GET" action="">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search" value="<?= htmlspecialchars($searchQuery) ?>"> <!-- Form pencarian -->
                    <button class="btn btn-outline-success" type="submit">Search</button> <!-- Tombol pencarian -->
                </form>
                <a href="views/gudang/Tambah.php" class="btn btn-primary"> <!-- Tombol tambah gudang -->
                    <i class="bi bi-plus-circle"></i> Tambah
                </a>
            </div>
            <table class="table table-bordered"> <!-- Tabel untuk menampilkan data gudang dengan border -->
                <thead>
                    <tr>
                        <th class="text-center" style="background-color: #007bff; color: white;">ID</th>
                        <th class="text-center" style="background-color: #007bff; color: white;">Nama Gudang</th>
                        <th class="text-center" style="background-color: #007bff; color: white;">Lokasi</th>
                        <th class="text-center" style="background-color: #007bff; color: white;">Kapasitas</th>
                        <th class="text-center" style="background-color: #007bff; color: white;">Status</th>
                        <th class="text-center" style="background-color: #007bff; color: white;">Jam Buka</th>
                        <th class="text-center" style="background-color: #007bff; color: white;">Jam Tutup</th>
                        <th class="text-center" style="background-color: #007bff; color: white;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($gudangsForCurrentPage as $gudang): ?> <!-- Loop untuk menampilkan data gudang -->
                    <tr>
                        <td class="text-center"><?= htmlspecialchars($gudang['id']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($gudang['name']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($gudang['location']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($gudang['capacity']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($gudang['status']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($gudang['opening_hour']) ?></td>
                        <td class="text-center"><?= htmlspecialchars($gudang['closing_hour']) ?></td>
                        <td class="text-center">
                            <a href="views/gudang/Ubah.php?id=<?= $gudang['id'] ?>" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Ubah
                            </a>
                            <a href="views/gudang/Hapus.php?id=<?= $gudang['id'] ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus gudang ini?');">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                            <?php if ($gudang['status'] === 'aktif'): ?> <!-- Tombol untuk mengubah status menjadi tidak aktif -->
                                <a href="views/gudang/Status.php?id=<?= $gudang['id'] ?>&status=tidak_aktif" class="btn btn-secondary" onclick="return confirm('Apakah Anda yakin ingin mengubah status gudang ini menjadi tidak aktif?');">
                                    <i class="bi bi-x-circle"></i> Nonaktifkan
                                </a>
                            <?php else: ?>
                                <a href="views/gudang/Status.php?id=<?= $gudang['id'] ?>&status=aktif" class="btn btn-success" onclick="return confirm('Apakah Anda yakin ingin mengubah status gudang ini menjadi aktif?');">
                                    <i class="bi bi-check-circle"></i> Aktifkan
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- Navigasi Pagination -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= max(1, $currentPage - 1) ?>&search=<?= urlencode($searchQuery) ?>">Back</a>
                    </li>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($searchQuery) ?>"><?= $i ?></a> <!-- Link untuk setiap halaman -->
                    </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= min($totalPages, $currentPage + 1) ?>&search=<?= urlencode($searchQuery) ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </main>
        <footer class="mt-5 text-center">
            <p>© 2024 Warehouse MSIB made by Aditya Nugraha</p> <!-- Footer -->
        </footer>
    </div>
</body>
</html>
