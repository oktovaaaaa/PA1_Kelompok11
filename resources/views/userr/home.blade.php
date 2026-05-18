@extends('layouts.main')
@section('title', 'DelCafe - Beranda')

@include('layouts.navbar')

<style>
/* Reset and global styles specifically for home */
#hero {
  position: relative !important;
  background: linear-gradient(135deg, rgba(10, 25, 47, 0.92) 0%, rgba(20, 45, 85, 0.85) 100%), url("{{ asset('assets/img/delcafe.jpg') }}") no-repeat center center/cover !important;
  background-attachment: fixed !important;
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding: 120px 0 80px 0 !important;
  overflow: hidden;
}

.hero-content {
  z-index: 3;
}

.hero-content h1 {
  font-family: 'Poppins', sans-serif !important;
  font-size: 3.2rem !important;
  font-weight: 800 !important;
  line-height: 1.2 !important;
  color: #ffffff !important;
  margin-bottom: 20px !important;
  letter-spacing: -0.5px !important;
}

.hero-content h1 .text-highlight {
  background: linear-gradient(120deg, #0d6efd 0%, #20c997 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  display: inline-block;
}

.hero-content p {
  font-size: 1.15rem !important;
  color: rgba(255, 255, 255, 0.8) !important;
  margin-bottom: 35px !important;
  line-height: 1.6 !important;
}

.btn-premium-hero {
  background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
  border: none !important;
  color: #ffffff !important;
  border-radius: 50px !important;
  padding: 14px 32px !important;
  font-weight: 600 !important;
  font-size: 0.95rem !important;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
  box-shadow: 0 4px 15px rgba(13, 110, 253, 0.35) !important;
  text-decoration: none !important;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.btn-premium-hero:hover {
  box-shadow: 0 8px 25px rgba(13, 110, 253, 0.55) !important;
  transform: translateY(-3px) !important;
  color: #ffffff !important;
}

.btn-watch-premium {
  background: rgba(255, 255, 255, 0.08) !important;
  border: 1px solid rgba(255, 255, 255, 0.2) !important;
  color: #ffffff !important;
  border-radius: 50px !important;
  padding: 14px 30px !important;
  font-weight: 600 !important;
  font-size: 0.95rem !important;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
  backdrop-filter: blur(8px) !important;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  margin-left: 15px;
  text-decoration: none !important;
}

.btn-watch-premium:hover {
  background: rgba(255, 255, 255, 0.18) !important;
  border-color: rgba(255, 255, 255, 0.4) !important;
  transform: translateY(-3px) !important;
  color: #ffffff !important;
}

.btn-watch-premium i {
  font-size: 1.35rem;
  color: #20c997;
  transition: transform 0.3s;
}

.btn-watch-premium:hover i {
  transform: scale(1.15);
}

/* Right Side Illustration Wrapper */
.hero-image-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.hero-logo-img {
  z-index: 2;
  max-width: 75%;
  height: auto;
  animation: floatLogo 6s ease-in-out infinite;
  filter: drop-shadow(0 15px 35px rgba(0, 0, 0, 0.25));
}

.glowing-circle {
  position: absolute;
  width: 320px;
  height: 320px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(13, 110, 253, 0.22) 0%, rgba(32, 201, 151, 0.05) 60%, transparent 80%);
  filter: blur(50px);
  z-index: 1;
  animation: pulseGlow 5s ease-in-out infinite;
}

@keyframes floatLogo {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-12px); }
}

@keyframes pulseGlow {
  0%, 100% { transform: scale(0.9); opacity: 0.65; }
  50% { transform: scale(1.15); opacity: 0.9; }
}

/* Sponsor slider styling */
#clients {
  background: #ffffff !important;
  padding: 50px 0 !important;
  border-bottom: 1px solid rgba(0, 0, 0, 0.04);
}

.swiper-slide {
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s;
}

.swiper-slide img {
  filter: grayscale(100%) opacity(0.55);
  transition: all 0.4s ease;
  max-height: 50px !important;
  width: auto !important;
}

.swiper-slide:hover img {
  filter: grayscale(0%) opacity(1);
  transform: scale(1.08);
}

/* Call To Action Upgrade */
.call-to-action {
  position: relative;
  padding: 100px 0 !important;
  background: linear-gradient(135deg, rgba(10, 25, 47, 0.88) 0%, rgba(20, 45, 85, 0.8) 100%) !important;
}

