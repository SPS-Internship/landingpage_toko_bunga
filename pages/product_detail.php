<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Produk tidak ditemukan";
    exit;
}

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name
    FROM products p
    JOIN categories c ON p.category_id = c.id
    WHERE p.id = ?
");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    echo "Produk tidak ditemukan";
    exit;
}
?>

<div style="padding:20px;">
    <h2><?= $product['name']; ?></h2>
    <img src="/assets/images/products/<?= $product['image']; ?>" width="300">
    <p>Kategori: <?= $product['category_name']; ?></p>
    <p><?= $product['description']; ?></p>
    <h3>Rp <?= number_format($product['price'], 0, ',', '.'); ?></h3>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
