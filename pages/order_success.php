<?php
$name        = $_POST['name'] ?? '';
$phone       = $_POST['phone'] ?? '';
$address     = $_POST['address'] ?? '';
$product     = $_POST['product_name'] ?? '';
$quantity    = $_POST['quantity'] ?? '';
$total_price = $_POST['total_price'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Berhasil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center min-h-screen bg-green-100">

<div class="bg-white p-6 rounded-xl shadow-lg max-w-md w-full text-center">
    <h1 class="text-2xl font-bold text-green-600 mb-4">
        Pesanan Berhasil 🎉
    </h1>

    <div class="text-left text-sm space-y-2 mb-4">
        <p><strong>Nama:</strong> <?= $name ?></p>
        <p><strong>Produk:</strong> <?= $product ?></p>
        <p><strong>Jumlah:</strong> <?= $quantity ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($total_price,0,',','.') ?></p>
        <p><strong>Alamat:</strong> <?= $address ?></p>
    </div>

    <!-- ✅ PERBAIKAN INTI: LINK HOME -->
    <a href="home.php"
       class="block bg-pink-600 hover:bg-pink-700 text-white py-2 rounded-lg">
        Kembali ke Home
    </a>
</div>

</body>
</html>
