@extends('layouts.main')
@section('title', 'DelCafe - Pengumuman')

@include('layouts.navbar')

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #fafbfc;
    }

    .announcement-section {
        max-width: 800px;
        margin: 0 auto;
    }

    /* Card Wrapper */
    .announcement-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 20px;
        margin-bottom: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
        cursor: pointer;
    }

    .announcement-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(13, 110, 253, 0.07);
        border-color: rgba(13, 110, 253, 0.15);
    }

    /* Header structure */
    .announcement-header {
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        position: relative;
    }

    .announcement-meta {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
    }

    /* Megaphone Badge */
    .announcement-icon-badge {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: rgba(13, 110, 253, 0.08);
        color: #0d6efd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        flex-shrink: 0;
        transition: all 0.3s;
    }

    .announcement-card:hover .announcement-icon-badge {
        background: #0d6efd;
        color: #fff;
    }

    /* Title and Published Date */
    .announcement-info {
        display: flex;
        flex-direction: column;
    }

    .announcement-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #212529;
        margin: 0 0 4px 0;
        transition: color 0.3s;
    }

    .announcement-card:hover .announcement-title {
        color: #0d6efd;
    }

    .announcement-date {
        font-size: 0.8rem;
        color: #8c98a5;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    /* Chevron Icon */
    .announcement-chevron {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f8f9fa;
        color: #495057;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        flex-shrink: 0;
    }

    .announcement-card.active .announcement-chevron {
        transform: rotate(180deg);
        background: #0d6efd;
        color: #fff;
    }

    /* Expanded Content */
    .announcement-content-wrapper {
        max-height: 0;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        background: #fafbfe;
    }

    .announcement-card.active .announcement-content-wrapper {
        max-height: 1000px;
        border-top: 1px solid rgba(0, 0, 0, 0.03);
    }

    .announcement-content-body {
        padding: 24px;
        border-left: 4px solid #0d6efd;
    }

    .announcement-text {
        font-size: 0.95rem;
        line-height: 1.6;
        color: #495057;
        margin-bottom: 15px;
    }

    /* Premium Link Button */
    .announcement-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px solid #dee2e6;
        color: #0d6efd;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none !important;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.02);
        transition: all 0.3s;
    }

    .announcement-action-btn:hover {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.15);
    }

    /* Custom Header title decoration */
    .section-title h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #212529;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        display: inline-block;
        padding-bottom: 15px;
        margin-bottom: 30px;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        display: block;
        width: 60px;
        height: 4px;
        background: #0d6efd;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Empty state styling */
    .empty-announcement-card {
        background: #fff;
        border: 1px dashed #dee2e6;
        border-radius: 24px;
        padding: 50px 30px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.02);
    }

    /* Mobile responsive */
    @media (max-width: 576px) {
        .announcement-header {
            padding: 16px;
        }

        .announcement-icon-badge {
            width: 40px;
            height: 40px;
            font-size: 1.1rem;
            border-radius: 10px;
        }

        .announcement-title {
            font-size: 0.95rem;
        }

        .announcement-content-body {
            padding: 16px;
        }

        .announcement-text {
            font-size: 0.85rem;
        }
    }
</style>

<div class="container pt-5 my-5" data-aos="fade-up">
    <div class="container section-title text-center" data-aos="fade-up">
        <br>
        <h2>Pengumuman</h2>
    </div>

    @if(isset($pengumumans) && count($pengumumans) > 0)
    <div class="announcement-section px-3" data-aos="fade-up" data-aos-delay="200">
        @foreach ($pengumumans as $index => $pengumuman)
        <div class="announcement-card {{ $loop->first ? 'active' : '' }}">
            <div class="announcement-header">
                <div class="announcement-meta">
                    <div class="announcement-icon-badge">
                        <i class="bi bi-megaphone-fill"></i>
                    </div>
                    <div class="announcement-info">
                        <h3 class="announcement-title">{{ $pengumuman->judul }}</h3>
                        <div class="announcement-date">
                            <i class="bi bi-calendar3"></i>
                            Dipublikasikan pada {{ date('d-m-Y', strtotime($pengumuman->tanggal)) }}
                        </div>
                    </div>
                </div>
                <div class="announcement-chevron">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </div>
            <div class="announcement-content-wrapper">
                <div class="announcement-content-body">
                    <p class="announcement-text">{{ $pengumuman->teks }}</p>
                    @if ($pengumuman->tautan)
                    <a href="{{ $pengumuman->tautan }}" target="_blank" class="announcement-action-btn">
                        <i class="bi bi-link-45deg"></i>
                        Informasi Selengkapnya
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="announcement-section px-3" data-aos="fade-up">
        <div class="empty-announcement-card text-center my-5">
            <i class="bi bi-megaphone text-muted mb-4" style="font-size: 3rem; display: block; color: #6c757d !important; opacity: 0.6;"></i>
            <h5 class="fw-bold text-dark mb-2">Belum Ada Pengumuman</h5>
            <p class="text-muted mb-0">Semua info terbaru cafe kami akan muncul di halaman ini.</p>
        </div>
    </div>
    @endif
</div>

<script>
    document.querySelectorAll('.announcement-card').forEach(item => {
        item.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });
</script>

@include('layouts.footer')
