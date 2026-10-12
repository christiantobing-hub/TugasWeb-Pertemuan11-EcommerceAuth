<?php
// Dummy Data Bypass untuk Database
class Database {
    private static $instance = null;

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function query($query_string) {
        return $this;
    }

    public function fetchAll() {
        return [
            [
                'id' => 1,
                'nama_barang' => 'Laptop Asus ROG',
                'kategori' => 'Elektronik',
                'stok' => 15,
                'harga' => 15000000,
                'status' => 'Tersedia'
            ],
            [
                'id' => 2,
                'nama_barang' => 'Mouse Wireless Logitech',
                'kategori' => 'Aksesori',
                'stok' => 50,
                'harga' => 250000,
                'status' => 'Tersedia'
            ]
        ];
    }
}

// Fungsi global pendukung
function query($query_string) {
    $db = Database::getInstance();
    return $db->fetchAll();
}
?>