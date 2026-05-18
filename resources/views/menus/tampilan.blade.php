@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-utensils text-primary me-2"></i> Daftar Menu Makanan
        </h2>
    </div>

    <!-- Action & Filter Bar (Slack/Stripe Style Action Row) -->
    <div class="card shadow-sm border-0 p-3 mb-4" style="border-radius: 16px; background: #ffffff;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <!-- Search bar -->
            <form action="{{ route('menus.tampilan') }}" method="GET" class="d-flex w-100" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 50px 0 0 50px; padding-left: 20px;">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-1" style="border-radius: 0 50px 50px 0; font-size: 0.88rem;" 
                        placeholder="Cari menu makanan..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 50px !important; margin-left: 8px;">Cari</button>
                </div>
            </form>

            <!-- Add Menu Button -->
            <a href="{{ route('menus.create') }}" class="btn btn-success btn-sm px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.88rem; font-weight: 600;">
                <i class="fas fa-plus me-1.5"></i> Tambah Menu Baru
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

    @if (isset($menus) && $menus->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada menu yang ditemukan untuk pencarian <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Catalog Catalog Card Grid -->
    @if (isset($menus) && count($menus) > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4 mt-2">
            @foreach ($menus as $menu)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm d-flex flex-column" 
                         style="background: #ffffff; cursor: pointer; transition: all 0.3s ease; border: 1px solid rgba(0,0,0,0.02) !important; border-radius: 24px !important; overflow: hidden !important; position: relative !important;"
                         data-bs-toggle="modal" data-bs-target="#menuModal{{ $menu->id }}">
                        
                        <!-- Image Container with Aspect Ratio -->
                        <div class="ratio ratio-1x1 bg-light position-relative" style="border-top-left-radius: 24px !important; border-top-right-radius: 24px !important; overflow: hidden !important; -webkit-transform: translateZ(0) !important; transform: translateZ(0) !important;">
                            <img src="{{ url('storage/images/' . $menu->foto) }}" class="card-img-top img-fluid" alt="Menu Image" style="object-fit: cover; border-top-left-radius: 24px !important; border-top-right-radius: 24px !important; border-bottom-left-radius: 0 !important; border-bottom-right-radius: 0 !important;">
                        </div>

                        <!-- Card Body Content -->
                        <div class="card-body d-flex flex-column p-3">
                            <h5 class="card-title fw-bold text-dark text-truncate mb-1" style="font-size: 0.95rem;" title="{{ $menu->nama }}">
                                {{ $menu->nama }}
                            </h5>
                            
                            <!-- Menu Description truncated -->
                            <p class="card-text text-muted small text-truncate-2 mb-3" style="font-size: 0.78rem; min-height: 2.2rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.4;">
                                {{ $menu->deskripsi ?: 'Tidak ada deskripsi tersedia untuk menu makanan ini.' }}
                            </p>

                            <!-- Price Tag capsule -->
                            <div class="d-flex align-items-center justify-content-between mt-auto pt-2 border-top">
                                <span class="fw-bold text-primary" style="font-size: 0.95rem;">
                                    Rp {{ number_format(floatval(str_replace('.', '', $menu->harga)), 0, ',', '.') }}
                                </span>
                                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill" style="font-size: 0.75rem; font-weight: 700; padding: 4px 12px !important;" onclick="event.stopPropagation();">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Premium Detail Modal -->
                <div class="modal fade" id="menuModal{{ $menu->id }}" tabindex="-1" aria-labelledby="menuModalLabel{{ $menu->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 border-0 shadow-lg">
                            <div class="modal-header border-0 bg-light p-3 px-4">
                                <h5 class="modal-title fw-bold text-dark" id="menuModalLabel{{ $menu->id }}">
                                    <i class="fas fa-utensils text-primary me-2"></i> Detail Menu Makanan
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-5 text-center">
                                        <div class="shadow-sm rounded-4 overflow-hidden border bg-white" style="max-height: 280px;">
                                            <img src="{{ url('storage/images/' . $menu->foto) }}" class="img-fluid w-100" style="object-fit: cover; max-height: 280px;">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <span class="badge bg-primary mb-2" style="font-size: 0.72rem;">Food & Beverage</span>
                                        <h3 class="fw-extrabold text-dark mb-1" style="font-weight: 800; font-size: 1.6rem;">{{ $menu->nama }}</h3>
                                        <h4 class="fw-bold text-primary mb-3" style="font-size: 1.15rem;">
                                            Rp {{ number_format(floatval(str_replace('.', '', $menu->harga)), 0, ',', '.') }}
                                        </h4>
                                        <div class="border-top pt-3">
                                            <h6 class="fw-bold text-secondary mb-2" style="font-size: 0.85rem;">Deskripsi:</h6>
                                            <p class="text-muted" style="font-size: 0.88rem; line-height: 1.6;">
                                                {{ $menu->deskripsi ?: 'Tidak ada deskripsi tersedia untuk menu makanan ini.' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer border-top-0 bg-light p-3 px-4">
                                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary rounded-pill px-4" style="font-weight: 600; font-size: 0.85rem;">
                                    <i class="fas fa-edit me-1.5"></i> Edit Menu Ini
                                </a>
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" style="font-weight: 600; font-size: 0.85rem;" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Section -->
        @if($menus->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $menus->links() }}
            </div>
        @endif
    @else
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 mt-4" style="background: #ffffff; min-height: 300px; display: flex; align-items: center; justify-content: center;">
            <div class="py-4">
                <div class="icon-circle bg-light text-muted mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                    <i class="fas fa-utensils fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Menu Yang Tersedia</h5>
                <p class="text-muted px-4 mb-4" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Daftar menu makanan kosong. Silakan klik tombol "Tambah Menu Baru" di atas untuk membuat menu makanan pertama Anda.
                </p>
                <a href="{{ route('menus.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-1.5"></i> Tambah Menu Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
