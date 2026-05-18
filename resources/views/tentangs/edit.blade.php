@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
                <h2 class="history-title mb-0" style="font-size: 1.5rem; font-weight: 700; color: #1e3c72;">
                    <i class="fas fa-edit text-primary me-2"></i> Edit Informasi Cafe
                </h2>
                <div class="d-flex gap-2">
                    <!-- Hapus Tentang Button -->
                    @include('tentangs.delete')
                    
                    <a href="{{ route('tentangs.tampilan') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5" style="font-weight: 600; font-size: 0.8rem;">
                        <i class="fas fa-arrow-left me-1.5"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Form Card Layout -->
            <div class="card shadow-sm border-0 p-4" style="border-radius: 20px; background: #ffffff;">
                <form enctype="multipart/form-data" method="POST" action="{{ route('tentangs.update', $tentang) }}" class="d-flex flex-column gap-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label for="judul" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Judul Artikel / Informasi</label>
                        <input id="judul" class="form-control" type="text" name="judul" placeholder="Masukkan judul deskripsi tentang..." value="{{ $tentang->judul }}" required />
                    </div>

                    <div>
                        <label for="deskripsi" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Deskripsi / Cerita Profil</label>
                        <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Tuliskan cerita lengkap tentang profil DelCafe..." rows="6" required>{{ $tentang->deskripsi }}</textarea>
                    </div>

                    <div>
                        <label for="tanggal" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Tanggal Publikasi</label>
                        <input id="tanggal" class="form-control" type="date" name="tanggal" value="{{ is_string($tentang->tanggal) ? $tentang->tanggal : $tentang->tanggal->format('Y-m-d') }}" required />
                    </div>

                    <div class="pt-3 border-top mt-2">
                        <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill" style="font-size: 0.9rem; font-weight: 600;">
                            <i class="fas fa-check me-1.5"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
