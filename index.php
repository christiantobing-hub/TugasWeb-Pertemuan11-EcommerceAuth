<?php
// Dummy Data Langsung di index.php (Bypass Total Database & Class)
$products = [
    ['id' => 1, 'nama_barang' => 'Laptop Asus ROG', 'kategori' => 'Elektronik', 'stok' => 15, 'harga' => 15000000],
    ['id' => 2, 'nama_barang' => 'Mouse Wireless Logitech', 'kategori' => 'Aksesori', 'stok' => 50, 'harga' => 250000],
    ['id' => 3, 'nama_barang' => 'Keyboard Mekanikal Redragon', 'kategori' => 'Aksesori', 'stok' => 8, 'harga' => 650000],
    ['id' => 4, 'nama_barang' => 'Monitor LG 24 Inch', 'kategori' => 'Elektronik', 'stok' => 0, 'harga' => 2100000]
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Inventaris App - Dummy Mode</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f4f7f6; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h2>Daftar Inventaris Barang (Mode Darurat / Dummy)</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $item): ?>
            <tr>
                <td><?= $item['id']; ?></td>
                <td><?= $item['nama_barang']; ?></td>
                <td><?= $item['kategori']; ?></td>
                <td><?= $item['stok']; ?></td>
                <td>Rp <?= number_format($item['harga'], 0, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>