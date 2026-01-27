-- Script untuk database db_toko_bunga
-- Jalankan di pgAdmin atau psql

-- Gunakan database db_toko_bunga
\c db_toko_bunga;

-- Buat tabel categories
CREATE TABLE IF NOT EXISTS categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Buat tabel products
CREATE TABLE IF NOT EXISTS products (
    id SERIAL PRIMARY KEY,
    category_id INTEGER NOT NULL,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
);

-- Buat tabel customers
CREATE TABLE IF NOT EXISTS customers (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Buat tabel orders
CREATE TABLE IF NOT EXISTS orders (
    id SERIAL PRIMARY KEY,
    customer_id INTEGER NOT NULL,
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    total_price DECIMAL(10,2) NOT NULL,
    status VARCHAR(50) DEFAULT 'pending',
    FOREIGN KEY (customer_id) REFERENCES customers(id) ON DELETE CASCADE
);

-- Buat tabel order_items
CREATE TABLE IF NOT EXISTS order_items (
    id SERIAL PRIMARY KEY,
    order_id INTEGER NOT NULL,
    product_id INTEGER NOT NULL,
    quantity INTEGER NOT NULL DEFAULT 1,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Buat index
CREATE INDEX IF NOT EXISTS idx_products_category ON products(category_id);
CREATE INDEX IF NOT EXISTS idx_orders_customer ON orders(customer_id);
CREATE INDEX IF NOT EXISTS idx_order_items_order ON order_items(order_id);
CREATE INDEX IF NOT EXISTS idx_order_items_product ON order_items(product_id);

-- Insert data categories
INSERT INTO categories (name, description) VALUES
('Buket Meja', 'Rangkaian bunga untuk hiasan meja'),
('Buket Wisuda', 'Rangkaian bunga untuk acara wisuda'),
('Buket Ulang Tahun', 'Rangkaian bunga untuk ulang tahun'),
('Buket Pernikahan', 'Rangkaian bunga untuk pernikahan')
ON CONFLICT DO NOTHING;

-- Insert data products
INSERT INTO products (category_id, name, description, price, image, is_active) VALUES
(1, 'Buket Mawar Meja Biru', 'Rangkaian bunga mawar biru untuk hiasan meja', 150000, 'meja-bunga-biru.jpeg', true),
(1, 'Buket Lavender Meja', 'Rangkaian bunga lavender untuk hiasan meja', 175000, 'meja-bunga-lavender.jpeg', true),
(1, 'Buket Lily Meja', 'Rangkaian bunga lily putih untuk hiasan meja', 160000, 'meja-bunga-lily.jpeg', true),
(2, 'Buket Wisuda Elegant', 'Rangkaian bunga untuk acara wisuda', 200000, 'bouquet-wisuda.jpeg.jpeg', true),
(3, 'Buket Ulang Tahun Spesial', 'Rangkaian bunga untuk ulang tahun', 180000, 'bouquet-ulangtahun.jpeg.jpeg', true),
(4, 'Buket Pernikahan Mewah', 'Rangkaian bunga mewah untuk pernikahan', 350000, 'bouquet-pernikahan.jpeg.jpeg', true)
ON CONFLICT DO NOTHING;