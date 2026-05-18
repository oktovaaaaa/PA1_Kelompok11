@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-11 col-xl-10">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h2 class="history-title mb-0" style="font-size: 1.5rem; font-weight: 700; color: #1e3c72;">
                    <i class="fas fa-edit text-primary me-2"></i> Edit Jadwal Operasional
                </h2>
                <div class="d-flex gap-2">
                    <!-- Hapus Jadwal Button -->
                    @include('jadwals.delete')
                    
                    <a href="{{ route('jadwals.tampilan') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5" style="font-weight: 600; font-size: 0.8rem;">
                        <i class="fas fa-arrow-left me-1.5"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Form & Info Widget Grid -->
            <div class="row g-4 align-items-stretch">
                <!-- Left Form Column -->
                <div class="col-lg-7">
                    <div class="card h-100 shadow-sm border-0 p-4" style="border-radius: 20px; background: #ffffff;">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('jadwals.update', $jadwal) }}" class="d-flex flex-column gap-4 h-100">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="hari" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Hari Operasional</label>
                                <select id="hari" class="form-select" name="hari" required>
                                    <option value="Senin" {{ $jadwal->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ $jadwal->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ $jadwal->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ $jadwal->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ $jadwal->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ $jadwal->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ $jadwal->hari == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                            </div>

                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="waktu_mulai" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Jam Buka / Mulai</label>
                                    <input id="waktu_mulai" class="form-control" type="time" name="waktu_mulai" value="{{ $jadwal->waktu_mulai }}" required />
                                </div>
                                <div class="col-sm-6">
                                    <label for="waktu_selesai" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Jam Tutup / Selesai</label>
                                    <input id="waktu_selesai" class="form-control" type="time" name="waktu_selesai" value="{{ $jadwal->waktu_selesai }}" required />
                                </div>
                            </div>

                            <input type="hidden" name="waktu" id="waktu" value="{{ old('waktu') }}">

                            <div class="mt-auto pt-3">
                                <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill" style="font-size: 0.9rem; font-weight: 600;">
                                    <i class="fas fa-check me-1.5"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Time Widget Column -->
                <div class="col-lg-5">
                    <div class="card h-100 shadow-sm border-0 p-4 text-center d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background: #ffffff; min-height: 320px;">
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 0.95rem;">Rangkuman Jadwal</h5>
                        <div class="time-visualization-box mb-3 shadow-sm" style="width: 240px; height: 180px; border-radius: 16px; overflow: hidden; border: 2px dashed rgba(13, 110, 253, 0.15); background: #f8fafc; display: flex; flex-column; align-items: center; justify-content: center; padding: 20px;">
                            <div class="text-center">
                                <i class="fas fa-clock text-primary mb-3" style="font-size: 3rem; animation: pulse 2s infinite;"></i>
                                <h6 class="fw-bold text-dark mb-1" id="visual_hari">Hari {{ $jadwal->hari }}</h6>
                                <p class="badge bg-primary bg-opacity-10 text-primary px-3 py-1.5 rounded-pill fw-bold mb-0" id="visual_waktu" style="font-size: 0.8rem;">
                                    {{ $jadwal->waktu_mulai }} WIB - {{ $jadwal->waktu_selesai }} WIB
                                </p>
                            </div>
                        </div>
                        <p class="text-muted small px-3 mb-0" style="font-size: 0.75rem; max-width: 280px; font-weight: 500;">
                            Pastikan jam buka dan tutup yang Anda masukkan sesuai dengan jam operasional nyata DelCafe untuk menghindari kebingungan customer.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const waktuMulaiInput = document.getElementById('waktu_mulai');
        const waktuSelesaiInput = document.getElementById('waktu_selesai');
        const hariInput = document.getElementById('hari');
        const waktuInput = document.getElementById('waktu');
        
        const visualHari = document.getElementById('visual_hari');
        const visualWaktu = document.getElementById('visual_waktu');

        function updateWaktu() {
            const waktuMulai = waktuMulaiInput.value;
            const waktuSelesai = waktuSelesaiInput.value;
            const hari = hariInput.value;

            if (hari) {
                visualHari.textContent = "Hari " + hari;
            }

            if (waktuMulai && waktuSelesai) {
                const waktuGabungan = waktuMulai + "-" + waktuSelesai;
                waktuInput.value = waktuGabungan;
                visualWaktu.textContent = waktuMulai + " WIB - " + waktuSelesai + " WIB";
            } else {
                waktuInput.value = "";
                visualWaktu.textContent = "-- : --  s/d  -- : --";
            }
        }

        waktuMulaiInput.addEventListener('change', updateWaktu);
        waktuSelesaiInput.addEventListener('change', updateWaktu);
        hariInput.addEventListener('change', updateWaktu);
    });
</script>
@endsection
