<?php
// process/save_customer.php
require '../config/database.php';

function saveCustomer($pdo, $name, $phone, $address)
{
    $stmt = $pdo->prepare("
        INSERT INTO customers (name, phone, address, created_at)
        VALUES (?, ?, ?, NOW())
        RETURNING id
    ");
    $stmt->execute([$name, $phone, $address]);

    return $stmt->fetchColumn(); // customer_id
}
