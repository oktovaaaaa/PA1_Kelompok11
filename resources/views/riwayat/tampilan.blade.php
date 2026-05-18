@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-history text-primary me-2"></i> Riwayat & Kelola Pesanan Customer
        </h2>
    </div>

    <!-- Action & Filter Bar (Stripe Style) -->
    <div class="card shadow-sm border-0 p-3 mb-4" style="border-radius: 16px; background: #ffffff;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <!-- Search Form -->
            <form action="{{ route('riwayat.tampilan') }}" method="GET" class="d-flex w-100" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 50px 0 0 50px; padding-left: 20px;">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-1" style="border-radius: 0 50px 50px 0; font-size: 0.88rem;" 
                        placeholder="Cari ID pesanan atau nama..." value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary btn-sm px-4" style="border-radius: 50px !important; margin-left: 8px;">Cari</button>
                </div>
            </form>
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

    @if (isset($semuaRiwayatPesanan) && $semuaRiwayatPesanan->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada riwayat pesanan yang ditemukan untuk kata kunci <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Main Orders Table Card -->
    @if (isset($semuaRiwayatPesanan) && count($semuaRiwayatPesanan) > 0)
        <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 20px; background: #ffffff;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 1000px;">
                    <thead style="background-color: rgba(59, 130, 246, 0.05);">
                        <tr>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary text-center" style="font-size: 0.85rem; width: 8%;"><i class="fas fa-hashtag text-muted me-1.5"></i>ID</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 18%;"><i class="fas fa-user text-primary me-1.5"></i>Nama Pelanggan</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 28%;"><i class="fas fa-utensils text-success me-1.5"></i>Daftar Menu Pesanan</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 14%;"><i class="fas fa-money-bill-wave text-warning me-1.5"></i>Total Bayar</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-center text-secondary" style="font-size: 0.85rem; width: 12%;"><i class="fas fa-info-circle text-info me-1.5"></i>Status</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 12%;"><i class="far fa-calendar-alt text-muted me-1.5"></i>Waktu Pemesanan</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-center text-secondary" style="font-size: 0.85rem; width: 8%;"><i class="fas fa-cogs text-danger me-1.5"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($semuaRiwayatPesanan as $pesanan)
                            <tr style="transition: background-color 0.2s ease;">
                                <!-- Column 1: Order ID -->
                                <td class="py-3 px-4 text-center fw-bold text-dark" style="font-size: 0.88rem;">
                                    #{{ $pesanan->id }}
                                </td>

                                <!-- Column 2: Customer Name with Avatar -->
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="day-icon-circle bg-light text-primary me-2.5 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; border-radius: 50%; font-weight: 700; font-size: 0.95rem;">
                                            {{ substr($pesanan->user->name, 0, 1) }}
                                        </div>
                                        <span class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $pesanan->user->name }}</span>
                                    </div>
                                </td>

                                <!-- Column 3: Ordered Menu Items Bullet List -->
                                <td class="py-3 px-4">
                                    <ul class="list-unstyled mb-0 d-flex flex-column gap-1.5">
                                        @foreach(json_decode($pesanan->daftar_menu, true) as $menu)
                                            <li class="d-flex align-items-center text-secondary" style="font-size: 0.8rem; font-weight: 500;">
                                                <i class="fas fa-circle text-muted me-2" style="font-size: 0.38rem; opacity: 0.5;"></i>
                                                <span class="fw-bold text-dark me-1">{{ $menu['nama'] }}</span>
                                                <span class="badge bg-light text-muted border px-2 py-0.5 rounded-pill ms-auto" style="font-size: 0.72rem; font-weight: 700;">
                                                    {{ $menu['jumlah'] }}x
                                                </span>
                                                <span class="ms-2 text-muted fw-bold" style="font-size: 0.76rem;">
                                                    Rp{{ number_format($menu['harga_satuan'], 0, ',', '.') }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>

                                <!-- Column 4: Total Price -->
                                <td class="py-3 px-4 fw-bold text-primary" style="font-size: 0.92rem;">
                                    Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                </td>

                                <!-- Column 5: Glowing Translucent Status Badges -->
                                <td class="py-3 px-4 text-center">
                                    @if($pesanan->status == 'menunggu')
                                        <span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 rounded-pill fw-bold" style="font-size: 0.78rem; border: 1px solid rgba(245, 158, 11, 0.15);">
                                            <i class="far fa-clock me-1.5"></i>{{ ucfirst($pesanan->status) }}
                                        </span>
                                    @elseif($pesanan->status == 'berhasil')
                                        <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold" style="font-size: 0.78rem; border: 1px solid rgba(16, 185, 129, 0.15);">
                                            <i class="fas fa-check-circle me-1.5"></i>{{ ucfirst($pesanan->status) }}
                                        </span>
                                    @elseif($pesanan->status == 'ditolak')
                                        <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold" style="font-size: 0.78rem; border: 1px solid rgba(239, 68, 68, 0.15);">
                                            <i class="fas fa-ban me-1.5"></i>{{ ucfirst($pesanan->status) }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill fw-bold" style="font-size: 0.78rem;">
                                            {{ ucfirst($pesanan->status) }}
                                        </span>
                                    @endif
                                </td>

                                <!-- Column 6: Formatted Order Date -->
                                <td class="py-3 px-4 text-secondary" style="font-size: 0.8rem; font-weight: 500;">
                                    <i class="far fa-calendar me-1.5 text-muted"></i>{{ is_string($pesanan->created_at) ? \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') : $pesanan->created_at->format('d M Y, H:i') }} WIB
                                </td>

                                <!-- Column 7: Dual Approval/Reject Action or Delete Trigger -->
                                <td class="py-3 px-4 text-center">
                                    @if($pesanan->status == 'menunggu')
                                        <div class="d-flex justify-content-center gap-1.5">
                                            <form action="{{ route('admin.approveRejectPesanan', $pesanan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="action" value="berhasil">
                                                <button type="submit" class="btn btn-outline-success btn-sm rounded-pill px-2.5 py-1" style="font-size: 0.72rem; font-weight: 700;">
                                                    <i class="fas fa-check me-1"></i> Setuju
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.approveRejectPesanan', $pesanan->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="action" value="ditolak">
                                                <button type="submit" class="btn btn-outline-danger btn-sm rounded-pill px-2.5 py-1" style="font-size: 0.72rem; font-weight: 700;">
                                                    <i class="fas fa-times me-1"></i> Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($pesanan->status == 'berhasil' || $pesanan->status == 'ditolak')
                                        @include('riwayat.delete')
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 mt-4" style="background: #ffffff; min-height: 320px; display: flex; align-items: center; justify-content: center;">
            <div class="py-4">
                <div class="icon-circle bg-light text-muted mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                    <i class="fas fa-history fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Transaksi Pesanan</h5>
                <p class="text-muted px-4 mb-0" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Riwayat pembelian kopi dan menu makanan dari customer DelCafe akan masuk dan diproses dalam tabel transaksi ini secara detail.
                </p>
            </div>
        </div>
    @endif
</div>
@endsection
