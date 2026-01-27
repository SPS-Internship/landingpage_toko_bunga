<?php
include '../../config/database.php';

$id = $_GET['id'];

$db = new Database();
$conn = $db->getConnection();

$q = $conn->query("
SELECT p.name, oi.quantity, oi.price
FROM order_items oi
JOIN products p ON p.id = oi.product_id
WHERE oi.order_id = '$id'
");
?>

<h3 class="text-xl font-bold mb-6">
Detail Item Order #<?= $id ?> 🌸
</h3>

<table class="w-full text-center">
<tr class="bg-pink-100">
  <th class="p-3">Produk</th>
  <th>Qty</th>
  <th>Harga</th>
  <th>Subtotal</th>
</tr>

<?php while($d = $q->fetch_assoc()): ?>
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
