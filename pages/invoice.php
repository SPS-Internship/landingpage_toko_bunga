<?php
include '../config/database.php';
$id = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

$order = $conn->query("
SELECT o.*, c.name as customer_name
FROM orders o
JOIN customers c ON c.id = o.customer_id
WHERE o.id = '$id'
")->fetch_assoc();

$item = $conn->query("
SELECT p.name, oi.quantity, oi.price
FROM order_items oi
JOIN products p ON p.id = oi.product_id
WHERE oi.order_id = '$id'
");
?>

<section class="max-w-2xl mx-auto py-20">

<h2 class="text-2xl mb-6">
Invoice Pesanan Bunga 🌸
</h2>

<p>Customer: <?= $order['customer_name'] ?></p>
<p>Tanggal: <?= $order['order_date'] ?></p>
<p>Status: <?= $order['status'] ?></p>

<hr class="my-6">

<table class="w-full text-center">
<tr class="bg-pink-100">
  <th class="p-3">Produk</th>
  <th>Qty</th>
  <th>Harga</th>
  <th>Subtotal</th>
</tr>

<?php while($d = $item->fetch_assoc()): ?>
<tr class="border-b">
<td class="p-3"><?= $d['name'] ?></td>
<td><?= $d['quantity'] ?></td>
<td>Rp <?= number_format($d['price']) ?></td>
<td>
Rp <?= number_format($d['quantity'] * $d['price']) ?>
</td>
</tr>
<?php endwhile; ?>
</table>

<div class="text-right mt-6">
<b>Total: Rp <?= number_format($order['total_price']) ?></b>
</div>

</section>

<?php include '../includes/footer.php'; ?>
