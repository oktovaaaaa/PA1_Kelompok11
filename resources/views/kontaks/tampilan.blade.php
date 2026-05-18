@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-envelope text-primary me-2"></i> Daftar Pesan Masuk (Inbox)
        </h2>
    </div>

    <!-- Action & Filter Bar (Stripe Style) -->
    <div class="card shadow-sm border-0 p-3 mb-4" style="border-radius: 16px; background: #ffffff;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <!-- Search Form -->
            <form action="{{ route('kontaks.tampilan') }}" method="GET" class="d-flex w-100" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 50px 0 0 50px; padding-left: 20px;">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-1" style="border-radius: 0 50px 50px 0; font-size: 0.88rem;" 
                        placeholder="Cari pengirim atau subjek..." value="{{ request('search') }}">
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

    @if (isset($kontaks) && $kontaks->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada pesan yang ditemukan untuk kata kunci <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Main Messages Table Card -->
    @if (isset($kontaks) && count($kontaks) > 0)
        <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 20px; background: #ffffff;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 800px;">
                    <thead style="background-color: rgba(59, 130, 246, 0.05);">
                        <tr>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 25%;"><i class="fas fa-user me-2 text-primary"></i>Pengirim</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 20%;"><i class="fas fa-mail-bulk me-2 text-info"></i>Email</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 18%;"><i class="fas fa-heading me-2 text-warning"></i>Subjek</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 25%;"><i class="fas fa-comment-alt me-2 text-success"></i>Isi Pesan</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-center text-secondary" style="font-size: 0.85rem; width: 12%;"><i class="fas fa-cogs me-2 text-danger"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kontaks as $kontak)
                            <tr style="transition: background-color 0.2s ease;">
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="day-icon-circle bg-light text-primary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 12px; font-weight: 700; font-size: 1.05rem;">
                                            {{ substr($kontak->nama, 0, 1) }}
                                        </div>
                                        <span class="fw-bold text-dark" style="font-size: 0.92rem;">{{ $kontak->nama }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-secondary" style="font-size: 0.85rem;">
                                    <i class="far fa-envelope me-1.5 text-muted"></i>{{ $kontak->email }}
                                </td>
                                <td class="py-3 px-4 text-dark fw-semibold" style="font-size: 0.85rem;">
                                    {{ $kontak->subjek }}
                                </td>
                                <td class="py-3 px-4 text-secondary" style="font-size: 0.85rem; line-height: 1.5; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" title="{{ $kontak->pesan }}">
                                    {{ $kontak->pesan }}
                                </td>
                                <td class="py-3 px-4 text-center">
                                    @include('kontaks.delete')
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
                    <i class="fas fa-envelope fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Pesan Masuk</h5>
                <p class="text-muted px-4 mb-0" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Pesan masukan, saran, atau pertanyaan yang dikirimkan oleh pengunjung lewat halaman kontak DelCafe akan terkumpul lengkap di panel ini.
                </p>
            </div>
        </div>
    @endif
</div>
@endsection
