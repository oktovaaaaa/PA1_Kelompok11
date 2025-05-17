@extends('layouts.main')
@section('title', 'DelCafe - Beranda')

@include('layouts.navbar')
<style>
.call-to-action {
  position: relative;
  padding: 80px 0;
  color: white;
  overflow: hidden;
}

.call-to-action .cta-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  overflow: hidden;
}

.call-to-action .cta-background img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: brightness(0.4); /* biar teksnya tetap terlihat jelas */
}

.call-to-action .container {
  position: relative;
  z-index: 2;
}


</style>


<body class="index-page">
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Atasi laparmu dengan makan di Del Cafe</h1>
            <p>Nikmati makanan murah dan nikmat sekarang!</p>
            <div class="d-flex">
              <a href="{{ route('userr.menu') }}" class="btn-get-started">Pesan Makanan</a>
              <a href="https://youtu.be/CX9VSIOWXug?si=mXm4K-bK_M8Hm6_8" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/logodel.png" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- Clients Section -->
    <section id="clients" class="clients section light-background">
      <div class="container" data-aos="zoom-in">
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 5,
                  "spaceBetween": 120
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/sponsor/yayasandel.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/itdel.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/himatif.PNG" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/delcafe.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/toba.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/laravel.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/aistdio.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/sponsor/logokt.PNG" class="img-fluid" alt=""></div>
          </div>
        </div>
      </div>
    </section><!-- /Clients Section -->

    <!-- About Section -->
    <section id="about" class="about section">
      <div class="container section-title" data-aos="fade-up">
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            {{-- <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </p> --}}
            <ul>
              {{-- <li><i class="bi bi-check2-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li>
              <li><i class="bi bi-check2-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo</span></li> --}}
            </ul>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            {{-- <p>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </p> --}}
            {{-- <a href="#" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a> --}}
          </div>
        </div>
      </div>
    </section>

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
      <div class="cta-background">
        <img src="assets/img/delcafe.jpg" alt="DelCafe">
      </div>
      <div class="container position-relative">
        <div class="row" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3>Galeri</h3>
            <p>Tempat di mana setiap tegukan kopi membawa cerita dan setiap hidangan menyajikan kehangatan. Nikmati suasana yang nyaman, aroma kopi yang menggoda, dan cita rasa yang tak terlupakan. Temukan inspirasi dalam setiap sudut, karena di sini, cafe bukan sekadar tempat—melainkan pengalaman.</p>
          </div>
          <div class="col-xl-3 cta-btn-container text-center">
            <a class="cta-btn align-middle" href="{{route('userr.galeri')}}">Galeri DelCafe</a>
          </div>
        </div>
      </div>
    </section><!-- /Call To Action Section -->

  </main>
  @include('layouts.footer')
</body>
