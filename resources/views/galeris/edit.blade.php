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
                    <i class="fas fa-edit text-primary me-2"></i> Edit Galeri Foto
                </h2>
                <div class="d-flex gap-2">
                    <!-- Hapus Galeri Button -->
                    @include('galeris.delete')
                    
                    <a href="{{ route('galeris.tampilan') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5" style="font-weight: 600; font-size: 0.8rem;">
                        <i class="fas fa-arrow-left me-1.5"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Form & Image Preview Column Grid -->
            <div class="row g-4 align-items-stretch">
                <!-- Left Form Column -->
                <div class="col-lg-7">
                    <div class="card h-100 shadow-sm border-0 p-4" style="border-radius: 20px; background: #ffffff;">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('galeris.update', $galeri) }}" class="d-flex flex-column gap-4 h-100">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="nama" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Nama / Judul Foto</label>
                                <input id="nama" class="form-control" type="text" name="nama" placeholder="Masukkan nama atau subjek foto..." value="{{ $galeri->nama }}" required />
                            </div>

                            <div>
                                <label for="deskripsi" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Deskripsi Singkat</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Tulis deskripsi atau suasana dari foto ini..." rows="4">{{ $galeri->deskripsi }}</textarea>
                            </div>

                            <div>
                                <label for="foto" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Ganti File Foto</label>
                                <input accept="image/*" id="foto" class="form-control" type="file" name="foto"
                                    onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                <span class="text-muted small d-block mt-1.5" style="font-size: 0.75rem;">
                                    * Biarkan kosong jika Anda tidak ingin mengganti foto yang saat ini terunggah.
                                </span>
                            </div>

                            <div class="mt-auto pt-3">
                                <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill" style="font-size: 0.9rem; font-weight: 600;">
                                    <i class="fas fa-check me-1.5"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Image Preview Column -->
                <div class="col-lg-5">
                    <div class="card h-100 shadow-sm border-0 p-4 text-center d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background: #ffffff; min-height: 320px;">
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 0.95rem;">Pratinjau Unggahan</h5>
                        <div class="image-preview-container shadow-sm mb-3 d-flex align-items-center justify-content-center" style="width: 100%; max-width: 280px; aspect-ratio: 1x1; border-radius: 24px; overflow: hidden; border: 1px solid rgba(0,0,0,0.04); background: #f8fafc; padding: 6px;">
                            <img id="preview" class="img-fluid rounded-4 h-100 w-100" style="object-fit: cover;" src="{{ asset('storage/images/' . $galeri->foto) }}" alt="Pratinjau Foto">
                        </div>
                        <p class="text-muted small px-3 mb-0" style="font-size: 0.75rem; max-width: 280px; font-weight: 500;">
                            Foto Anda yang saat ini aktif terpasang. Unggah file baru untuk menggantinya secara instan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
