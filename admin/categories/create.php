<?php
require '../../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("
        INSERT INTO categories (name, description, created_at)
        VALUES (?, ?, NOW())
    ");
    $stmt->execute([
        $_POST['name'],
        $_POST['description']
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Tambah Kategori</h1>

    <form method="POST">
        <input type="text" name="name" placeholder="Nama Kategori"
               class="border p-2 w-full mb-3" required>

        <textarea name="description" placeholder="Deskripsi"
                  class="border p-2 w-full mb-3"></textarea>

        <button class="bg-pink-600 text-white px-4 py-2 rounded">
            Simpan
        </button>

        <a href="index.php" class="ml-3 text-gray-600">Kembali</a>
    </form>
</div>

</body>
</html>
