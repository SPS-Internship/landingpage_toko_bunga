<?php
require_once __DIR__ . '/../models/Category.php';

class CategoryController {
    private $category;

    public function __construct() {
        $this->category = new Category();
    }

    public function index() {
        echo json_encode($this->category->getAll());
    }

    public function show($id) {
        echo json_encode($this->category->getById($id));
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->category->create($data)) {
            echo json_encode(['message' => 'Category created successfully']);
        }
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);
        if($this->category->update($id, $data)) {
            echo json_encode(['message' => 'Category updated successfully']);
        }
    }

    public function destroy($id) {
        if($this->category->delete($id)) {
            echo json_encode(['message' => 'Category deleted successfully']);
        }
    }
}
?>
