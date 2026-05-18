@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-info-circle text-primary me-2"></i> Pengelolaan Informasi Cafe (Tentang)
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
                        placeholder="Cari artikel tentang..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 50px !important; margin-left: 8px;">Cari</button>
                </div>
            </form>

            <!-- Add Button -->
            <a href="{{ route('tentangs.create') }}" class="btn btn-success btn-sm px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.88rem; font-weight: 600;">
                <i class="fas fa-plus me-1.5"></i> Tambah Informasi
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

    @if (isset($tentangs) && $tentangs->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada informasi tentang yang ditemukan untuk kata kunci <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Cards Grid -->
    @if (isset($tentangs) && count($tentangs) > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($tentangs as $tentang)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm d-flex flex-column p-4" style="border-radius: 20px; background: #ffffff; border: 1px solid rgba(0,0,0,0.01) !important;">
                        <!-- Card Header -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="info-icon-container bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 14px;">
                                <i class="fas fa-file-alt fs-5"></i>
                            </div>
                            <div class="flex-grow-1" style="min-width: 0;">
                                <h5 class="fw-bold text-dark text-truncate mb-0" style="font-size: 1.05rem;" title="{{ $tentang->judul }}">
                                    {{ $tentang->judul }}
                                </h5>
                                <span class="text-muted small" style="font-size: 0.75rem; font-weight: 500;">
                                    <i class="far fa-calendar-alt me-1"></i>{{ is_string($tentang->tanggal) ? \Carbon\Carbon::parse($tentang->tanggal)->format('d M Y') : $tentang->tanggal->format('d M Y') }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Body / Deskripsi -->
                        <div class="card-text text-secondary flex-grow-1 mb-4" style="font-size: 0.86rem; line-height: 1.6; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; min-height: 5.5rem;">
                            {{ $tentang->deskripsi ?: 'Tidak ada deskripsi tersedia untuk artikel informasi ini.' }}
                        </div>

                        <!-- Action Button Card Footer -->
                        <div class="border-top pt-3 mt-auto">
                            <a href="{{ route('tentangs.edit', $tentang) }}" class="btn btn-outline-primary w-100 rounded-pill py-2" style="font-size: 0.8rem; font-weight: 700;">
                                <i class="fas fa-edit me-1.5"></i> Edit Informasi
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($tentangs->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $tentangs->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 mt-4" style="background: #ffffff; min-height: 320px; display: flex; align-items: center; justify-content: center;">
            <div class="py-4">
                <div class="icon-circle bg-light text-muted mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                    <i class="fas fa-file-invoice fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Informasi Tentang Cafe</h5>
                <p class="text-muted px-4 mb-4" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Informasi profil cafe di halaman depan masih kosong. Silakan klik tombol "Tambah Informasi" untuk membuat penjelasan pertama.
                </p>
                <a href="{{ route('tentangs.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-1.5"></i> Tambah Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
