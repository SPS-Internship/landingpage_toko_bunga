<?php
require '../../config/database.php';

/*
 Ambil data order + customer
*/
$orders = $pdo->query("
    SELECT 
        orders.id,
        orders.order_date,
        orders.total_price,
        orders.status,
        customers.name AS customer_name,
        customers.phone
    FROM orders
    JOIN customers ON orders.customer_id = customers.id
    ORDER BY orders.id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Orders</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<div class="max-w-6xl mx-auto bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Data Pesanan</h1>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">ID</th>
                <th class="border p-2">Tanggal</th>
                <th class="border p-2">Customer</th>
                <th class="border p-2">No HP</th>
                <th class="border p-2">Total</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Detail</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($orders as $o): ?>
            <tr>
                <td class="border p-2"><?= $o['id']; ?></td>
                <td class="border p-2"><?= date('d-m-Y H:i', strtotime($o['order_date'])); ?></td>
                <td class="border p-2"><?= $o['customer_name']; ?></td>
                <td class="border p-2"><?= $o['phone']; ?></td>
                <td class="border p-2 text-right">
                    Rp <?= number_format($o['total_price']); ?>
                </td>
                <td class="border p-2">
                    <span class="px-2 py-1 rounded text-white
                        <?= $o['status'] == 'pending' ? 'bg-yellow-500' : 'bg-green-600'; ?>">
                        <?= ucfirst($o['status']); ?>
                    </span>
                </td>
                <td class="border p-2 text-center">
                    <a href="?detail=<?= $o['id']; ?>"
                       class="text-blue-600 underline">
                        Lihat
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
/* ==============================
   DETAIL ORDER
============================== */
if (isset($_GET['detail'])):
    $order_id = $_GET['detail'];

    $items = $pdo->prepare("
        SELECT 
            products.name,
            order_items.quantity,
            order_items.price
        FROM order_items
        JOIN products ON order_items.product_id = products.id
        WHERE order_items.order_id = ?
    ");
    $items->execute([$order_id]);
    $items = $items->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="max-w-6xl mx-auto bg-white p-6 mt-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">
        Detail Order #<?= $order_id; ?>
    </h2>

    <table class="w-full border">
        <tr class="bg-gray-200">
            <th class="border p-2">Produk</th>
            <th class="border p-2">Qty</th>
            <th class="border p-2">Harga</th>
            <th class="border p-2">Subtotal</th>
        </tr>

        <?php foreach ($items as $i): ?>
        <tr>
            <td class="border p-2"><?= $i['name']; ?></td>
            <td class="border p-2"><?= $i['quantity']; ?></td>
            <td class="border p-2">Rp <?= number_format($i['price']); ?></td>
            <td class="border p-2">
                Rp <?= number_format($i['price'] * $i['quantity']); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php endif; ?>

</body>
</html>
