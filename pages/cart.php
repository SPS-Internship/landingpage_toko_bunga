<?php
include '../includes/header.php';
include '../includes/navbar.php';
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

/* TAMBAH KE CART */
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = (int)$_POST['quantity'];

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += $qty;
    } else {
        $_SESSION['cart'][$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $qty
        ];
    }
}

/* UPDATE QUANTITY */
if (isset($_POST['update_qty'])) {
    foreach ($_POST['quantity'] as $id => $qty) {
        $_SESSION['cart'][$id]['quantity'] = (int)$qty;
    }
}

/* HAPUS ITEM */
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<section class="max-w-5xl mx-auto px-6 py-20">
<h2 class="text-3xl font-bold mb-10 text-center text-primary">
Keranjang Bunga 🌸
</h2>

<form method="POST">
<table class="w-full mb-8">
<tr class="bg-pink-100">
    <th class="p-3">Produk</th>
    <th>Harga</th>
    <th>Qty</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php foreach($_SESSION['cart'] as $id => $item): ?>
<tr class="text-center border-b">
<td class="p-3"><?= $item['name'] ?></td>
<td>Rp <?= number_format($item['price']) ?></td>
<td>
<input type="number" name="quantity[<?= $id ?>]"  
       value="<?= $item['quantity'] ?>" class="w-20 border p-2">
</td>
<td>
Rp <?= number_format($item['price'] * $item['quantity']) ?>
</td>
<td>
<a href="?remove=<?= $id ?>" class="text-red-500">Hapus</a>
</td>
</tr>
<?php endforeach; ?>
</table>

<div class="text-right mb-6">
<b>Total: Rp <?= number_format($total) ?></b>
</div>

<button name="update_qty" class="bg-pink-400 text-white px-5 py-2 rounded">
Update
</button>

<a href="checkout.php"  
   class="bg-pink-600 text-white px-6 py-3 rounded ml-4">
Lanjut Checkout
</a>
</form>
</section>

<?php include '../includes/footer.php'; ?>
