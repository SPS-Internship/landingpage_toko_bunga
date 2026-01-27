<?php
require_once __DIR__ . '/../models/Customer.php';

class CustomerController {
    private $customer;

    public function __construct() {
        $this->customer = new Customer();
    }

    public function index() {
        echo json_encode($this->customer->getAll());
    }

    public function show($id) {
        echo json_encode($this->customer->getById($id));
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->customer->create($data)) {
            echo json_encode(['message' => 'Customer created successfully']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->customer->update($id, $data)) {
            echo json_encode(['message' => 'Customer updated successfully']);
        }
    }

    public function destroy($id) {
        if($this->customer->delete($id)) {
            echo json_encode(['message' => 'Customer deleted successfully']);
        }
    }
}
?>
