@extends('layouts.main')
@section('title', 'DelCafe - Edit Testimoni')

@section('content')
@include('layouts.navbar')

<div class="testimoni-section-wrapper">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="testimoni-card-container">
            <!-- Premium Card -->
            <div class="testimoni-card">
                <div class="testimoni-header text-center">
                    <div class="quote-icon-box">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h3>Edit Testimoni</h3>
                    <p class="text-muted small mb-0">Perbarui ulasan Anda untuk meningkatkan layanan kami</p>
                </div>

                <form action="{{ route('testimoni.update', $testimoni->id) }}" method="POST" id="testimoniForm" class="mt-3">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div class="alert alert-danger py-2 px-3 rounded-3 mb-2" style="font-size: 0.85rem;">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>Periksa rating anda!</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Interactive Stars Group -->
                    <div class="rating-group text-center mb-3">
                        <label class="rating-label mb-1">Ubah Rating Anda</label>
                        <div class="rating-stars d-flex justify-content-center gap-2">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star star" data-rating="{{ $i }}"></i>
                            @endfor
                        </div>
                        <span class="rating-text mt-1 d-block text-muted" id="ratingDesc">Pilih bintang</span>
                    </div>

                    <!-- Description Input -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold text-dark mb-1">Ulasan / Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" placeholder="Tuliskan pengalaman kuliner Anda di sini..." required>{{ $testimoni->deskripsi }}</textarea>
                    </div>

                    <input type="hidden" name="rating" id="rating" value="{{ $testimoni->rating }}">

                    <!-- Action Buttons -->
                    <div class="d-flex flex-column gap-2 mt-3">
                        <button type="submit" class="btn btn-primary-premium btn-submit">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('testimoni.index') }}" class="btn btn-outline-secondary btn-cancel">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .testimoni-section-wrapper {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding-top: 90px;
        padding-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .testimoni-card-container {
        width: 100%;
        max-width: 480px;
    }

    .testimoni-card {
        background: #ffffff;
        border: none;
        border-radius: 20px;
        padding: 24px 30px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .testimoni-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.08);
    }

    .quote-icon-box {
        width: 48px;
        height: 48px;
        background: rgba(59, 130, 246, 0.08);
        color: #3b82f6;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin: 0 auto 12px auto;
    }

    .testimoni-header h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: 700;
        font-size: 1.35rem;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .testimoni-header p {
        font-size: 0.85rem;
    }

    .rating-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .rating-stars .star {
        font-size: 26px;
        color: #cbd5e1;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .rating-stars .star.active {
        color: #ffc107;
        text-shadow: 0 0 8px rgba(255, 193, 7, 0.3);
    }

    .rating-stars .star.hover {
        color: #ffe082;
        transform: scale(1.1);
    }

    .rating-text {
        font-size: 0.82rem;
        font-weight: 500;
        min-height: 18px;
    }

    .form-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
    }

    .form-control {
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 12px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        resize: none;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        outline: none;
    }

    .btn-primary-premium {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: #ffffff;
        font-weight: 600;
        border: none;
        border-radius: 12px;
        padding: 10px 20px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.15);
    }

    .btn-primary-premium:hover {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        box-shadow: 0 6px 15px rgba(59, 130, 246, 0.25);
        transform: translateY(-1px);
        color: #ffffff;
    }

    .btn-outline-secondary {
        border: 1.5px solid #cbd5e1;
        background: transparent;
        color: #64748b;
        font-weight: 600;
        border-radius: 12px;
        padding: 10px 20px;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .btn-outline-secondary:hover {
        background: #f8fafc;
        border-color: #94a3b8;
        color: #334155;
    }

    /* Support small desktop heights */
    @media (max-height: 700px) {
        .testimoni-section-wrapper {
            padding-top: 80px;
            overflow-y: auto;
        }
        .testimoni-card {
            padding: 18px 24px;
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const stars = document.querySelectorAll('.rating-stars .star');
        const ratingInput = document.querySelector('#rating');
        const ratingDesc = document.querySelector('#ratingDesc');
        const form = document.querySelector("#testimoniForm");

        const ratingTextMap = {
            1: "Buruk",
            2: "Cukup Baik",
            3: "Bagus / Memuaskan",
            4: "Sangat Bagus",
            5: "Luar Biasa Sempurna"
        };

        // Prepopulate based on existing rating
        const initialRating = parseInt(ratingInput.value);
        if (initialRating > 0) {
            updateStars(initialRating);
            ratingDesc.textContent = ratingTextMap[initialRating];
            ratingDesc.style.color = "#ffc107";
            ratingDesc.style.fontWeight = "600";
        }

        // Star click handler
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const ratingValue = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = ratingValue;
                ratingDesc.textContent = ratingTextMap[ratingValue];
                ratingDesc.style.color = "#ffc107";
                ratingDesc.style.fontWeight = "600";

                updateStars(ratingValue);
            });

            // Star hover effect
            star.addEventListener('mouseenter', function() {
                const ratingValue = parseInt(this.getAttribute('data-rating'));
                highlightStars(ratingValue);
            });

            star.addEventListener('mouseleave', function() {
                const currentRating = parseInt(ratingInput.value);
                updateStars(currentRating);
            });
        });

        function updateStars(rating) {
            stars.forEach(s => {
                const val = parseInt(s.getAttribute('data-rating'));
                if (val <= rating) {
                    s.classList.add('active');
                } else {
                    s.classList.remove('active');
                }
                s.classList.remove('hover');
            });
        }

        function highlightStars(rating) {
            stars.forEach(s => {
                const val = parseInt(s.getAttribute('data-rating'));
                if (val <= rating) {
                    s.classList.add('hover');
                } else {
                    s.classList.remove('hover');
                }
            });
        }

        form.addEventListener("submit", function(event) {
            if (ratingInput.value === "0") {
                alert("Silakan beri rating sebelum mengirim testimoni.");
                event.preventDefault();
            }
        });
    });
</script>
@endsection
