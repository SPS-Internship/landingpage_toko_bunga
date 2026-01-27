<?php
require '../config/database.php';

$id = $_GET['id'];

$product = $pdo->prepare("SELECT * FROM products WHERE id=?");
$product->execute([$id]);
$p = $product->fetch(PDO::FETCH_ASSOC);

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        UPDATE products
        SET category_id=?, name=?, description=?, price=?, image=?, is_active=?
        WHERE id=?
    ");
    $stmt->execute([
        $_POST['category_id'],
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image'],
        $_POST['is_active'],
        $id
    ]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Edit Produk</h2>

    <form method="POST">
        <select name="category_id" class="border p-2 w-full mb-2">
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"
                    <?= $p['cat]()
