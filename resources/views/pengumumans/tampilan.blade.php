@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-bullhorn text-primary me-2"></i> Pengelolaan Pengumuman & Berita
        </h2>
    </div>

    <!-- Action & Filter Bar (Stripe Style) -->
    <div class="card shadow-sm border-0 p-3 mb-4" style="border-radius: 16px; background: #ffffff;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <!-- Search Form -->
            <form action="" method="GET" class="d-flex w-100" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 50px 0 0 50px; padding-left: 20px;">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-1" style="border-radius: 0 50px 50px 0; font-size: 0.88rem;" 
                        placeholder="Cari judul pengumuman..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 50px !important; margin-left: 8px;">Cari</button>
                </div>
            </form>

            <!-- Add Button -->
            <a href="{{ route('pengumumans.create') }}" class="btn btn-success btn-sm px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.88rem; font-weight: 600;">
                <i class="fas fa-plus me-1.5"></i> Tambah Pengumuman
            </a>
        </div>
    </div>

    <!-- Alerts Notification -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle fs-5 me-2.5 text-success"></i>
            <div class="fw-semibold text-success-emphasis">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (isset($pengumumans) && $pengumumans->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada pengumuman yang ditemukan untuk kata kunci <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Cards Grid -->
    @if (isset($pengumumans) && count($pengumumans) > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($pengumumans as $pengumuman)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm d-flex flex-column p-4" style="border-radius: 20px; background: #ffffff; border: 1px solid rgba(0,0,0,0.01) !important;">
                        <!-- Card Header -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="info-icon-container bg-warning bg-opacity-10 text-warning d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 14px;">
                                <i class="fas fa-bullhorn fs-5 text-warning"></i>
                            </div>
                            <div class="flex-grow-1" style="min-width: 0;">
                                <h5 class="fw-bold text-dark text-truncate mb-0" style="font-size: 1.05rem;" title="{{ $pengumuman->judul }}">
                                    {{ $pengumuman->judul }}
                                </h5>
                                <span class="text-muted small" style="font-size: 0.75rem; font-weight: 500;">
                                    <i class="far fa-calendar-alt me-1"></i>{{ is_string($pengumuman->tanggal) ? \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') : $pengumuman->tanggal->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body / Deskripsi -->
                        <div class="card-text text-secondary flex-grow-1 mb-3" style="font-size: 0.86rem; line-height: 1.6; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; min-height: 5.5rem;">
                            {{ $pengumuman->teks ?: 'Tidak ada deskripsi tersedia untuk artikel informasi ini.' }}
                        </div>

                        <!-- Tautan Link badge (if exists) -->
                        @if($pengumuman->tautan)
                            <div class="mb-3">
                                <a href="{{ $pengumuman->tautan }}" target="_blank" class="badge bg-light text-primary px-3 py-2 rounded-pill fw-bold text-decoration-none" style="font-size: 0.76rem; border: 1px solid rgba(13, 110, 253, 0.1);">
                                    <i class="fas fa-external-link-alt me-1.5"></i> Kunjungi Tautan
                                </a>
                            </div>
                        @endif

                        <!-- Action Button Card Footer -->
                        <div class="border-top pt-3 mt-auto">
                            <a href="{{ route('pengumumans.edit', $pengumuman) }}" class="btn btn-outline-primary w-100 rounded-pill py-2" style="font-size: 0.8rem; font-weight: 700;">
                                <i class="fas fa-edit me-1.5"></i> Edit Pengumuman
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($pengumumans->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $pengumumans->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 mt-4" style="background: #ffffff; min-height: 320px; display: flex; align-items: center; justify-content: center;">
            <div class="py-4">
                <div class="icon-circle bg-light text-muted mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                    <i class="fas fa-bullhorn fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Pengumuman Aktif</h5>
                <p class="text-muted px-4 mb-4" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Berita dan pengumuman cafe masih kosong. Silakan buat pengumuman baru untuk mengabarkan diskon atau info penting ke customer.
                </p>
                <a href="{{ route('pengumumans.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-1.5"></i> Tambah Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
