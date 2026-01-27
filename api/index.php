<?php
header("Content-Type: application/json");
require_once __DIR__ . '/../config/Database.php';

$db = new Database();
$pdo = $db->getConnection();

$method = $_SERVER['REQUEST_METHOD'];

/* ===== PARSING URI AMAN ===== */
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

$apiIndex = array_search('api', $uri);

if ($apiIndex === false) {
    responseError("Invalid API path", 404);
    exit;
}

$resource = $uri[$apiIndex + 1] ?? null;
$id = $uri[$apiIndex + 2] ?? null;

if (!$resource) {
    responseError("Resource not specified", 404);
    exit;
}

/* ================= ROUTING ================= */
switch ($resource) {

    case 'categories':
        if ($method === 'GET' && !$id) {
            getAllCategories($pdo);
        } elseif ($method === 'GET' && $id) {
            getCategoryById($pdo, $id);
        } elseif ($method === 'POST') {
            createCategory($pdo);
        } elseif ($method === 'PUT' && $id) {
            updateCategory($pdo, $id);
        } elseif ($method === 'DELETE' && $id) {
            deleteCategory($pdo, $id);
        } else {
            responseError("Method not allowed", 405);
        }
        break;

    case 'products':
        if ($method === 'GET' && !$id) {
            getProducts($pdo);
        } elseif ($method === 'GET' && $id) {
            getProductById($pdo, $id);
        } elseif ($method === 'POST') {
            createProduct($pdo);
        } elseif ($method === 'PUT' && $id) {
            updateProduct($pdo, $id);
        } elseif ($method === 'DELETE' && $id) {
            deleteProduct($pdo, $id);
        } else {
            responseError("Method not allowed", 405);
        }
        break;

    default:
        responseError("API route not found", 404);
}

/* ================= FUNCTIONS ================= */

function getAllCategories($pdo)
{
    $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY id");
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $result = [];

    foreach ($categories as $cat) {
        $stmtProd = $pdo->prepare("
            SELECT id, name, price, image
            FROM products
            WHERE category_id = :id
            ORDER BY id
        ");
        $stmtProd->execute(['id' => $cat['id']]);

        $result[] = [
            "id" => $cat['id'],
            "name" => $cat['name'],
            "products" => $stmtProd->fetchAll(PDO::FETCH_ASSOC)
        ];
    }

    echo json_encode($result, JSON_PRETTY_PRINT);
}

function getCategoryById($pdo, $id)
{
    $stmt = $pdo->prepare("SELECT id, name FROM categories WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $cat = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cat) {
        responseError("Category not found", 404);
        return;
    }

    $stmtProd = $pdo->prepare("
        SELECT id, name, price, image
        FROM products
        WHERE category_id = :id
    ");
    $stmtProd->execute(['id' => $id]);

    echo json_encode([
        "id" => $cat['id'],
        "name" => $cat['name'],
        "products" => $stmtProd->fetchAll(PDO::FETCH_ASSOC)
    ], JSON_PRETTY_PRINT);
}

function createCategory($pdo)
{
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("
        INSERT INTO categories (name, description)
        VALUES (:name, :description)
    ");
    $stmt->execute([
        'name' => $data['name'],
        'description' => $data['description'] ?? null
    ]);

    echo json_encode(["message" => "Category created"]);
}

function updateCategory($pdo, $id)
{
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("
        UPDATE categories
        SET name = :name, description = :description
        WHERE id = :id
    ");
    $stmt->execute([
        'id' => $id,
        'name' => $data['name'],
        'description' => $data['description'] ?? null
    ]);

    echo json_encode(["message" => "Category updated"]);
}

function deleteCategory($pdo, $id)
{
    $stmt = $pdo->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo json_encode(["message" => "Category deleted"]);
}

/* ================= PRODUCTS ================= */

function getProducts($pdo)
{
    $stmt = $pdo->query("
        SELECT p.id, p.name, p.price, p.image, c.name AS category
        FROM products p
        JOIN categories c ON c.id = p.category_id
        ORDER BY p.id
    ");

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_PRETTY_PRINT);
}

function getProductById($pdo, $id)
{
    $stmt = $pdo->prepare("
        SELECT p.id, p.name, p.price, p.image, c.name AS category
        FROM products p
        JOIN categories c ON c.id = p.category_id
        WHERE p.id = :id
    ");
    $stmt->execute(['id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        responseError("Product not found", 404);
        return;
    }

    echo json_encode($product, JSON_PRETTY_PRINT);
}

function createProduct($pdo)
{
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("
        INSERT INTO products (category_id, name, price, image)
        VALUES (:category_id, :name, :price, :image)
    ");
    $stmt->execute([
        'category_id' => $data['category_id'],
        'name' => $data['name'],
        'price' => $data['price'],
        'image' => $data['image']
    ]);

    echo json_encode(["message" => "Product created"]);
}

function updateProduct($pdo, $id)
{
    $data = json_decode(file_get_contents("php://input"), true);

    $stmt = $pdo->prepare("
        UPDATE products
        SET name = :name, price = :price, image = :image, category_id = :category_id
        WHERE id = :id
    ");
    $stmt->execute([
        'id' => $id,
        'name' => $data['name'],
        'price' => $data['price'],
        'image' => $data['image'],
        'category_id' => $data['category_id']
    ]);

    echo json_encode(["message" => "Product updated"]);
}

function deleteProduct($pdo, $id)
{
    $stmt = $pdo->prepare("DELETE FROM products WHERE id = :id");
    $stmt->execute(['id' => $id]);

    echo json_encode(["message" => "Product deleted"]);
}

function responseError($msg, $code = 400)
{
    http_response_code($code);
    echo json_encode(["error" => $msg]);
}
