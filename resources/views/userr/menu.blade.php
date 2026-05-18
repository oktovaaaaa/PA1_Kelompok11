@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.main')
@section('title', 'DelCafe - Menu')

@section('content')
@include('layouts.navbar')


<style>
    /* Custom Styling for Premium Menu Page */
    .menu-section {
        max-width: 1200px !important;
        margin: 0 auto !important;
        padding-left: 15px !important;
        padding-right: 15px !important;
    }
    
    .menu-card {
        border: none !important;
        border-radius: 20px !important;
        background: #ffffff !important;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05) !important;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
        overflow: hidden !important;
        position: relative !important;
        display: flex !important;
        flex-direction: column !important;
    }
    
    .menu-card:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.1) !important;
    }
    
    .menu-card .ratio-1x1 {
        overflow: hidden !important;
        border-radius: 20px 20px 0 0 !important;
        background: #f8f9fa !important;
    }
    
    .menu-card img {
        width: 100% !important;
        height: 100% !important;
        object-fit: cover !important;
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) !important;
    }
    
    .menu-card:hover img {
        transform: scale(1.08) !important;
    }
    
    /* Premium Price Tag */
    .price-tag {
        font-weight: 700 !important;
        color: #0d6efd !important;
        font-size: 0.95rem !important;
        background: rgba(13, 110, 253, 0.07) !important;
        padding: 4px 12px !important;
        border-radius: 30px !important;
        display: inline-block !important;
        margin-top: 5px !important;
        margin-bottom: 12px !important;
        width: fit-content !important;
    }
    
    /* Modern Description */
    .menu-desc {
        color: #6c757d !important;
        font-size: 0.8rem !important;
        display: -webkit-box !important;
        -webkit-line-clamp: 2 !important;
        -webkit-box-orient: vertical !important;
        overflow: hidden !important;
        height: 2.4em !important;
        line-height: 1.2em !important;
        margin-bottom: 8px !important;
    }
    
    /* Beautiful Input Groups */
    .quantity-control {
        border-radius: 12px !important;
        overflow: hidden !important;
        border: 1px solid #dee2e6 !important;
        background: #f8f9fa !important;
        padding: 2px !important;
        margin-bottom: 10px !important;
    }
    
    .quantity-control .btn {
        border: none !important;
        background: transparent !important;
        color: #495057 !important;
        font-weight: 600 !important;
        width: 32px !important;
        height: 32px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 8px !important;
        transition: all 0.2s !important;
        padding: 0 !important;
    }
    
    .quantity-control .btn:hover {
        background: #e9ecef !important;
        color: #0d6efd !important;
    }
    
    .quantity-control input {
        border: none !important;
        background: transparent !important;
        text-align: center !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        color: #212529 !important;
        padding: 0 !important;
        box-shadow: none !important;
    }
    
    .quantity-control input::-webkit-outer-spin-button,
    .quantity-control input::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }
    
    /* Premium Buttons */
    .btn-premium-pesan {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        color: #fff !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 8px 16px !important;
        font-weight: 600 !important;
        letter-spacing: 0.5px !important;
        transition: all 0.3s !important;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.15) !important;
        font-size: 0.85rem !important;
        height: 38px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
    
    .btn-premium-pesan:hover {
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3) !important;
        transform: translateY(-1px) !important;
        color: #fff !important;
    }

    /* Cart icon button on the card */
    .btn-premium-keranjang-card {
        background: rgba(13, 110, 253, 0.08) !important;
        border: 1.5px solid rgba(13, 110, 253, 0.25) !important;
        color: #0d6efd !important;
        border-radius: 12px !important;
        padding: 8px 0 !important;
        font-size: 1rem !important;
        transition: all 0.3s !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 38px !important;
    }
    
    .btn-premium-keranjang-card:hover {
        background: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.15) !important;
    }
    
    /* Search Bar Beautification */
    .search-container {
        max-width: 500px !important;
        margin: 0 auto 30px auto !important;
    }
    
    .search-input-premium {
        border-radius: 30px 0 0 30px !important;
        padding: 10px 20px !important;
        border: 1px solid #dee2e6 !important;
        border-right: none !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02) !important;
        font-size: 0.9rem !important;
        transition: all 0.3s !important;
    }
    
    .search-input-premium:focus {
        border-color: #0d6efd !important;
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.08) !important;
    }
    
    .search-btn-premium {
        border-radius: 0 30px 30px 0 !important;
        padding: 10px 25px !important;
        font-weight: 600 !important;
        background: #0d6efd !important;
        color: #fff !important;
        border: 1px solid #0d6efd !important;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.1) !important;
        transition: all 0.3s !important;
    }
    
    .search-btn-premium:hover {
        background: #0056b3 !important;
        border-color: #0056b3 !important;
    }

    /* Modal styling */
    .modal-content {
        border-radius: 24px !important;
    }
    
    /* Mobile responsive adjustments */
    @media (max-width: 576px) {
        .menu-card {
            border-radius: 16px !important;
        }
        
        .menu-card .ratio-1x1 {
            border-radius: 16px 16px 0 0 !important;
        }
        
        .menu-card .card-body {
            padding: 8px !important;
        }
        
        .menu-card .card-title {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
        }
        
        .price-tag {
            font-size: 0.75rem !important;
            padding: 2px 8px !important;
            margin-bottom: 8px !important;
            margin-top: 2px !important;
        }
        
        .menu-desc {
            font-size: 0.75rem !important;
            height: 2.4em !important;
            margin-bottom: 6px !important;
        }
        
        .quantity-control {
            border-radius: 8px !important;
            margin-bottom: 8px !important;
        }
        
        .quantity-control .btn {
            width: 24px !important;
            height: 24px !important;
            font-size: 0.75rem !important;
        }
        
        .quantity-control input {
            font-size: 0.75rem !important;
        }
        
        .btn-premium-pesan {
            border-radius: 8px !important;
            padding: 6px 12px !important;
            font-size: 0.75rem !important;
        }
    }
