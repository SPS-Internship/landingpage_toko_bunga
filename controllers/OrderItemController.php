<?php
require_once __DIR__ . '/../models/OrderItem.php';

class OrderItemController {
    private $orderItem;

    public function __construct() {
        $this->orderItem = new OrderItem();
    }

    public function index() {
        echo json_encode($this->orderItem->getAll());
    }

    public function show($id) {
        echo json_encode($this->orderItem->getById($id));
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->orderItem->create($data)) {
            echo json_encode(['message' => 'Order item created successfully']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->orderItem->update($id, $data)) {
            echo json_encode(['message' => 'Order item updated successfully']);
        }
    }

    public function destroy($id) {
        if($this->orderItem->delete($id)) {
            echo json_encode(['message' => 'Order item deleted successfully']);
        }
    }
}
?>
