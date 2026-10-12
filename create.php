<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

// Mengambil data kategori untuk dropdown
$stmtKategori = $db->query("SELECT * FROM kategori");
$kategoriList = $stmtKategori->fetchAll(PDO::FETCH_ASSOC);

// Mengambil data supplier untuk dropdown
$stmtSupplier = $db->query("SELECT * FROM supplier");
$supplierList = $stmtSupplier->fetchAll(PDO::FETCH_ASSOC);

// Proses simpan data saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];
    $id_kategori = $_POST['id_kategori'];
    $id_supplier = $_POST['id_supplier'];

    // Menggunakan Prepared Statements untuk keamanan query input
    $stmt = $db->prepare("INSERT INTO produk (nama_produk, stok, harga, id_kategori, id_supplier) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama_produk, $stok, $harga, $id_kategori, $id_supplier]);

    // Redirect dengan flash message sukses[cite: 2]
    header("Location: index.php?pesan=sukses_tambah");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-4">➕ Tambah Produk Baru</h3>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($kategoriList as $kat): ?>
                                <option value="<?= $kat['id_kategori']; ?>"><?= htmlspecialchars($kat['nama_kategori']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Supplier</label>
                        <select class="form-select" id="id_supplier" name="id_supplier" required>
                            <option value="">-- Pilih Supplier --</option>
                            <?php foreach ($supplierList as $sup): ?>
                                <option value="<?= $sup['id_supplier']; ?>"><?= htmlspecialchars($sup['nama_supplier']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" step="0.01" class="form-control" id="harga" name="harga" required>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Data</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>