<?php
require_once 'config/database.php';

echo "<h2>Test Koneksi Database PostgreSQL</h2>";

try {
    // Test koneksi menggunakan class Database
    $db = new Database();
    $conn = $db->getConnection();
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Koneksi berhasil ke database db_toko_bunga!</p>";
        
        // Test query sederhana
        $stmt = $conn->query("SELECT version()");
        $version = $stmt->fetch();
        echo "<p>PostgreSQL Version: " . $version['version'] . "</p>";
        
        // Test tabel yang ada
        $stmt = $conn->query("
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public'
            ORDER BY table_name
        ");
        $tables = $stmt->fetchAll();
        
        echo "<h3>Tabel yang tersedia:</h3>";
        if (count($tables) > 0) {
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>" . $table['table_name'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p style='color: orange;'>⚠️ Belum ada tabel. Jalankan script create_database.sql terlebih dahulu.</p>";
        }
        
    } else {
        echo "<p style='color: red;'>❌ Gagal membuat koneksi!</p>";
    }
    
} catch(Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p>Pastikan:</p>";
    echo "<ul>";
    echo "<li>PostgreSQL service berjalan</li>";
    echo "<li>Database 'db_toko_bunga' sudah dibuat</li>";
    echo "<li>Password 'myuu' benar</li>";
    echo "<li>Port 5432 tidak diblok</li>";
    echo "</ul>";
}
?>