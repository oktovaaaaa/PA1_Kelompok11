@extends('layouts.main')
@section('title', 'DelCafe - Testimoni')

@section('content')
@include('layouts.navbar')

<br><br>

@auth
@if (auth()->user()->role == 'user')
<div class="text-center mt-5">
    <br>
    <a href="{{ route('testimoni.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Testimoni
    </a>
</div>
@endif
<br>
@if (session('success'))
    <div class="container mt-4 d-flex justify-content-center">
        <div class="alert alert-success-premium alert-dismissible fade show d-flex align-items-center" role="alert" id="successAlert">
            <div class="alert-icon-wrapper me-3">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="alert-message-content">
                <strong class="alert-title">Berhasil!</strong>
                <span class="alert-text">{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close-premium" data-bs-dismiss="alert" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <style>
        .alert-success-premium {
            background: #ecfdf5;
            border: 1.5px solid #a7f3d0;
            border-radius: 16px;
            padding: 16px 24px;
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.08);
            width: 100%;
            max-width: 500px;
            position: relative;
            animation: slideDownFade 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            transition: all 0.3s ease;
        }

        .alert-icon-wrapper {
            font-size: 24px;
            color: #10b981;
            display: flex;
            align-items: center;
        }

        .alert-message-content {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .alert-title {
            color: #065f46;
            font-weight: 700;
            font-size: 0.95rem;
            margin-bottom: 2px;
        }

        .alert-text {
            color: #047857;
            font-size: 0.88rem;
            font-weight: 500;
        }

        .btn-close-premium {
            background: transparent;
            border: none;
            color: #059669;
            font-size: 16px;
            cursor: pointer;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            transition: all 0.2s ease;
            margin-left: 16px;
        }

        .btn-close-premium:hover {
            background: rgba(16, 185, 129, 0.1);
            color: #047857;
        }

        @keyframes slideDownFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const alertEl = document.getElementById('successAlert');
            if (alertEl) {
                setTimeout(() => {
                    alertEl.style.opacity = '0';
                    alertEl.style.transform = 'translateY(-10px)';
                    setTimeout(() => {
                        alertEl.remove();
                    }, 300);
                }, 4000);
            }
        });
    </script>
@endif
@else
    <div class="alert alert-info text-center pt-5 ">
        <p>Login terlebih dahulu jika ingin menambahkan ulasan.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Login
        </a>
    </div>
@endauth

<section id="testimonials" class="testimonials section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>Testimoni</h2>
        <p>Apa kata mereka tentang kami?</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        @if(isset($testimonis) && count($testimonis) > 0)
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
                }
            }
            </script>
            <div class="swiper-wrapper">
                @foreach ($testimonis as $testimoni)
                <div class="swiper-slide">
                    <div class="testimonial-item position-relative">
                        @auth
                        @if (auth()->user()->role == 'user' && auth()->user()->id == $testimoni->user_id)
                        <div class="dropdown" style="position: absolute; top: 10px; right: 10px;">
                            <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton{{ $testimoni->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton{{ $testimoni->id }}">
                                <li><a class="dropdown-item" href="{{ route('testimoni.edit', $testimoni->id) }}"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                <li>
                                    <form action="{{ route('testimoni.destroy', $testimoni->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item"><i class="fas fa-trash me-2"></i>Hapus</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endif
                        @endauth

                        <div style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; margin: 0 auto;">
                            @if($testimoni->user && $testimoni->user->profile_picture)
                                <img src="{{ asset('storage/' . $testimoni->user->profile_picture) }}" class="testimonial-img" alt="Foto Profil {{ $testimoni->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <img src="{{ asset('assets/img/profil.jpg') }}" class="testimonial-img" alt="Foto Profil {{ $testimoni->nama }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @endif
                        </div>

                        <h3>{{ $testimoni->nama }}</h3>
                        <h4>Pengguna Layanan</h4>
                        <div class="stars">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $testimoni->rating)
                                    <i class="bi bi-star-fill"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>{{ $testimoni->deskripsi }}</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
        @else
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 300px;">
            <div class="text-center py-5">
                <i class="fas fa-comments fa-3x text-secondary mb-4"></i>
                <h5 class="fw-medium text-secondary">Belum ada testimoni tersedia</h5>
                <p class="text-muted">Jadilah yang pertama memberikan pendapat tentang layanan kami</p>
            </div>
        </div>
        @endif

    </div>
</section>

@include('layouts.footer')

<!-- Swiper Library -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<!-- Inisialisasi Swiper -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.init-swiper').forEach(swiperEl => {
            const configEl = swiperEl.querySelector('.swiper-config');
            const config = JSON.parse(configEl.textContent);
            new Swiper(swiperEl, config);
        });
    });
</script>
@endsection
