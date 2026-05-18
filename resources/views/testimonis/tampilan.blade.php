@extends('layouts.mainadmin')

@section('contents')
<!-- FontAwesome CDN for premium icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container-fluid py-4">
    <!-- Header Title -->
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-3">
        <h2 class="history-title mb-0" style="font-size: 1.6rem; font-weight: 800; color: #0f172a;">
            <i class="fas fa-comments text-primary me-2"></i> Pengelolaan Testimoni Ulasan
        </h2>
    </div>

    <!-- Action & Filter Bar (Stripe Style) -->
    <div class="card shadow-sm border-0 p-3 mb-4" style="border-radius: 16px; background: #ffffff;">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
            <!-- Search Form -->
            <form action="{{ route('testimonis.index') }}" method="GET" class="d-flex w-100" style="max-width: 400px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted" style="border-radius: 50px 0 0 50px; padding-left: 20px;">
                        <i class="fas fa-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0 ps-1" style="border-radius: 0 50px 50px 0; font-size: 0.88rem;" 
                        placeholder="Cari nama pengulas..." value="{{ $search ?? '' }}">
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

    @if (isset($testimonis) && $testimonis->isEmpty() && request('search'))
        <div class="alert alert-info rounded-4 border-0 p-3 mb-4 d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fs-5 me-2.5 text-info"></i>
            <div>Tidak ada testimoni yang ditemukan untuk kata kunci <strong>"{{ request('search') }}"</strong>.</div>
        </div>
    @endif

    <!-- Cards Grid -->
    @if(isset($testimonis) && count($testimonis) > 0)
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($testimonis as $testimoni)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm d-flex flex-column p-4" style="border-radius: 20px; background: #ffffff; border: 1px solid rgba(0,0,0,0.01) !important;">
                        
                        <!-- Card Header: User Avatar & Name -->
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="avatar-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; border-radius: 50%; font-weight: 700; font-size: 1.1rem;">
                                {{ substr($testimoni->nama, 0, 1) }}
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark mb-0" style="font-size: 1rem;">
                                    {{ $testimoni->nama }}
                                </h5>
                                <!-- Star Rating Display -->
                                <div class="rating-stars mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $testimoni->rating)
                                            <i class="fas fa-star text-warning" style="font-size: 0.78rem;"></i>
                                        @else
                                            <i class="far fa-star text-secondary" style="font-size: 0.78rem; opacity: 0.4;"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Card Body: Testimonial Message -->
                        <div class="card-text text-secondary flex-grow-1 mb-4" style="font-size: 0.85rem; line-height: 1.6; font-style: italic;">
                            "{{ $testimoni->deskripsi ?: 'Tidak ada komentar ulasan.' }}"
                        </div>

                        <!-- Card Footer Action: Delete Modal Trigger -->
                        <div class="border-top pt-3 mt-auto d-flex justify-content-end">
                            @include('testimonis.delete')
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="card border-0 shadow-sm rounded-4 text-center py-5 mt-4" style="background: #ffffff; min-height: 320px; display: flex; align-items: center; justify-content: center;">
            <div class="py-4">
                <div class="icon-circle bg-light text-muted mb-4 d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 50%;">
                    <i class="fas fa-comments fa-3x"></i>
                </div>
                <h5 class="fw-bold text-dark">Belum Ada Ulasan Testimoni</h5>
                <p class="text-muted px-4 mb-0" style="max-width: 400px; font-size: 0.85rem; font-weight: 500;">
                    Ulasan kepuasan dari pelanggan setia DelCafe akan otomatis ditampilkan di sini setelah dikirim dari halaman depan.
                </p>
            </div>
        </div>
    @endif
</div>
@endsection
