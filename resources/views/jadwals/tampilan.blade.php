@extends('layouts.mainadmin')
@section('contents')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center py-4">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('tentang.png') }}" class="admin-logo" alt="Admin Logo">
            <h2 class="h4 mb-0 fw-bold text-dark">Manajemen Jadwal</h2>
        </div>
        <a href="{{ route('jadwals.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle me-2"></i>Tambah Jadwal
        </a>
    </div>

    <!-- Alert Section -->
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Content Section -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            @if (isset($jadwals) && count($jadwals) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col" class="text-center"><i class="fas fa-calendar-day me-2"></i>Hari</th>
                                <th scope="col" class="text-center"><i class="fas fa-clock me-2"></i>Mulai</th>
                                <th scope="col" class="text-center"><i class="fas fa-stopwatch me-2"></i>Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jadwals as $jadwal)
                            <tr class="clickable-row" onclick="window.location='{{ route('jadwals.edit', $jadwal) }}';">
                                <td class="text-center fw-medium">{{ $jadwal->hari }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary">{{ $jadwal->waktu_mulai }}</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger bg-opacity-10 text-danger">{{ $jadwal->waktu_selesai }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="py-5">
                        <i class="fas fa-calendar-times fa-3x text-secondary mb-4"></i>
                        <h5 class="fw-medium text-secondary">Belum ada jadwal tersedia</h5>
                        <p class="text-muted">Klik tombol "Tambah Jadwal" untuk membuat baru</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .admin-logo {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }
    .clickable-row {
        cursor: pointer;
        transition: background-color 0.2s;
    }
    .clickable-row:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
</style>
@endsection