.call-to-action .cta-background img {
  filter: brightness(0.25) !important;
  object-position: center !important;
}

.cta-btn {
  background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
  border: none !important;
  color: #ffffff !important;
  padding: 14px 36px !important;
  border-radius: 50px !important;
  font-weight: 600 !important;
  box-shadow: 0 4px 15px rgba(13, 110, 253, 0.35) !important;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
  text-decoration: none !important;
  display: inline-block;
}

.cta-btn:hover {
  box-shadow: 0 8px 25px rgba(13, 110, 253, 0.55) !important;
  transform: translateY(-3px) !important;
  color: #ffffff !important;
}

/* Responsiveness */
@media (max-width: 991.98px) {
  #hero {
    padding: 100px 0 60px 0 !important;
    text-align: center;
    min-height: auto !important;
  }
  .hero-content h1 {
    font-size: 2.3rem !important;
  }
  .hero-content p {
    font-size: 1rem !important;
  }
  .glowing-circle {
    width: 250px;
    height: 250px;
  }
  .hero-logo-img {
    max-width: 60%;
  }
  .btn-watch-premium {
    margin-left: 10px;
  }
  .d-flex {
    justify-content: center !important;
  }
}
</style>

<body class="index-page">
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <div class="container hero-content">
        <div class="row gy-4 align-items-center">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
            <h1>Atasi Laparmu Dengan Hidangan Terbaik di <span class="text-highlight">Del Cafe</span></h1>
            <p>Nikmati suasana yang nyaman dan aneka kuliner lezat berkualitas dengan harga yang sangat bersahabat di kantong mahasiswa sekarang!</p>
            <div class="d-flex">
              <a href="{{ route('userr.menu') }}" class="btn-premium-hero">
                Pesan Makanan <i class="fas fa-shopping-cart ms-1"></i>
              </a>
              <a href="https://youtu.be/CX9VSIOWXug?si=mXm4K-bK_M8Hm6_8" class="glightbox btn-watch-premium">
                <i class="fas fa-play-circle"></i><span>Watch Video</span>
              </a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-out" data-aos-delay="200">
            <div class="hero-image-wrapper">
              <div class="glowing-circle"></div>
              <img src="{{ asset('assets/img/logodel.png') }}" class="img-fluid hero-logo-img" alt="Del Cafe Logo">
            </div>
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
                  "spaceBetween": 100
                },
                "1200": {
                  "slidesPerView": 6,
                  "spaceBetween": 100
                }
              }
            }
          </script>

          <style>
            .swiper-slide img {
              width: 100px;
              height: 100px;
              object-fit: contain;
              display: block;
              margin: 0 auto;
            }
          </style>

          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/yayasandel.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/itdel.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/himatif.PNG') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/delcafe.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/toba.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/laravel.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/aistdio.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ asset('assets/img/sponsor/logokt.PNG') }}" class="img-fluid" alt=""></div>
          </div>
        </div>
      </div>
    </section><!-- /Clients Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">
      <div class="cta-background">
        <img src="{{ asset('assets/img/delcafe.jpg') }}" alt="DelCafe">
      </div>
      <div class="container position-relative">
        <div class="row align-items-center" data-aos="zoom-in" data-aos-delay="100">
          <div class="col-xl-9 text-center text-xl-start">
            <h3 class="fw-bold mb-3 text-white">Jelajahi Galeri Del Cafe</h3>
            <p class="text-white-50" style="font-size: 1.05rem; line-height: 1.7;">Tempat di mana setiap tegukan kopi membawa cerita dan setiap hidangan menyajikan kehangatan. Nikmati suasana yang nyaman, aroma kopi yang menggoda, dan cita rasa yang tak terlupakan. Temukan inspirasi dalam setiap sudut, karena di sini, cafe bukan sekadar tempat—melainkan pengalaman.</p>
          </div>
          <div class="col-xl-3 cta-btn-container text-center text-xl-end">
            <a class="cta-btn align-middle" href="{{ route('userr.galeri') }}">Galeri DelCafe <i class="fas fa-arrow-right ms-2"></i></a>
          </div>
        </div>
      </div>
    </section><!-- /Call To Action Section -->

  </main>
  @include('layouts.footer')
</body>
