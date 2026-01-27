<?php
require '../config/database.php';

$categories = $pdo->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO products (category_id, name, description, price, image, is_active, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())
    ");
    $stmt->execute([
        $_POST['category_id'],
        $_POST['name'],
        $_POST['description'],
        $_POST['price'],
        $_POST['image'],
        $_POST['is_active']
    ]);

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-100">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Tambah Produk</h2>

    <form method="POST">
        <select name="category_id" class="border p-2 w-full mb-2" required>
            <option value="">Pilih Kategori</option>
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <input name="name" placeholder="Nama Produk" class="border p-2 w-full mb-2" required>
        <textarea name="description" placeholder="Deskripsi" class="border p-2 w-full mb-2"></textarea>
        <input name="price" type="number" placeholder="Harga" class="border p-2 w-full mb-2" required>
        <input name="image" placeholder="Nama File Gambar (contoh.jpg)" class="border p-2 w-full mb-2">

        <select name="is_active" class="border p-2 w-full mb-4">
            <option value="1">Aktif</option>
            <option value="0">Nonaktif</option>
        </select>

        <button class="bg-pink-600 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>

</body>
</html>
