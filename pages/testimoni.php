<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Testimoni Pelanggan</title>

  <!-- TAILWIND (KHUSUS NAVBAR) -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- FONT AWESOME (ICON) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- CSS UTAMA (HOME & TESTIMONI SAMA) -->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<?php include "../includes/navbar.php"; ?>

<section class="testimonial-section" id="testimoni">

  <h2 class="section-title">
    Testimoni Pelanggan
    <i class="fa-solid fa-comment-dots" style="margin-left:8px;color:#ff2f75;"></i>
  </h2>

  <p class="section-subtitle">
    Cerita kepuasan dari pelanggan setia kami
    <i class="fa-solid fa-comments" style="margin-left:6px;color:#ff2f75;"></i>
  </p>

  <div class="testimonial-grid">

    <div class="testimonial-card">
      <p class="testimonial-text">
        <i class="fa-solid fa-quote-left" style="color:#ff2f75;margin-right:6px;"></i>
        Bunganya segar, pengiriman cepat dan rapi.
      </p>
      <span class="testimonial-name">
        <i class="fa-solid fa-user" style="margin-right:6px;"></i>
        Rina — Jakarta
      </span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        <i class="fa-solid fa-quote-left" style="color:#ff2f75;margin-right:6px;"></i>
        Pelayanannya ramah dan sesuai foto.
      </p>
      <span class="testimonial-name">
        <i class="fa-solid fa-user" style="margin-right:6px;"></i>
        Andi — Bandung
      </span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        <i class="fa-solid fa-quote-left" style="color:#ff2f75;margin-right:6px;"></i>
        Pesan pagi, sore sudah sampai.
      </p>
      <span class="testimonial-name">
        <i class="fa-solid fa-user" style="margin-right:6px;"></i>
        Sari — Surabaya
      </span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        <i class="fa-solid fa-quote-left" style="color:#ff2f75;margin-right:6px;"></i>
        Harga terjangkau tapi kualitas premium.
      </p>
      <span class="testimonial-name">
        <i class="fa-solid fa-user" style="margin-right:6px;"></i>
        Dwi — Yogyakarta
      </span>
    </div>

    <div class="testimonial-card">
      <p class="testimonial-text">
        <i class="fa-solid fa-quote-left" style="color:#ff2f75;margin-right:6px;"></i>
        Bunganya tahan lama dan wangi.
      </p>
      <span class="testimonial-name">
        <i class="fa-solid fa-user" style="margin-right:6px;"></i>
        Budi — Malang
      </span>
    </div>

  </div>
</section>

<?php include "../includes/footer.php"; ?>

</body>
</html>
