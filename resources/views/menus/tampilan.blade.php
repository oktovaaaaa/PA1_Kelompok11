@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container pt-5 my-5 text-center">
        <h1>Daftar Menu</h1>

        <div class="mt-4">
            <form action="{{ route('menus.tampilan') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;" placeholder="Cari menu..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary btn-sm">Cari</button>
            </form>
        </div>
        <br>

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
        <br>

        <a href="{{ route('menus.create') }}" class="btn btn-primary btn-sm px-3 py-1">
            <i class="fas fa-plus-circle me-2"></i>Tambah Menu
        </a>

        @if (isset($menus) && count($menus) > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-6 g-6 mt-5">
                @foreach ($menus as $menu)
                    <div class="col">
                        <div class="card h-100 shadow-sm rounded-4 overflow-hidden" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#menuModal{{ $menu->id }}">
                            <div class="ratio ratio-1x1">
                                <img src="{{ url('storage/images/' . $menu->foto) }}" class="card-img-top img-fluid rounded-top-4" alt="Menu Image" style="object-fit: cover;">
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold">{{ $menu->nama }}</h5>
                                <p class="card-text text-truncate" style="max-height: 3em; overflow: hidden;">{{ $menu->deskripsi }}</p>
                                <p class="text-muted fw-bold fs-6">Rp {{$menu->harga}}</p>
                                <a href="{{ route('menus.edit', $menu) }}" class="btn btn-outline-primary w-100 mt-auto rounded-3 fs-7">Edit</a>
                            </div>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="menuModal{{ $menu->id }}" tabindex="-1" aria-labelledby="menuModalLabel{{ $menu->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content rounded-4">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="menuModalLabel{{ $menu->id }}">{{ $menu->nama }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <img src="{{ url('storage/images/' . $menu->foto) }}" class="img-fluid rounded" style="object-fit: cover; width: 100%;">
                                        </div>
                                        <div class="col-md-7">
                                            <h5 class="fw-bold mb-2">Harga: Rp {{$menu->harga}}</h5>
                                            <p class="mb-0">{{ $menu->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('menus.edit', $menu) }}" class="btn btn-primary">Edit Menu</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($menus->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $menus->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <div class="py-5">
                    <i class="fas fa-utensils fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada menu yang tersedia</h5>
                    <p class="text-muted">Klik tombol "Tambah" untuk membuat menu baru</p>
                </div>
            </div>
        @endif
    </div>

    <style>
        .card .card-text {
            min-height: 3em;
        }

        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .modal .modal-body img {
            max-height: 250px;
            object-fit: cover;
        }
    </style>
@endsection

