<?php
// process/add_order.php
require '../config/database.php';
require 'save_customer.php';
require 'add_order_item.php';

$name       = $_POST['name'];
$phone      = $_POST['phone'];
$address    = $_POST['address'];
$product_id = $_POST['product_id'];
$quantity   = $_POST['quantity'];
$price      = $_POST['price'];
$total      = $_POST['total_price'];

try {
    $pdo->beginTransaction();

    // 1. simpan customer
    $customer_id = saveCustomer($pdo, $name, $phone, $address);

    // 2. simpan order
    $stmt = $pdo->prepare("
        INSERT INTO orders (customer_id, order_date, total_price, status)
        VALUES (?, NOW(), ?, 'pending')
        RETURNING id
    ");
    $stmt->execute([$customer_id, $total]);
    $order_id = $stmt->fetchColumn();

    // 3. simpan order item
    addOrderItem($pdo, $order_id, $product_id, $quantity, $price);

    $pdo->commit();
    header("Location: ../pages/order_success.php");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}
