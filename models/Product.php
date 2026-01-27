<?php
require_once __DIR__ . '/../config/database.php';

class Product {
    private $conn;
    private $table = "products";

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT p.*, c.name AS category_name
            FROM {$this->table} p
            LEFT JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("
            SELECT p.*, c.name AS category_name
            FROM {$this->table} p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table}
            (category_id, name, description, price, image, is_active, created_at)
            VALUES (?, ?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([
            $data['category_id'],
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image'] ?? null,
            $data['is_active'] ?? 1
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET category_id=?, name=?, description=?, price=?, image=?, is_active=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['category_id'],
            $data['name'],
            $data['description'],
            $data['price'],
            $data['image'] ?? null,
            $data['is_active'] ?? 1,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }
}
