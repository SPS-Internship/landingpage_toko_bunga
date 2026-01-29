<?php 
require_once '../config/database.php';
include '../includes/header.php'; 
include '../includes/navbar.php'; 

$kategori = $_GET['kategori'] ?? '';

// Ambil produk dari database
if ($kategori) {
    $stmt = $pdo->prepare("
        SELECT p.*, c.name as category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE c.name LIKE ? AND p.is_active = true
        ORDER BY p.id
    ");
    $stmt->execute(['%' . ucfirst($kategori) . '%']);
    $products = $stmt->fetchAll();
} else {
    $stmt = $pdo->query("
        SELECT p.*, c.name as category_name 
        FROM products p 
        JOIN categories c ON p.category_id = c.id 
        WHERE p.is_active = true
        ORDER BY p.id
    ");
    $products = $stmt->fetchAll();
}
?>

<!-- Font Awesome (kalau header.php kamu belum ada, ini wajib) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

<style>
.product-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 32px;
  max-width: 1200px;
  margin: auto;
}

.product-card {
  background: #ffffff;
  border-radius: 24px;
  overflow: hidden;
  box-shadow: 0 15px 35px rgba(0,0,0,0.12);
  transition: transform .3s ease, box-shadow .3s ease;
}

.product-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 25px 45px rgba(0,0,0,0.18);
}

.product-card img {
  width: 100%;
  height: 240px;
  object-fit: cover;
  display: block;
}

.product-body {
  padding: 20px 22px 26px;
}

.product-body h3 {
  font-size: 18px;
  margin-bottom: 10px;
  color: #222;
}

.product-body .price {
  font-size: 16px;
  font-weight: 700;
  color: #e91e63;
}

/* ICON JUDUL */
.page-title {
  text-align: center;
  font-size: 42px;
  margin-bottom: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 12px;
}

.page-title i {
  color: #e91e63;
  font-size: 38px;
}
</style>

<section style="padding:90px 40px; background:#f7f7f7;">
  
  <!-- JUDUL PAKAI FONT AWESOME -->
  <h1 class="page-title">
    <i class="fa-solid fa-spa" aria-hidden="true"></i>
    Daftar Produk
  </h1>

  <div class="product-grid">
    <?php if (empty($products)): ?>
      <p style="text-align:center; color:#777; grid-column:1/-1;">
        <i class="fa-solid fa-circle-info" style="color:#e91e63; margin-right:6px;"></i>
        Produk tidak ditemukan
      </p>
    <?php else: ?>
      <?php foreach ($products as $product): ?>
        <div class="product-card">
          <img src="../image/products/<?= $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <div class="product-body">
            <h3><?= htmlspecialchars($product['name']) ?></h3>

            <div class="price">
              <i class="fa-solid fa-tag" style="margin-right:6px;"></i>
              Rp <?= number_format($product['price'], 0, ',', '.') ?>
            </div>

            <form method="POST" action="checkout.php" style="margin-top:10px;">
              <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
              <input type="hidden" name="product_img" value="../image/products/<?= $product['image'] ?>">
              <input type="hidden" name="price" value="<?= $product['price'] ?>">
              <input type="hidden" name="quantity" value="1">

              <button type="submit" style="background:#e91e63; color:white; padding:8px 16px; border:none; border-radius:20px; cursor:pointer;">
                <i class="fa-solid fa-cart-shopping" style="margin-right:6px;"></i>
                Pesan Sekarang
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>

<?php include '../includes/footer.php'; ?>
