@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title & Action Button -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-calendar-alt text-primary me-2"></i> Daftar Jadwal Operasional
        </h2>
        <a href="{{ route('jadwals.create') }}" class="btn btn-success btn-sm px-4 py-2 rounded-pill shadow-sm" style="font-size: 0.88rem; font-weight: 600;">
            <i class="fas fa-plus me-1.5"></i> Tambah Jadwal
        </a>
    </div>

    <!-- Alerts Notification -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-check-circle fs-5 me-2.5 text-success"></i>
            <div class="fw-semibold text-success-emphasis">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Main Table Card -->
    @if (isset($jadwals) && count($jadwals) > 0)
        <div class="card shadow-sm border-0 overflow-hidden" style="border-radius: 20px; background: #ffffff;">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" style="min-width: 600px;">
                    <thead style="background-color: rgba(59, 130, 246, 0.05);">
                        <tr>
                            <th scope="col" class="py-3 px-4 fw-bold text-secondary" style="font-size: 0.85rem; width: 30%;"><i class="fas fa-calendar-day me-2 text-primary"></i>Hari Kerja</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-center text-secondary" style="font-size: 0.85rem; width: 25%;"><i class="fas fa-clock me-2 text-success"></i>Jam Mulai</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-center text-secondary" style="font-size: 0.85rem; width: 25%;"><i class="fas fa-stopwatch me-2 text-danger"></i>Jam Selesai</th>
                            <th scope="col" class="py-3 px-4 fw-bold text-center text-secondary" style="font-size: 0.85rem; width: 20%;"><i class="fas fa-cogs me-2 text-warning"></i>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                            <tr style="transition: background-color 0.2s ease;">
                                <td class="py-3 px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="day-icon-circle bg-light text-primary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px; border-radius: 12px; font-weight: 700;">
                                            {{ substr($jadwal->hari, 0, 1) }}
                                        </div>
                                        <span class="fw-bold text-dark" style="font-size: 0.95rem;">{{ $jadwal->hari }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold" style="font-size: 0.82rem; border: 1px solid rgba(59, 130, 246, 0.15);">
                                        <i class="far fa-clock me-1.5"></i>{{ $jadwal->waktu_mulai }} WIB
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <span class="badge bg-danger bg-opacity-10 text-danger px-3 py-2 rounded-pill fw-bold" style="font-size: 0.82rem; border: 1px solid rgba(239, 68, 68, 0.15);">
                                        <i class="far fa-clock me-1.5"></i>{{ $jadwal->waktu_selesai }} WIB
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center">
                                    <a href="{{ route('jadwals.edit', $jadwal) }}" class="btn btn-outline-primary btn-sm px-3 rounded-pill" style="font-size: 0.78rem; font-weight: 700; padding: 5px 15px !important;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
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
                    <i class="fas fa-calendar-times fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Jadwal Yang Terdaftar</h5>
                <p class="text-muted px-4 mb-4" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Jadwal operasional cafe masih kosong. Silakan buat jadwal baru agar customer dapat melihat jam buka DelCafe.
                </p>
                <a href="{{ route('jadwals.create') }}" class="btn btn-primary rounded-pill px-4">
                    <i class="fas fa-plus me-1.5"></i> Tambah Jadwal Pertama
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
