<?php
require_once 'Database.php';
$db = Database::getInstance()->getConnection();

// Cek apakah ada parameter ID di URL
if (isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Menghapus data menggunakan prepared statements untuk keamanan
    $stmt = $db->prepare("DELETE FROM produk WHERE id_produk = ?");
    $stmt->execute([$id_produk]);

    // Redirect kembali ke index dengan flash message sukses
    header("Location: index.php?pesan=sukses_hapus");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>