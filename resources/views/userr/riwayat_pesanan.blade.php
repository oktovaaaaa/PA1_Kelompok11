@extends('layouts.main')
@section('title', 'DelCafe - Riwayat')

@include('layouts.navbar')

<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="history-page-section">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-11 col-xl-10">
                <div class="card history-card p-3 p-md-4">
                    
                    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3 flex-wrap gap-2">
                        <h2 class="history-title mb-0">
                            <i class="fas fa-history text-primary me-2"></i> Riwayat Pesanan
                        </h2>
                        <span class="badge bg-primary px-3 py-2 rounded-pill" style="font-size: 0.8rem; font-weight: 600;">
                            Total: {{ count($riwayatPesanan) }} Pesanan
                        </span>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 500; padding: 10px 15px;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 12px;"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="border-radius: 12px; font-weight: 500; padding: 10px 15px;">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 12px;"></button>
                        </div>
                    @endif

                    @if(count($riwayatPesanan) > 0)
                        <!-- Order Card Timeline List -->
                        <div class="order-timeline-list d-flex flex-column gap-4">
                            @foreach($riwayatPesanan as $pesanan)
                                <div class="card order-card">
                                    <!-- Order Header -->
                                    <div class="card-header d-flex justify-content-between align-items-center bg-white border-0 py-3 px-4">
                                        <div class="d-flex align-items-center">
                                            <div class="order-calendar-icon me-3">
                                                <i class="far fa-calendar-alt text-primary"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.95rem;">
                                                    {{ \Carbon\Carbon::parse($pesanan->created_at)->timezone('Asia/Jakarta')->format('d M Y') }}
                                                </h6>
                                                <span class="text-muted small" style="font-size: 0.75rem; font-weight: 500;">
                                                    Pukul {{ \Carbon\Carbon::parse($pesanan->created_at)->timezone('Asia/Jakarta')->format('H:i') }} WIB
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div>
                                            @if($pesanan->status == 'menunggu')
                                                <span class="badge-status badge-status-menunggu">
                                                    <i class="fas fa-spinner fa-spin me-1.5"></i> Menunggu Konfirmasi
                                                </span>
                                            @elseif($pesanan->status == 'berhasil')
                                                <span class="badge-status badge-status-berhasil">
                                                    <i class="fas fa-check-circle me-1.5"></i> Pesanan Selesai
                                                </span>
                                            @elseif($pesanan->status == 'ditolak')
                                                <span class="badge-status badge-status-ditolak">
                                                    <i class="fas fa-times-circle me-1.5"></i> Pesanan Ditolak
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Order Body -->
                                    <div class="card-body px-4 py-3 bg-light-subtle" style="border-top: 1px solid rgba(0,0,0,0.03); border-bottom: 1px solid rgba(0,0,0,0.03);">
                                        <div class="row align-items-center g-3">
                                            <div class="col-md-8">
                                                <div class="d-flex flex-column gap-3">
                                                    @foreach(json_decode($pesanan->daftar_menu, true) as $menu)
                                                        @php
                                                            $menuItem = \App\Models\Menu::where('nama', $menu['nama'])->first();
                                                        @endphp
                                                        <div class="d-flex align-items-center gap-3">
                                                            <div class="order-item-img-wrapper">
                                                                @if($menuItem && $menuItem->foto)
                                                                    <img src="{{ url('storage/images/' . $menuItem->foto) }}" alt="{{ $menu['nama'] }}" class="order-item-img">
                                                                @else
                                                                    <div class="order-item-img-placeholder">
                                                                        <i class="fas fa-utensils text-muted"></i>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <h6 class="mb-0 fw-bold text-dark" style="font-size: 0.92rem;">{{ $menu['nama'] }}</h6>
                                                                    <span class="text-muted small fw-medium" style="font-size: 0.85rem;">
                                                                        Rp {{ number_format($menu['harga_satuan'], 0, ',', '.') }}
                                                                    </span>
                                                                </div>
                                                                <div class="d-flex align-items-center justify-content-between mt-1">
                                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-0.5 rounded" style="font-size: 0.72rem; font-weight: 700;">
                                                                        {{ $menu['jumlah'] }} Porsi
                                                                    </span>
                                                                    <span class="fw-bold text-dark small" style="font-size: 0.85rem;">
                                                                        Subtotal: Rp {{ number_format($menu['jumlah'] * $menu['harga_satuan'], 0, ',', '.') }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 text-md-end border-start-md">
                                                <div class="ps-md-4 py-2">
                                                    <span class="text-muted small d-block mb-1 fw-bold" style="font-size: 0.75rem; letter-spacing: 0.5px;">TOTAL PEMBAYARAN</span>
                                                    <span class="total-price-large">
                                                        Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Order Footer -->
                                    <div class="card-footer d-flex justify-content-end align-items-center bg-white border-0 py-3 px-4">
                                        <form action="{{ route('userr.hapusRiwayatPesanan', $pesanan->id) }}" method="POST" class="delete-history-form mb-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete-history-card" title="Hapus dari Riwayat">
                                                <i class="fas fa-trash-alt me-1.5"></i> Hapus dari Riwayat
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Empty History State -->
                        <div class="text-center py-5 my-3 d-flex flex-column align-items-center justify-content-center">
                            <div class="empty-history-container mb-4">
                                <i class="fas fa-history fa-5x text-muted opacity-25"></i>
                                <span class="empty-badge"><i class="fas fa-clock"></i></span>
                            </div>
                            <h4 class="text-muted fw-bold mb-2">Belum Ada Riwayat Pesanan</h4>
                            <p class="text-muted small mb-4" style="max-width: 320px;">Anda belum melakukan pemesanan apapun. Silakan nikmati menu lezat kami sekarang.</p>
                            <a href="{{ route('userr.menu') }}" class="btn-view-menu py-2.5 px-4">
                                <i class="fas fa-utensils me-2"></i> Pesan Sekarang !
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert2 Library CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intercept Delete History Item forms with SweetAlert2
        document.querySelectorAll('.delete-history-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Stop standard submit
                
                Swal.fire({
                    title: 'Hapus Riwayat?',
                    text: 'Apakah Anda yakin ingin menghapus catatan pesanan ini dari riwayat?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    customClass: {
                        popup: 'swal2-premium-popup',
                        title: 'swal2-premium-title',
                        confirmButton: 'swal2-premium-confirm-btn btn-danger-swal',
                        cancelButton: 'swal2-premium-cancel-btn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Perform form deletion submission
                    }
                });
            });
        });
    });
