<?php
$product_name = $_POST['product_name'] ?? 'Produk';
$product_img  = $_POST['product_img'] ?? 'https://via.placeholder.com/150';
$price        = $_POST['price'] ?? 0;
$quantity     = $_POST['quantity'] ?? 1;
$total        = $price * $quantity;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Checkout Pesanan</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- MATIKAN FOOTER DI HALAMAN CHECKOUT -->
    <style>
        footer {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-pink-100 via-white to-pink-50">

<div class="min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-2xl bg-white rounded-2xl shadow-xl p-8">

        <!-- HEADER -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Checkout Pesanan</h2>
            <p class="text-gray-500 mt-2">
                Pesan sekarang & buat momen lebih berarti 💖
            </p>
        </div>

        <!-- PRODUK -->
        <div class="flex gap-4 bg-gray-50 border rounded-xl p-4 mb-8">
            <img src="<?= $product_img ?>" class="w-28 h-28 object-cover rounded-lg">

            <div class="flex-1">
                <h3 class="font-semibold text-lg"><?= $product_name ?></h3>
                <p class="text-sm text-gray-600">
                    Rp <?= number_format($price,0,',','.') ?> × <?= $quantity ?>
                </p>
            </div>

            <div class="text-right">
                <p class="text-sm text-gray-500">Total</p>
                <p class="text-xl font-bold text-pink-600">
                    Rp <?= number_format($total,0,',','.') ?>
                </p>
            </div>
        </div>

        <!-- FORM -->
        <form action="order_success.php" method="POST" class="space-y-4">

            <input type="hidden" name="product_name" value="<?= $product_name ?>">
            <input type="hidden" name="quantity" value="<?= $quantity ?>">
            <input type="hidden" name="total_price" value="<?= $total ?>">

            <input type="text" name="name" placeholder="Nama Lengkap" required
                   class="w-full border rounded-lg px-4 py-2">

            <input type="text" name="phone" placeholder="Nomor WhatsApp" required
                   class="w-full border rounded-lg px-4 py-2">

            <textarea name="address" rows="3" placeholder="Alamat Pengiriman" required
                      class="w-full border rounded-lg px-4 py-2"></textarea>

            <!-- TOMBOL FINAL -->
            <button
                class="w-full h-16 bg-pink-600 hover:bg-pink-700
                       text-white rounded-xl shadow-md text-lg font-semibold">
                Konfirmasi & Pesan Sekarang
            </button>

        </form>

    </div>
</div>

</body>
</html>
