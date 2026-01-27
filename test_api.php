<?php
echo "<h2>Test API Toko Bunga</h2>";

// Test koneksi database
try {
    require_once 'config/database.php';
    echo "<p style='color: green;'>✅ Database config loaded</p>";
    
    $db = new Database();
    $conn = $db->getConnection();
    
    if ($conn) {
        echo "<p style='color: green;'>✅ Database connected</p>";
        
        // Test query
        $stmt = $conn->query("SELECT COUNT(*) as total FROM categories");
        $result = $stmt->fetch();
        echo "<p>Categories: " . $result['total'] . "</p>";
        
    } else {
        echo "<p style='color: red;'>❌ Database connection failed</p>";
    }
    
} catch(Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>Test API Endpoints:</h3>";
echo "<a href='api/index.php?path=categories' target='_blank'>GET Categories</a><br>";
echo "<a href='api/index.php?path=products' target='_blank'>GET Products</a><br>";
echo "<a href='api/index.php?path=customers' target='_blank'>GET Customers</a><br>";
?>