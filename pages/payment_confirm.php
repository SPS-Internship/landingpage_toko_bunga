<?php
include '../includes/header.php';
include '../controllers/OrderController.php';

if (isset($_POST['confirm'])) {

  $order = new OrderController();

  $file = $_FILES['bukti']['name'];
  move_uploaded_file(
    $_FILES['bukti']['tmp_name'],
    "../image/payments/".$file
  );

  $order->updateStatus($_POST['order_id'], 'MENUNGGU VERIFIKASI');
}
?>

<section class="max-w-xl mx-auto py-20">

<h3 class="text-2xl mb-6 text-center">
Konfirmasi Pembayaran 💐
</h3>

<form method="POST" enctype="multipart/form-data">

<input name="order_id" placeholder="ID Order" class="w-full border p-3 mb-4">

<input type="file" name="bukti" class="w-full border p-3 mb-6">

<button name="confirm"  
        class="bg-pink-600 text-white w-full py-3 rounded">
Kirim Bukti
</button>

</form>
</section>

<?php include '../includes/footer.php'; ?>
