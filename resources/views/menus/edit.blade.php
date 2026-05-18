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
                    <i class="fas fa-edit text-primary me-2"></i> Edit Menu Makanan
                </h2>
                <div class="d-flex gap-2">
                    <!-- Hapus Menu Button -->
                    @include('menus.delete')
                    
                    <a href="{{ route('menus.tampilan') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-1.5" style="font-weight: 600; font-size: 0.8rem;">
                        <i class="fas fa-arrow-left me-1.5"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Form & Preview Grid -->
            <div class="row g-4 align-items-stretch">
                <!-- Left Form Column -->
                <div class="col-lg-7">
                    <div class="card h-100 shadow-sm border-0 p-4" style="border-radius: 20px; background: #ffffff;">
                        <form enctype="multipart/form-data" method="POST" action="{{ route('menus.update', $menu) }}" class="d-flex flex-column gap-4 h-100">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="nama" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Nama Menu</label>
                                <input id="nama" class="form-control" type="text" name="nama" placeholder="Masukkan nama makanan/minuman..." value="{{ $menu->nama }}" required />
                            </div>

                            <div>
                                <label for="deskripsi" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Deskripsi Menu</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" placeholder="Tuliskan deskripsi lengkap menu..." rows="4">{{ $menu->deskripsi }}</textarea>
                            </div>

                            <div>
                                <label for="harga" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Harga (Rupiah)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0" style="border-radius: 12px 0 0 12px; font-weight: 600;">Rp</span>
                                    <input id="harga" class="form-control border-start-0" type="text" name="harga" placeholder="Contoh: 15.000" style="border-radius: 0 12px 12px 0;" value="{{ $menu->harga }}" required />
                                </div>
                            </div>

                            <div>
                                <label for="foto" class="form-label fw-bold text-dark mb-2" style="font-size: 0.85rem;">Foto Menu</label>
                                <input accept="image/*" id="foto" class="form-control" type="file" name="foto"
                                    onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                <span class="text-muted small d-block mt-1" style="font-size: 0.72rem; font-weight: 500;">Pilih foto baru jika Anda ingin mengganti foto saat ini.</span>
                            </div>

                            <div class="mt-auto pt-3">
                                <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-pill" style="font-size: 0.9rem; font-weight: 600;">
                                    <i class="fas fa-check me-1.5"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Right Live Preview Column -->
                <div class="col-lg-5">
                    <div class="card h-100 shadow-sm border-0 p-4 text-center d-flex flex-column align-items-center justify-content-center" style="border-radius: 20px; background: #ffffff; min-height: 380px;">
                        <h5 class="fw-bold text-dark mb-3" style="font-size: 0.95rem;">Foto Saat Ini / Pratinjau</h5>
                        <div class="preview-img-container mb-3 shadow-sm" style="width: 240px; height: 240px; border-radius: 16px; overflow: hidden; border: 2px dashed rgba(13, 110, 253, 0.15); background: #f8fafc; display: flex; align-items: center; justify-content: center;">
                            <img id="preview" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;" src="{{ asset('storage/' . $menu->foto) }}" onerror="this.src='{{ url('storage/noimage.png') }}'">
                        </div>
                        <p class="text-muted small px-3 mb-0" style="font-size: 0.75rem; max-width: 280px; font-weight: 500;">
                            Gambar di atas menunjukkan foto menu yang aktif saat ini. Anda dapat mengunggah foto baru di panel kiri untuk mengubahnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const hargaInput = document.getElementById("harga");

        // Format initial price value if present
        if (hargaInput.value !== "") {
            let value = hargaInput.value.replace(/\./g, "");
            if (!isNaN(value) && value !== "") {
                hargaInput.value = new Intl.NumberFormat("id-ID").format(value);
            }
        }

        hargaInput.addEventListener("input", function () {
            let value = this.value.replace(/\./g, "");
            if (!isNaN(value) && value !== "") {
                this.value = new Intl.NumberFormat("id-ID").format(value);
            }
        });

        hargaInput.form.addEventListener("submit", function () {
            hargaInput.value = hargaInput.value.replace(/\./g, "");
        });
    });
</script>
@endsection
