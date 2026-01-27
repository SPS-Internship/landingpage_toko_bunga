<?php
// ===== REQUIRE CONTROLLERS =====
require_once __DIR__ . '/../controllers/CategoryController.php';
require_once __DIR__ . '/../controllers/ProductController.php';
require_once __DIR__ . '/../controllers/CustomerController.php';
require_once __DIR__ . '/../controllers/OrderController.php';
require_once __DIR__ . '/../controllers/OrderItemController.php';

// ===== HEADER JSON =====
header("Content-Type: application/json");

// ===== AMBIL PATH DARI URL =====
// Contoh URL: http://localhost/api/categories/1
$path = $_GET['path'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$parts = explode('/', trim($path, '/')); // misal: categories/1
$resource = $parts[0] ?? '';
$id = $parts[1] ?? null;

// ===== ROUTER =====
switch($resource) {

    // ===== CATEGORIES =====
    case 'categories':
        $controller = new CategoryController();
        if($method === 'GET' && !$id) $controller->index();
        else if($method === 'GET' && $id) $controller->show($id);
        else if($method === 'POST') $controller->store();
        else if($method === 'PUT' && $id) $controller->update($id);
        else if($method === 'DELETE' && $id) $controller->destroy($id);
        else echo json_encode(['message'=>'Invalid method']);
        break;

    // ===== PRODUCTS =====
    case 'products':
        $controller = new ProductController();
        if($method === 'GET' && !$id) $controller->index();
        else if($method === 'GET' && $id) $controller->show($id);
        else if($method === 'POST') $controller->store();
        else if($method === 'PUT' && $id) $controller->update($id);
        else if($method === 'DELETE' && $id) $controller->destroy($id);
        else echo json_encode(['message'=>'Invalid method']);
        break;

    // ===== CUSTOMERS =====
    case 'customers':
        $controller = new CustomerController();
        if($method === 'GET' && !$id) $controller->index();
        else if($method === 'GET' && $id) $controller->show($id);
        else if($method === 'POST') $controller->store();
        else if($method === 'PUT' && $id) $controller->update($id);
        else if($method === 'DELETE' && $id) $controller->destroy($id);
        else echo json_encode(['message'=>'Invalid method']);
        break;

    // ===== ORDERS =====
    case 'orders':
        $controller = new OrderController();
        if($method === 'GET' && !$id) $controller->index();
        else if($method === 'GET' && $id) $controller->show($id);
        else if($method === 'POST') $controller->store();
        else if($method === 'PUT' && $id) $controller->update($id);
        else if($method === 'DELETE' && $id) $controller->destroy($id);
        else echo json_encode(['message'=>'Invalid method']);
        break;

    // ===== ORDER ITEMS =====
    case 'order_items':
        $controller = new OrderItemController();
        if($method === 'GET' && !$id) $controller->index();
        else if($method === 'GET' && $id) $controller->show($id);
        else if($method === 'POST') $controller->store();
        else if($method === 'PUT' && $id) $controller->update($id);
        else if($method === 'DELETE' && $id) $controller->destroy($id);
        else echo json_encode(['message'=>'Invalid method']);
        break;

    // ===== DEFAULT =====
    default:
        http_response_code(404);
        echo json_encode(['message'=>'Endpoint not found']);
        break;
}
