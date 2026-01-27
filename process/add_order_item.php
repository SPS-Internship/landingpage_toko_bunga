<?php
// process/add_order_item.php
require '../config/database.php';

function addOrderItem($pdo, $order_id, $product_id, $quantity, $price)
{
    $stmt = $pdo->prepare("
        INSERT INTO order_items (order_id, product_id, quantity, price)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
        $order_id,
        $product_id,
        $quantity,
        $price
    ]);
}
