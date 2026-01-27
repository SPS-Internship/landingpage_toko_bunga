-- (OPSIONAL tapi disarankan)
-- Bersihkan data lama supaya ID konsisten
TRUNCATE order_items, orders, products, customers, categories
RESTART IDENTITY CASCADE;

-- 1. Insert data categories
INSERT INTO categories (name, description) VALUES
('Buket Meja', 'Rangkaian bunga untuk hiasan meja'),
('Buket Wisuda', 'Rangkaian bunga untuk acara wisuda'),
('Buket Ulang Tahun', 'Rangkaian bunga untuk ulang tahun'),
('Buket Pernikahan', 'Rangkaian bunga untuk pernikahan');

-- 2. Insert data products
INSERT INTO products (category_id, name, description, price, image, is_active) VALUES
(1, 'Buket Mawar Meja Biru', 'Rangkaian bunga mawar biru untuk hiasan meja', 150000, 'meja-bunga-biru.jpeg', TRUE),
(1, 'Buket Lavender Meja', 'Rangkaian bunga lavender untuk hiasan meja', 175000, 'meja-bunga-lavender.jpeg', TRUE),
(1, 'Buket Lily Meja', 'Rangkaian bunga lily putih untuk hiasan meja', 160000, 'meja-bunga-lily.jpeg', TRUE),
(1, 'Buket Mawar Putih Meja', 'Rangkaian bunga mawar putih untuk hiasan meja', 155000, 'meja-bunga-mawar-putih.jpeg', TRUE),
(1, 'Buket Orkid Putih Meja', 'Rangkaian bunga orkid putih untuk hiasan meja', 180000, 'meja-bunga-orkid-putih.jpeg', TRUE),
(1, 'Buket Pink Meja', 'Rangkaian bunga pink untuk hiasan meja', 165000, 'meja-bunga-pink.jpeg', TRUE),
(1, 'Buket Pink Putih Meja', 'Rangkaian bunga pink putih untuk hiasan meja', 170000, 'meja-bunga-pink-putih.jpeg', TRUE),
(1, 'Buket Ungu Meja', 'Rangkaian bunga ungu untuk hiasan meja', 160000, 'meja-bunga-ungu.jpeg', TRUE),

(2, 'Buket Wisuda Elegant', 'Rangkaian bunga untuk acara wisuda', 200000, 'bouquet-wisuda.jpeg', TRUE),
(2, 'Buket Wisuda Premium', 'Rangkaian bunga premium untuk wisuda', 250000, 'bouquet-wisuda3.jpeg', TRUE),

(3, 'Buket Ulang Tahun Spesial', 'Rangkaian bunga untuk ulang tahun', 180000, 'bouquet-ulangtahun.jpeg', TRUE),

(4, 'Buket Pernikahan Mewah', 'Rangkaian bunga mewah untuk pernikahan', 350000, 'bouquet-pernikahan.jpeg', TRUE);

-- 3. Insert data customers
INSERT INTO customers (name, phone, address) VALUES
('Budi Santoso', '081234567890', 'Jl. Mawar No. 123, Jakarta'),
('Siti Nurhaliza', '082345678901', 'Jl. Melati No. 456, Bandung'),
('Ahmad Rahman', '083456789012', 'Jl. Anggrek No. 789, Surabaya');

-- 4. Insert data orders
INSERT INTO orders (customer_id, total_price, status) VALUES
(1, 310000, 'completed'),
(2, 180000, 'pending'),
(3, 525000, 'processing');

-- 5. Insert data order_items
INSERT INTO order_items (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 150000),
(1, 3, 1, 160000),
(2, 11, 1, 180000),
(3, 12, 1, 350000),
(3, 2, 1, 175000);
