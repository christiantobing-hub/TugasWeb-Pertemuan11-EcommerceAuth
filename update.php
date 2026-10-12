<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

// Cek apakah ada parameter ID di URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_produk = $_GET['id'];

// Ambil data produk berdasarkan ID menggunakan prepared statements
$stmt = $db->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->execute([$id_produk]);
$produk = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produk) {
    header("Location: index.php");
    exit;
}

// Ambil data kategori untuk dropdown
$stmtKategori = $db->query("SELECT * FROM kategori");
$kategoriList = $stmtKategori->fetchAll(PDO::FETCH_ASSOC);

// Ambil data supplier untuk dropdown
$stmtSupplier = $db->query("SELECT * FROM supplier");
$supplierList = $stmtSupplier->fetchAll(PDO::FETCH_ASSOC);

// Proses update saat form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_produk = $_POST['nama_produk'];
    $stok        = $_POST['stok'];
    $harga       = $_POST['harga'];
    $id_kategori = $_POST['id_kategori'];
    $id_supplier = $_POST['id_supplier'];

    $updateStmt = $db->prepare("UPDATE produk SET nama_produk = ?, stok = ?, harga = ?, id_kategori = ?, id_supplier = ? WHERE id_produk = ?");
    $updateStmt->execute([$nama_produk, $stok, $harga, $id_kategori, $id_supplier, $id_produk]);

    // Redirect dengan flash message sukses
    header("Location: index.php?pesan=sukses_ubah");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Inventaris</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-4">✏️ Edit Data Produk</h3>
                
                <form method="POST">
                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="id_kategori" name="id_kategori" required>
                            <?php foreach ($kategoriList as $kat): ?>
                                <option value="<?= $kat['id_kategori']; ?>" <?= ($kat['id_kategori'] == $produk['id_kategori']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($kat['nama_kategori']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="id_supplier" class="form-label">Supplier</label>
                        <select class="form-select" id="id_supplier" name="id_supplier" required>
                            <?php foreach ($supplierList as $sup): ?>
                                <option value="<?= $sup['id_supplier']; ?>" <?= ($sup['id_supplier'] == $produk['id_supplier']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($sup['nama_supplier']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" class="form-control" id="stok" name="stok" value="<?= htmlspecialchars($produk['stok']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga (Rp)</label>
                        <input type="number" step="0.01" class="form-control" id="harga" name="harga" value="<?= htmlspecialchars($produk['harga']); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>