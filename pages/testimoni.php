<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Testimoni Pelanggan</title>

  <!-- TAILWIND (KHUSUS NAVBAR) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- CSS UTAMA (HOME & TESTIMONI SAMA) -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<section class="testimonial-section" id="testimoni">

  <!-- 🔥 PERBAIKAN INTI ADA DI SINI (CLASS DISAMAKAN DENGAN HOME) -->
  <h2 class="section-title">Testimoni Pelanggan</h2>
  <p class="section-subtitle">
    Cerita kepuasan dari pelanggan setia kami 💬
  </p>

  <div class="testimonial-grid">

    <div class="testimonial-card">
      <p class="testimonial-text">
        “Bunganya segar, pengiriman cepat dan rapi.”
      </p>
      <span class="testimonial-name">Rina — Jakarta</span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        “Pelayanannya ramah dan sesuai foto.”
      </p>
      <span class="testimonial-name">Andi — Bandung</span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        “Pesan pagi, sore sudah sampai.”
      </p>
      <span class="testimonial-name">Sari — Surabaya</span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        “Harga terjangkau tapi kualitas premium.”
      </p>
      <span class="testimonial-name">Dwi — Yogyakarta</span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        “Bunganya tahan lama dan wangi.”
      </p>
      <span class="testimonial-name">Budi — Malang</span>
    </div>

  </div>
</section>

<!-- 🔥 INI SATU-SATUNYA PERBAIKAN -->
<?php include "../includes/footer.php"; ?>

</body>
</html>
