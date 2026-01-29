<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="../assets/css/style.css">

<style>
/* ================= FIX FOOTER TIDAK KE POTONG ================= */
html, body{
  width:100%;
  margin:0;
  padding:0;
  overflow-x:hidden;
}
section{ overflow:visible; }
footer,.footer,.site-footer{
  width:100%;
  max-width:100%;
  position:relative;
  clear:both;
}
.testiSwiper{ margin-bottom:0; }

/* ICON KATEGORI */
.category-card .icon{
  font-size:38px;
  margin-bottom:10px;
  color:#ff2f75;
}

/* =====================================================
   HANYA INI YANG DIUBAH: PRODUK TERBARU BIAR RAPI
   ===================================================== */
.section.bg-light .grid{
  align-items:stretch;
}

.section.bg-light .grid .card{
  display:flex;
  flex-direction:column;
  height:100%;
}

.section.bg-light .grid .card h3{
  font-size:18px;
  line-height:1.3;
  margin-bottom:6px;
  word-break:break-word;
}

.section.bg-light .grid .card p{
  font-size:14px;
  line-height:1.5;
  margin-bottom:12px;
  word-break:break-word;
}

.section.bg-light .grid .card strong{
  margin-top:auto;
  display:block;
}

.section.bg-light .grid .card .badge{
  margin-top:6px;
  white-space:nowrap;
}
/* ================= SELESAI ================= */
</style>

<!-- ================= HERO ================= -->
<section class="hero">
  <div class="hero-content" data-aos="fade-up">
    <h1>Kirim Bunga Spesial<br>Untuk Orang Tersayang</h1>
    <p>Bunga segar pilihan • Pengiriman cepat • Harga bersahabat</p>
    <div class="hero-btn">
      <a href="products.php" class="btn-primary">Lihat Produk</a>
    </div>
  </div>
</section>

<!-- ================= ABOUT (INI YANG DIPERBAIKI) ================= -->
<section class="section bg-light" style="padding:40px 20px">
  <h2 class="section-title" data-aos="fade-up">Tentang Kami</h2>
  <p class="section-subtitle" data-aos="fade-up">
    Maison Bloom terpercaya untuk setiap momen spesial. Kami menyediakan rangkaian
    bunga segar pilihan untuk ulang tahun, wisuda, pernikahan, dan berbagai momen
    istimewa lainnya.
    <br>
    <strong>Bunga Segar • Pengiriman Cepat • Desain Elegan</strong>
  </p>
</section>

<!-- ================= KATEGORI ================= -->
<section class="section" style="padding:40px 20px">
  <h2 class="section-title" data-aos="fade-up">Kategori Bunga</h2>
  <p class="section-subtitle" data-aos="fade-up">Pilih jenis bunga sesuai kebutuhan momenmu</p>

  <div class="swiper kategoriSwiper" data-aos="fade-up">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <a href="products.php?kategori=meja" class="card category-card">
          <i class="fa-solid fa-table icon"></i>
          <h3>Bunga Meja</h3>
          <p>Dekorasi ruangan</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="products.php?kategori=wisuda" class="card category-card">
          <i class="fa-solid fa-graduation-cap icon"></i>
          <h3>Wisuda</h3>
          <p>Hadiah kelulusan</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="products.php?kategori=ulang-tahun" class="card category-card">
          <i class="fa-solid fa-cake-candles icon"></i>
          <h3>Ulang Tahun</h3>
          <p>Ungkapan kasih</p>
        </a>
      </div>
      <div class="swiper-slide">
        <a href="products.php?kategori=pernikahan" class="card category-card">
          <i class="fa-solid fa-ring icon"></i>
          <h3>Pernikahan</h3>
          <p>Momen sakral</p>
        </a>
      </div>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<!-- ================= PRODUK TERBARU ================= -->
<section class="section bg-light" style="padding:40px 20px">
  <h2 class="section-title" data-aos="fade-up">Produk Terbaru</h2>
  <p class="section-subtitle" data-aos="fade-up">Rangkaian favorit pilihan</p>

  <div class="grid">
    <div class="card" data-aos="zoom-in">
      <h3>Bouquet Mawar</h3>
      <p>Elegan & romantis</p>
      <strong>Rp 250.000</strong>
      <span class="badge">Segera Hadir</span>
    </div>

    <div class="card" data-aos="zoom-in">
      <h3>Bunga Wisuda</h3>
      <p>Hadiah berkesan</p>
      <strong>Rp 200.000</strong>
      <span class="badge">Segera Hadir</span>
    </div>

    <div class="card" data-aos="zoom-in">
      <h3>Bunga Ucapan</h3>
      <p>Berbagai acara</p>
      <strong>Rp 300.000</strong>
      <span class="badge">Segera Hadir</span>
    </div>

    <div class="card" data-aos="zoom-in">
      <h3>Bunga Meja</h3>
      <p>Dekorasi cantik</p>
      <strong>Rp 180.000</strong>
      <span class="badge">Segera Hadir</span>
    </div>
  </div>
</section>

<!-- ================= TESTIMONI ================= -->
<section class="section bg-light" style="padding:35px 20px">
  <h2 class="section-title" data-aos="fade-up">Testimoni Pelanggan</h2>

  <div class="swiper testiSwiper" data-aos="fade-up">
    <div class="swiper-wrapper">
      <?php
      $testi = [
        ["Bunganya segar dan rapi","Rina — Jakarta"],
        ["Pelayanan ramah","Andi — Bandung"],
        ["Pesan pagi sore sampai","Sari — Surabaya"],
        ["Harga terjangkau kualitas premium","Dwi — Yogyakarta"],
        ["Bunga tahan lama","Budi — Malang"]
      ];
      foreach($testi as $t):
      ?>
      <div class="swiper-slide">
        <div class="testimonial-card">
          <p class="testimonial-text">
            <i class="fa-solid fa-quote-left"></i> <?= $t[0]; ?>
          </p>
          <span class="testimonial-name"><?= $t[1]; ?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({ duration:800, once:true });

new Swiper(".kategoriSwiper",{
  slidesPerView:1.2,
  spaceBetween:16,
  pagination:{ el:".kategoriSwiper .swiper-pagination", clickable:true },
  breakpoints:{768:{slidesPerView:3},1024:{slidesPerView:4}}
});

new Swiper(".testiSwiper",{
  slidesPerView:1.1,
  spaceBetween:18,
  loop:true,
  autoplay:{delay:3000},
  pagination:{ el:".testiSwiper .swiper-pagination", clickable:true },
  breakpoints:{768:{slidesPerView:2},1024:{slidesPerView:3}}
});
</script>

<?php include '../includes/footer.php'; ?>
