<?php
require '../../config/database.php';

$data = $pdo->query("SELECT * FROM categories ORDER BY id DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-4xl mx-auto bg-white p-6 rounded shadow">
    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Data Kategori</h1>
        <a href="create.php" class="bg-pink-600 text-white px-4 py-2 rounded">
            + Tambah Kategori
        </a>
    </div>

    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="p-2 border">Nama</th>
            <th class="p-2 border">Deskripsi</th>
            <th class="p-2 border">Aksi</th>
        </tr>

        <?php foreach ($data as $c): ?>
        <tr>
            <td class="p-2 border"><?= $c['name']; ?></td>
            <td class="p-2 border"><?= $c['description']; ?></td>
            <td class="p-2 border">
                <a href="edit.php?id=<?= $c['id']; ?>" class="text-blue-600">Edit</a> |
                <a href="delete.php?id=<?= $c['id']; ?>"
                   onclick="return confirm('Hapus kategori?')"
                   class="text-red-600">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
