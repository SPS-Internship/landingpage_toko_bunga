<?php
require '../../config/database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM categories WHERE id=?");
$stmt->execute([$id]);
$category = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare("
        UPDATE categories SET name=?, description=? WHERE id=?
    ");
    $stmt->execute([
        $_POST['name'],
        $_POST['description'],
        $id
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-xl font-bold mb-4">Edit Kategori</h1>

    <form method="POST">
        <input type="text" name="name"
               value="<?= $category['name']; ?>"
               class="border p-2 w-full mb-3" required>

        <textarea name="description"
                  class="border p-2 w-full mb-3"><?= $category['description']; ?></textarea>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="index.php" class="ml-3 text-gray-600">Batal</a>
    </form>
</div>

</body>
</html>
