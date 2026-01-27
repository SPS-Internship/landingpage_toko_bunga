<?php
include '../../config/database.php';
include '../../controllers/OrderController.php';

$order = new OrderController();
$data = $order->getAllOrders();
?>

<h2 class="text-2xl font-bold mb-6">
Kelola Order Masuk 🌸
</h2>

<table class="w-full">
<tr class="bg-pink-100 text-center">
  <th class="p-3">ID</th>
  <th>Tanggal</th>
  <th>Customer</th>
  <th>Total</th>
  <th>Status</th>
  <th>Aksi</th>
</tr>

<?php foreach($data as $d): ?>
<tr class="text-center border-b">
<td class="p-3"><?= $d['id'] ?></td>
<td><?= $d['order_date'] ?></td>
<td><?= $d['customer_name'] ?></td>
<td>Rp <?= number_format($d['total_price']) ?></td>

<td>
<form method="POST" action="update_status.php">
<input type="hidden" name="id" value="<?= $d['id'] ?>">

<select name="status" class="border p-2">
  <option>MENUNGGU BAYAR</option>
  <option>DIPROSES</option>
  <option>SELESAI</option>
</select>
</td>

<td>
<a href="detail.php?id=<?= $d['id'] ?>" class="text-blue-500">
Detail
</a>
</td>
</tr>
<?php endforeach; ?>
</table>