</script>

<style>
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background-color: #f8fafc !important; /* Sleek light off-white background */
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .history-page-section {
        position: relative !important;
        background: #f8fafc !important;
        min-height: calc(100vh - 120px);
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 120px !important;
        padding-bottom: 80px !important;
    }

    .history-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.03); /* Modern soft drop shadow */
        overflow: hidden;
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .history-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e3c72;
        display: flex;
        align-items: center;
    }

    /* Order Card Design */
    .order-card {
        background: #ffffff !important;
        border: 1px solid rgba(0, 0, 0, 0.05) !important;
        border-radius: 20px !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.02) !important;
        transition: all 0.25s ease !important;
        overflow: hidden !important;
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.05) !important;
        border-color: rgba(13, 110, 253, 0.1) !important;
    }

    .order-calendar-icon {
        background: rgba(13, 110, 253, 0.06);
        border-radius: 12px;
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    /* Order Item Thumbnail */
    .order-item-img-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.05);
        background: #f8fafc;
        flex-shrink: 0;
    }

    .order-item-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .order-item-img-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        background: rgba(13, 110, 253, 0.03);
    }

    .total-price-large {
        font-size: 1.25rem;
        font-weight: 800;
        color: #0d6efd;
        letter-spacing: -0.5px;
        display: block;
    }

    @media (min-width: 768px) {
        .border-start-md {
            border-left: 1px dashed rgba(0, 0, 0, 0.08) !important;
        }
    }

    /* Status Pill Badges */
    .badge-status {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 50px;
        text-transform: capitalize;
    }

    .badge-status-menunggu {
        background-color: rgba(255, 193, 7, 0.12) !important;
        color: #b27b00 !important;
        border: 1.5px solid rgba(255, 193, 7, 0.25);
    }

    .badge-status-berhasil {
        background-color: rgba(32, 201, 151, 0.12) !important;
        color: #157e5d !important;
        border: 1.5px solid rgba(32, 201, 151, 0.25);
    }

    .badge-status-ditolak {
        background-color: rgba(220, 53, 69, 0.12) !important;
        color: #a91e2c !important;
        border: 1.5px solid rgba(220, 53, 69, 0.25);
    }

    /* Action Delete Button */
    .btn-delete-history-card {
        background: transparent;
        border: 1.5px solid rgba(220, 53, 69, 0.15);
        color: #dc3545;
        border-radius: 50px;
        padding: 6px 16px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.2s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
    }

    .btn-delete-history-card:hover {
        background: rgba(220, 53, 69, 0.05);
        border-color: #dc3545;
    }

    /* Empty History Styling */
    .empty-history-container {
        position: relative;
        display: inline-block;
    }

    .empty-badge {
        position: absolute;
        bottom: 2px;
        right: -4px;
        background-color: #6c757d;
        color: #ffffff;
        border-radius: 50%;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        border: 2px solid #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-view-menu {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%);
        color: #ffffff;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.88rem;
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-view-menu:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        color: #ffffff;
    }

    /* Custom SweetAlert2 Theme */
    .swal2-premium-popup {
        border-radius: 20px !important;
        padding: 24px !important;
    }

    .swal2-premium-title {
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        color: #1e3c72 !important;
    }

    .swal2-premium-confirm-btn {
        border-radius: 50px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
    }

    .btn-danger-swal {
        background-color: #dc3545 !important;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25) !important;
    }

    .swal2-premium-cancel-btn {
        border-radius: 50px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        background-color: #6c757d !important;
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.25) !important;
    }

    /* Custom Primary Subtitle badges for Menu items list */
    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.08) !important;
    }
    .text-primary {
        color: #0d6efd !important;
    }
    .border-primary-subtle {
        border-color: rgba(13, 110, 253, 0.15) !important;
    }
</style>

@include('layouts.footer')
