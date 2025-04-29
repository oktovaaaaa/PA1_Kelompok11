@extends('layouts.mainadmin')

@section('contents')
    <div class="d-flex justify-content-center align-items-center vh-15">
        <img src="{{ asset('menu.png') }}" class="img-fluid" style="width:200px">
    </div>

    <div class="d-flex pt-5">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h2 class="fw-semibold fs-4">List Menu</h2>
            <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm px-3 py-1">Tambah</a>
        </div>
    </div>

    <div class="mt-4">
        <form action="{{-- {{ route('menus.index') }} --}}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Cari menu..."
                value="{{-- {{ request('search') }} --}}">
            <button type="submit" class="btn btn-outline-primary">Cari</button>
        </form>
    </div>
    <br><br><br>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-center" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (isset($menus) && $menus->isEmpty() && request('search'))
        <div class="alert alert-info mt-4 d-flex justify-content-center">
            Tidak ada menu yang ditemukan "{{ request('search') }}".
        </div>
    @endif

    <!-- Daftar Menu -->
    <div class="container mt-4">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 g-4">
            @if (isset($menus) && count($menus) > 0)
                @foreach ($menus as $menu)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <div class="card h-100 shadow-sm rounded-4 overflow-hidden">
                            <!-- Gambar dengan aspect ratio 1:1 -->
                            <div class="ratio ratio-1x1">
                                <img src="{{ url('storage/images/' . $menu->foto) }}"
                                    class="card-img-top img-fluid rounded-top-4" alt="Menu Image"
                                    style="object-fit: cover;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold fs-6">{{ $menu->nama }}</h5>
                                <p class="card-text flex-grow-1 fs-7">{{ $menu->deskripsi }}</p>
                                <p class="text-muted fw-bold fs-6">Rp {{ $menu->harga }}</p>
                                <a href="{{ route('menus.edit', $menu) }}"
                                    class="btn btn-outline-primary w-100 mt-auto rounded-3 fs-7">Edit</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-lg-12">
                    <div class="text-center py-5">
                        <div class="py-5">
                            <i class="fas fa-calendar-times fa-3x text-secondary mb-4"></i>
                            <h5 class="fw-medium text-secondary">Belum ada menu tersedia</h5>
                            <p class="text-muted">Klik tombol "Tambah" untuk membuat menu baru</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- Pagination -->
        @if (isset($menus) && $menus->hasPages())
            <div class="mt-5 d-flex justify-content-center">
                {{ $menus->links() }}
            </div>
        @endif
    </div>
@endsection
