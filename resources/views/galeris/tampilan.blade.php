@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-images text-primary me-2"></i> Pengelolaan Galeri Foto DelCafe
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
                        placeholder="Cari galeri foto..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 50px !important; margin-left: 8px;">Cari</button>
                </div>
            </form>

            <!-- Add Button -->
            <a href="{{ route('galeris.create') }}" class="btn btn-success btn-sm px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.88rem; font-weight: 600;">
                <i class="fas fa-plus me-1.5"></i> Tambah Galeri
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

    @if (isset($galeris) && $galeris->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada foto galeri yang ditemukan untuk kata kunci <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Cards Grid -->
    @if (isset($galeris) && count($galeris) > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mt-2">
            @foreach ($galeris as $galeri)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm d-flex flex-column" 
                         style="background: #ffffff; cursor: pointer; transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02) !important; border-radius: 24px !important; overflow: hidden !important; position: relative !important;">
                        
                        <!-- Image Container with Aspect Ratio (Hardware-accelerated clip!) -->
                        <div class="ratio ratio-1x1 bg-light position-relative" style="border-top-left-radius: 24px !important; border-top-right-radius: 24px !important; overflow: hidden !important; -webkit-transform: translateZ(0) !important; transform: translateZ(0) !important;">
                            <img src="{{ asset('storage/images/' . $galeri->foto) }}" class="card-img-top img-fluid" alt="Galeri Foto" style="object-fit: cover; border-top-left-radius: 24px !important; border-top-right-radius: 24px !important; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                        </div>

                        <!-- Card Body Content -->
                        <div class="card-body d-flex flex-column p-3">
                            <h5 class="card-title fw-bold text-dark mb-1" style="font-size: 0.98rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                {{ $galeri->nama }}
                            </h5>
                            <p class="card-text text-secondary mb-3" style="font-size: 0.8rem; line-height: 1.5; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; min-height: 2.4rem;">
                                {{ $galeri->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}
                            </p>
                            
                            <!-- Action Button Card Footer -->
                            <div class="mt-auto border-top pt-2">
                                <a href="{{ route('galeris.edit', $galeri) }}" class="btn btn-outline-primary w-100 rounded-pill py-1.5" style="font-size: 0.76rem; font-weight: 700;">
                                    <i class="fas fa-edit me-1.5"></i> Edit Galeri
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($galeris->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $galeris->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 mt-4" style="background: #ffffff; min-height: 320px; display: flex; align-items: center; justify-content: center;">
            <div class="py-4">
                <div class="icon-circle bg-light text-muted mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                    <i class="fas fa-images fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Galeri Foto Terdaftar</h5>
                <p class="text-muted px-4 mb-4" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Galeri cafe di halaman depan masih kosong. Silakan unggah foto cafe terbaru agar customer tertarik berkunjung.
                </p>
                <a href="{{ route('galeris.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-1.5"></i> Unggah Foto Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
