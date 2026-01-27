<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

require_once __DIR__ . '/../controllers/CategoryController.php';
require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../controllers/CustomerController.php';
require_once __DIR__ . '/../controllers/OrderController.php';
require_once __DIR__ . '/../controllers/OrderItemController.php';

/*
|--------------------------------------------------------------------------
| PERBAIKAN UTAMA DI SINI ✅
| - Jika path kosong → ambil dari QUERY STRING
| - Mencegah resource kosong yang bikin 405
|--------------------------------------------------------------------------
*/
$path = $_GET['path'] ?? '';

if ($path === '') {
    // fallback: ?products atau ?categories
    foreach ($_GET as $key => $value) {
        if ($key !== 'path') {
            $path = $key;
            break;
        }
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$parts = explode('/', trim($path, '/'));
$resource = $parts[0] ?? '';
$id = $parts[1] ?? null;

try {
    switch ($resource) {

        case 'categories':
            $controller = new CategoryController();
            handleRequest($controller, $method, $id);
            break;

        case 'products':
            $controller = new ProductController();
            handleRequest($controller, $method, $id);
            break;

        case 'customers':
            $controller = new CustomerController();
            handleRequest($controller, $method, $id);
            break;

        case 'orders':
            $controller = new OrderController();
            handleRequest($controller, $method, $id);
            break;

        case 'order_items':
            $controller = new OrderItemController();
            handleRequest($controller, $method, $id);
            break;

        default:
            http_response_code(404);
            echo json_encode(['error' => 'Endpoint not found']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

function handleRequest($controller, $method, $id) {
    switch ($method) {
        case 'GET':
            if ($id) {
                $controller->show($id);
            } else {
                $controller->index();
            }
            break;

        case 'POST':
            $controller->store();
            break;

        case 'PUT':
            if ($id) {
                $controller->update($id);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID required for update']);
            }
            break;

        case 'DELETE':
            if ($id) {
                $controller->destroy($id);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID required for delete']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['error' => 'Method not allowed']);
            break;
    }
}
