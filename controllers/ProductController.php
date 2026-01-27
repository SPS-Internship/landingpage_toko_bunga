<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../config/database.php';

class ProductController {
    private $product;
    private $pdo;

    public function __construct() {
        $this->product = new Product();
        $this->pdo = (new Database())->getConnection();
    }

    private function categoryExists($id) {
        $stmt = $this->pdo->prepare("SELECT id FROM categories WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function index() {
        echo json_encode($this->product->getAll());
    }

    public function show($id) {
        echo json_encode($this->product->getById($id));
    }

    public function store() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$this->categoryExists($data['category_id'] ?? 0)) {
            http_response_code(400);
            echo json_encode(["error" => "Category not found"]);
            return;
        }

        $this->product->create($data);
        echo json_encode(["message" => "Product created"]);
    }

    public function update($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$this->categoryExists($data['category_id'] ?? 0)) {
            http_response_code(400);
            echo json_encode(["error" => "Category not found"]);
            return;
        }

        $this->product->update($id, $data);
        echo json_encode(["message" => "Product updated"]);
    }

    public function destroy($id) {
        $this->product->delete($id);
        echo json_encode(["message" => "Product deleted"]);
    }
}
