<?php
require '../config/database.php';

$products = $pdo->query("
    SELECT products.*, categories.name AS category
    FROM products
    JOIN categories ON products.category_id = categories.id
    ORDER BY products.id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Data Produk</h1>
        <a href="create.php" class="bg-pink-600 text-white px-4 py-2 rounded">
            + Tambah Produk
        </a>
    </div>

    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="border p-2">No</th>
            <th class="border p-2">Nama</th>
            <th class="border p-2">Kategori</th>
            <th class="border p-2">Harga</th>
            <th class="border p-2">Status</th>
            <th class="border p-2">Aksi</th>
        </tr>

        <?php foreach ($products as $i => $p): ?>
        <tr>
            <td class="border p-2"><?= $i + 1 ?></td>
            <td class="border p-2"><?= $p['name'] ?></td>
            <td class="border p-2"><?= $p['category'] ?></td>
            <td class="border p-2">Rp <?= number_format($p['price']) ?></td>
            <td class="border p-2">
                <?= $p['is_active'] ? 'Aktif' : 'Nonaktif' ?>
            </td>
            <td class="border p-2 space-x-2">
                <a href="edit.php?id=<?= $p['id'] ?>" class="text-blue-600">Edit</a>
                <a href="delete.php?id=<?= $p['id'] ?>"
                   onclick="return confirm('Hapus produk?')"
                   class="text-red-600">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
