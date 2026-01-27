# Panduan Setup Database PostgreSQL untuk Toko Bunga

## 1. Instalasi PostgreSQL

### Windows:
1. Download PostgreSQL dari https://www.postgresql.org/download/windows/
2. Install dengan mengikuti wizard
3. Catat password untuk user `postgres` yang Anda buat

### Alternatif menggunakan XAMPP:
Jika Anda sudah menggunakan XAMPP, Anda bisa install PostgreSQL terpisah atau menggunakan Docker.

## 2. Setup Database

### Menggunakan pgAdmin:
1. Buka pgAdmin (biasanya tersedia setelah install PostgreSQL)
2. Connect ke server PostgreSQL lokal
3. Klik kanan pada "Databases" → Create → Database
4. Atau jalankan script SQL berikut:

### Menggunakan Command Line (psql):
```bash
# Login sebagai postgres
psql -U postgres

# Jalankan script create_database.sql
\i C:/xampp/htdocs/landingpage_toko_bunga/database/create_database.sql

# Jalankan script insert_sample_data.sql
\i C:/xampp/htdocs/landingpage_toko_bunga/database/insert_sample_data.sql
```

## 3. Konfigurasi Aplikasi

1. **Update file config/database.php:**
   - Ganti password PostgreSQL sesuai dengan yang Anda set
   - Pastikan host dan port sesuai (default: localhost:5432)

2. **Atau gunakan file database_new.php yang sudah dibuat:**
   ```php
   // Rename database_new.php menjadi database.php
   // Atau update konfigurasi di database.php yang ada
   ```

## 4. Struktur Database

Database `toko_bunga` memiliki 5 tabel utama:

### 1. categories
- id (SERIAL PRIMARY KEY)
- name (VARCHAR 100)
- description (TEXT)
- created_at (TIMESTAMP)

### 2. products
- id (SERIAL PRIMARY KEY)
- category_id (INTEGER, FK ke categories)
- name (VARCHAR 200)
- description (TEXT)
- price (DECIMAL 10,2)
- image (VARCHAR 255)
- is_active (BOOLEAN)
- created_at (TIMESTAMP)

### 3. customers
- id (SERIAL PRIMARY KEY)
- name (VARCHAR 100)
- phone (VARCHAR 20)
- address (TEXT)
- created_at (TIMESTAMP)

### 4. orders
- id (SERIAL PRIMARY KEY)
- customer_id (INTEGER, FK ke customers)
- order_date (TIMESTAMP)
- total_price (DECIMAL 10,2)
- status (VARCHAR 50)

### 5. order_items
- id (SERIAL PRIMARY KEY)
- order_id (INTEGER, FK ke orders)
- product_id (INTEGER, FK ke products)
- quantity (INTEGER)
- price (DECIMAL 10,2)

## 5. Data Sample

Script `insert_sample_data.sql` akan mengisi:
- 4 kategori produk
- 12 produk bunga
- 3 customer sample
- 3 order sample dengan items

## 6. Testing Koneksi

Buat file test_connection.php:
```php
<?php
require_once 'config/database.php';

try {
    $db = new Database();
    $conn = $db->getConnection();
    echo "Koneksi berhasil!";
    
    // Test query
    $stmt = $conn->query("SELECT COUNT(*) as total FROM categories");
    $result = $stmt->fetch();
    echo "<br>Total kategori: " . $result['total'];
    
} catch(Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
```

## 7. Troubleshooting

### Error "could not connect to server":
- Pastikan PostgreSQL service berjalan
- Check port 5432 tidak diblok firewall
- Pastikan pg_hba.conf mengizinkan koneksi lokal

### Error "database does not exist":
- Jalankan script create_database.sql terlebih dahulu
- Pastikan nama database sesuai: `toko_bunga`

### Error "authentication failed":
- Pastikan password di config/database.php sesuai
- Check user postgres memiliki akses ke database