</style>

<br>
<div class="container section-title pt-5 mt-5" data-aos="fade-up">
    <h2>Menu</h2>
</div>


@if (isset($menus) && count($menus) > 0)
    <div class="search-container mt-4">
        <form action="" method="GET" class="input-group">
            <input type="text" name="search" class="form-control search-input-premium" placeholder="Cari menu favorit Anda..." value="{{ request('search') }}">
            <button type="submit" class="btn search-btn-premium">Cari</button>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @auth
        @if (auth()->user()->role == 'user' && auth()->user()->id)
            <div class="container py-3 menu-section">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                    @foreach ($menus as $menu)
                        <div class="col" data-menu-id="{{ $menu->id }}">
                            <div class="card h-100 menu-card">
                                <div class="ratio ratio-1x1">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#menuModal{{ $menu->id }}">
                                        <img src="{{ url('storage/images/' . $menu->foto) }}"
                                            class="card-img-top img-fluid" alt="{{ $menu->nama }}">
                                    </a>
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 0.75rem;">
                                    <h5 class="card-title fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $menu->nama }}</h5>
                                    <p class="card-text menu-desc">{{ $menu->deskripsi }}</p>
                                    <div class="price-tag">Rp {{ $menu->harga }}</div>

                                    <div class="mb-2">
                                        <div class="input-group quantity-control">
                                            <button class="btn kurangCard" type="button"
                                                data-menu-id="{{ $menu->id }}">-</button>
                                            <input type="number" name="jumlah" id="jumlahCard{{ $menu->id }}"
                                                class="form-control jumlah-input jumlahCard" value="1" min="1">
                                            <button class="btn tambahCard" type="button"
                                                data-menu-id="{{ $menu->id }}">+</button>
                                        </div>
                                    </div>

                                    <p class="text-muted mb-2" style="font-size: 0.75rem; font-weight: 500;">Total: <span class="fw-bold text-dark" id="totalHarga{{ $menu->id }}">Rp {{ $menu->harga }}</span></p>
                                    <!-- Dual Action: Add to Cart and Direct Order -->
                                    <div class="d-flex gap-2 mt-auto">
                                        <form action="{{ route('userr.tambahKeranjang', $menu->id) }}" method="POST" class="m-0" style="flex: 0 0 45px;">
                                            @csrf
                                            <input type="hidden" name="jumlah" id="jumlahHidden{{ $menu->id }}" class="jumlahHidden" value="1">
                                            <button type="submit" class="btn btn-premium-keranjang-card w-100" title="Tambah ke Keranjang">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-premium-pesan pesanMenuBtn flex-grow-1"
                                            data-menu-id="{{ $menu->id }}" data-bs-toggle="modal"
                                            data-bs-target="#confirmOrderModal">Pesan</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Detail Menu -->
                        <div class="modal fade" id="menuModal{{ $menu->id }}" tabindex="-1"
                            aria-labelledby="menuModalLabel{{ $menu->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="menuModalLabel{{ $menu->id }}">{{ $menu->nama }}
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" data-harga="{{ str_replace(['Rp', '.'], '', $menu->harga) }}">
                                        <img src="{{ url('storage/images/' . $menu->foto) }}" class="img-fluid mb-2"
                                            alt="{{ $menu->nama }}">
                                        <p style="font-size: 0.9rem;">{{ $menu->deskripsi }}</p>
                                        <p class="fw-bold" style="font-size: 0.9rem;">Harga: Rp {{ $menu->harga }}</p>

                                        <form action="{{ route('userr.tambahKeranjang', $menu->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-1">
                                                <label for="jumlah" class="form-label"
                                                    style="font-size: 0.8rem;">Jumlah</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary kurangModal" type="button"
                                                        data-menu-id="{{ $menu->id }}"
                                                        style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">-</button>
                                                    <input type="number" name="jumlah"
                                                        id="jumlahModal{{ $menu->id }}"
                                                        class="form-control jumlah-input jumlahModal" value="1"
                                                        min="1" style="font-size: 0.8rem; padding: 0.2rem;">
                                                    <button class="btn btn-outline-secondary tambahModal" type="button"
                                                        data-menu-id="{{ $menu->id }}"
                                                        style="font-size: 0.7rem; padding: 0.2rem 0.5rem;">+</button>
                                                </div>
                                            </div>
                                            <p style="font-size: 0.8rem;">Total Harga: <span
                                                    id="totalHargaModal{{ $menu->id }}">Rp {{ $menu->harga }}</span>
                                            </p>
                                            <button type="submit" class="btn btn-primary"
                                                style="font-size: 0.8rem; padding: 0.3rem 0.6rem;">Tambah ke
                                                Keranjang</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endauth
    @else
        <div class="container py-3 menu-section">
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                @foreach ($menus as $menu)
                    <div class="col" data-menu-id="{{ $menu->id }}">
                        <div class="card h-100 menu-card">
                            <div class="ratio ratio-1x1">
                                <img src="{{ url('storage/images/' . $menu->foto) }}"
                                    class="card-img-top img-fluid" alt="{{ $menu->nama }}" style="pointer-events: none;">
                            </div>
                            <div class="card-body d-flex flex-column" style="padding: 0.75rem;">
                                <h5 class="card-title fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $menu->nama }}</h5>
                                <p class="card-text menu-desc">{{ $menu->deskripsi }}</p>
                                <div class="price-tag">Rp {{ $menu->harga }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @auth
        @if (auth()->user()->role == 'admin')
            <div class="container py-3 menu-section">
                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
                    @foreach ($menus as $menu)
                        <div class="col" data-menu-id="{{ $menu->id }}">
                            <div class="card h-100 menu-card">
                                <div class="ratio ratio-1x1">
                                    <img src="{{ url('storage/images/' . $menu->foto) }}"
                                        class="card-img-top img-fluid" alt="{{ $menu->nama }}" style="pointer-events: none;">
                                </div>
                                <div class="card-body d-flex flex-column" style="padding: 0.75rem;">
                                    <h5 class="card-title fw-bold text-dark mb-1" style="font-size: 0.95rem;">{{ $menu->nama }}</h5>
                                    <p class="card-text menu-desc">{{ $menu->deskripsi }}</p>
                                    <div class="price-tag">Rp {{ $menu->harga }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
        @endif
        </div>
        </div>
        @endauth
    @else
    <div class="search-container mt-4">
        <form action="" method="GET" class="input-group">
            <input type="text" name="search" class="form-control search-input-premium" placeholder="Cari menu favorit Anda..." value="{{ request('search') }}">
            <button type="submit" class="btn search-btn-premium">Cari</button>
        </form>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <div class="text-center py-5 pt-5">
        <div class="py-5">
            <i class="fas fa-utensils fa-3x text-secondary mb-4"></i>
            <h5 class="fw-medium text-secondary">Belum ada menu yang tersedia</h5>
        </div>
    </div>

    @endif
@auth

    <div class="modal fade" id="confirmOrderModal" tabindex="-1" aria-labelledby="confirmOrderModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="confirmOrderModalLabel">
                        <i class="fas fa-check-circle me-2"></i> Konfirmasi Pesanan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/img/barcode.jpeg') }}"
                             class="img-fluid animated w-50 mx-auto d-block"
                             alt="">
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Pastikan data pesanan dan nomor WhatsApp Anda benar.<br><b>Scan dengan Qris untuk melakukan pembayaran</b>
                    </div>

                    <div class="border rounded p-3 mb-3">
                        <h6 class="fw-bold mb-3">Detail Pesanan:</h6>
                        <ul class="list-unstyled mb-0">
                            <li class="d-flex justify-content-between py-1">
                                <span>Menu: <span id="namaMenuModal"></span></span>
                                <span>Jumlah: <span id="jumlahMenuModal"></span></span>
                            </li>
                        </ul>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold">
                            <span>Total:</span>
                            <span class="text-primary"><span id="totalHargaModal"></span></span>
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="customerName" value="{{ Auth::user()->name }}"
                               readonly>
                        <label for="customerName">Atas Nama</label>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i> Batal
                    </button>
                    <button type="button" class="btn btn-primary" onclick="sendOrderToWhatsApp()">
                        <i class="fab fa-whatsapp me-2"></i> Lanjutkan ke WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>

@endauth

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @auth
        @if (auth()->user()->role == 'user' && auth()->user()->id)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                function updateTotalHarga(menuId) {
                    const card = document.querySelector(`.col[data-menu-id="${menuId}"]`);

                    const hargaAwal = card.querySelector('.price-tag').innerText;
                    const hargaSatuan = parseFloat(hargaAwal.replace(/[^0-9]/g, ''));

                    const jumlahCard = parseInt(card.querySelector(`#jumlahCard${menuId}`).value);
                    const totalHargaCard = hargaSatuan * jumlahCard;

                    const totalHargaElem = card.querySelector(`#totalHarga${menuId}`);
                    if (totalHargaElem) {
                        totalHargaElem.innerText = 'Rp ' + totalHargaCard.toLocaleString('id-ID');
                    }

                    // Synchronize the hidden input field for Cart submit!
                    const hiddenInput = card.querySelector(`#jumlahHidden${menuId}`);
                    if (hiddenInput) {
                        hiddenInput.value = jumlahCard;
                    }

                    const modalBody = document.querySelector(`#menuModal${menuId} .modal-body`);
                    const hargaAwalModal = modalBody.dataset.harga;

                    const jumlahModal = parseInt(modalBody.querySelector(`#jumlahModal${menuId}`).value);
                    const totalHargaModal = hargaSatuan * jumlahModal;

                    modalBody.querySelector(`#totalHargaModal${menuId}`).innerText = 'Rp ' + totalHargaModal
                        .toLocaleString('id-ID');
                }

                document.querySelectorAll('.tambahCard').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);

                        jumlahInputCard.value = parseInt(jumlahInputCard.value) + 1;
                        jumlahInputModal.value = parseInt(jumlahInputModal.value) + 1;

                        updateTotalHarga(menuId);
                    });
                });

                document.querySelectorAll('.kurangCard').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;

                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);

                        let currentValue = parseInt(jumlahInputCard.value);
                        if (currentValue > 1) {
                            jumlahInputCard.value = currentValue - 1;
                            jumlahInputModal.value = currentValue - 1;
                            updateTotalHarga(menuId);
                        }
                    });
                });

                document.querySelectorAll('.tambahModal').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);

                        jumlahInputCard.value = parseInt(jumlahInputCard.value) + 1;
                        jumlahInputModal.value = parseInt(jumlahInputModal.value) + 1;
                        updateTotalHarga(menuId);
                    });
                });

                document.querySelectorAll('.kurangModal').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        let jumlahInputCard = document.querySelector(
                            `.col[data-menu-id="${menuId}"] #jumlahCard${menuId}`);
                        let jumlahInputModal = document.querySelector(
                            `#menuModal${menuId} .modal-body #jumlahModal${menuId}`);
                        let currentValue = parseInt(jumlahInputModal.value);
                        if (currentValue > 1) {
                            jumlahInputCard.value = currentValue - 1;
                            jumlahInputModal.value = currentValue - 1;
                            updateTotalHarga(menuId);
                        }
                    });
                });

                const menuModals = document.querySelectorAll('.modal');
                menuModals.forEach(modal => {
                    modal.addEventListener('shown.bs.modal', function() {
                        const menuId = this.id.replace('menuModal', '');
                        updateTotalHarga(menuId);
                    });
                });

                // Sync manual keyboard input typing
                document.querySelectorAll('.jumlahCard').forEach(input => {
                    input.addEventListener('input', function() {
                        const menuId = this.id.replace('jumlahCard', '');
                        let val = parseInt(this.value);
                        if (isNaN(val) || val < 1) {
                            val = 1;
                        }
                        
                        const modalInput = document.querySelector(`#menuModal${menuId} .modal-body #jumlahModal${menuId}`);
                        if (modalInput) {
                            modalInput.value = val;
                        }
                        
                        updateTotalHarga(menuId);
                    });
                });

                // Event listener untuk tombol Pesan
                document.querySelectorAll('.pesanMenuBtn').forEach(button => {
                    button.addEventListener('click', function() {
                        const menuId = this.dataset.menuId;
                        const card = document.querySelector(`.col[data-menu-id="${menuId}"]`);
                        const namaMenu = card.querySelector('.card-title').innerText;
                        const jumlahMenu = card.querySelector(`#jumlahCard${menuId}`).value;
                        const totalHarga = card.querySelector(`#totalHarga${menuId}`).innerText;

                        document.querySelector('#namaMenuModal').innerText = namaMenu;
                        document.querySelector('#jumlahMenuModal').innerText = jumlahMenu;
                        document.querySelector('#totalHargaModal').innerText = totalHarga;

                        // Simpan data menu yang akan dipesan ke dalam modal
                        document.querySelector('#confirmOrderModal').dataset.menuId = menuId;
                        document.querySelector('#confirmOrderModal').dataset.jumlahMenu = jumlahMenu;
                    });
                });
            });

           async function sendOrderToWhatsApp() {
    const confirmOrderModal = document.querySelector('#confirmOrderModal');
    const menuId = confirmOrderModal.dataset.menuId;
    const jumlahMenu = confirmOrderModal.dataset.jumlahMenu;
    const card = document.querySelector(`.col[data-menu-id="${menuId}"]`);
    const namaMenu = card.querySelector('.card-title').innerText;
    const hargaMenu = card.querySelector('.price-tag').innerText;
    const totalHarga = card.querySelector(`#totalHarga${menuId}`).innerText; // Ambil total harga dari card
    const namaPengguna = "{{ Auth::user()->name }}";

    const hargaMenuBersih = hargaMenu.replace(/[^0-9]/g, '');

    let message = `Halo, saya ingin memesan:\n- ${namaMenu} (${jumlahMenu} x Rp ${parseInt(hargaMenuBersih).toLocaleString('id-ID')})\nTotal : ${totalHarga}\nAtas nama: ${namaPengguna}\nBukti pembayaran akan saya kirimkan. Terima kasih!`;

    const phoneNumber = "6287844043032";
    const encodedMessage = encodeURIComponent(message);
    const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

    console.log("WhatsApp URL:", whatsappURL);

    window.open(whatsappURL, '_blank');

    try {
        const response = await fetch('{{ route('userr.prosesPembayaranMenu') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                menu_id: menuId,
                jumlah: jumlahMenu
            })
        });

        const data = await response.json();

        if (data.success) {
            alert(data.message);
            window.location.href = '{{ route('userr.riwayatPesanan') }}';
        } else {
            alert(data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses pesanan.');
    }

    $('#confirmOrderModal').modal('hide');
}
        </script>
                @endif
    @endauth
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-4">
    <div class="d-flex justify-content-center">
        {{ $menus->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>


@include('layouts.footer')
@endsection
