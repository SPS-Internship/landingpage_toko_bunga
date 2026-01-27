<?php
require_once __DIR__ . '/../config/database.php';

class OrderItem {
    private $conn;
    private $table = "order_items";

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$data['order_id'], $data['product_id'], $data['quantity'], $data['price']]);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET order_id=?, product_id=?, quantity=?, price=? WHERE id=?");
        return $stmt->execute([$data['order_id'], $data['product_id'], $data['quantity'], $data['price'], $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
