<?php
require_once __DIR__ . '/../config/database.php';

class Order {
    private $conn;
    private $table = "orders";

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
        $stmt = $this->conn->prepare("INSERT INTO {$this->table} (customer_id, order_date, total_price, status) VALUES (?, NOW(), ?, ?)");
        return $stmt->execute([$data['customer_id'], $data['total_price'], $data['status']]);
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE {$this->table} SET customer_id=?, total_price=?, status=? WHERE id=?");
        return $stmt->execute([$data['customer_id'], $data['total_price'], $data['status'], $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
