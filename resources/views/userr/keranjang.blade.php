@extends('layouts.main')
@section('title', 'DelCafe - Keranjang')

@include('layouts.navbar')

<section class="cart-page-section">
    <div class="container py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-11 col-xl-10">
                <div class="card cart-card p-3 p-md-4">
                    
                    <h2 class="cart-title mb-3">Keranjang Belanja</h2>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-3" role="alert" style="border-radius: 12px; font-weight: 500; padding: 10px 15px;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 12px;"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert" style="border-radius: 12px; font-weight: 500; padding: 10px 15px;">
                            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" style="padding: 12px;"></button>
                        </div>
                    @endif

                    @if (count($keranjangItems) > 0)
                        <!-- Cart Items List Container -->
                        <div class="cart-table-container mb-3">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="ps-4 py-3">Menu</th>
                                            <th scope="col" class="text-center py-3">Jumlah</th>
                                            <th scope="col" class="text-end pe-4 py-3">Harga Satuan</th>
                                            <th scope="col" class="text-end pe-4 py-3">Subtotal</th>
                                            <th scope="col" class="text-center py-3">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($keranjangItems as $item)
                                            <tr class="cart-row">
                                                <!-- Menu Item with Thumbnail picture -->
                                                <td class="ps-4">
                                                    <div class="d-flex align-items-center">
                                                        <div class="cart-img-wrapper me-3">
                                                            <a href="{{ route('userr.detailMenu', $item->menu->id) }}">
                                                                <img src="{{ url('storage/images/' . $item->menu->foto) }}" alt="{{ $item->menu->nama }}" class="cart-item-img">
                                                            </a>
                                                        </div>
                                                        <div>
                                                            <a href="{{ route('userr.detailMenu', $item->menu->id) }}" class="text-decoration-none">
                                                                <h6 class="mb-0 fw-bold text-dark hover-primary" style="font-size: 0.95rem;">{{ $item->menu->nama }}</h6>
                                                            </a>
                                                            <span class="badge bg-light text-secondary border px-2 py-1 mt-1" style="font-size: 0.7rem; font-weight: 600;">{{ $item->menu->kategori ?? 'Makanan' }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <!-- Quantity Control -->
                                                <td class="text-center">
                                                    <div class="input-group quantity-control mx-auto" style="max-width: 110px; border-radius: 30px; overflow: hidden; border: 1.5px solid rgba(13, 110, 253, 0.15); box-shadow: 0 2px 8px rgba(13, 110, 253, 0.04);">
                                                        <button class="btn btn-outline-primary kurangCartBtn" type="button" data-item-id="{{ $item->id }}" style="border: none; padding: 4px 10px; font-weight: 700; background: transparent; font-size: 0.85rem;">-</button>
                                                        <input type="number" name="jumlah" id="jumlahCart{{ $item->id }}"
                                                            class="form-control text-center fw-bold jumlahCartInput" value="{{ $item->jumlah }}" min="1" style="border: none; background: rgba(13, 110, 253, 0.04); font-size: 0.85rem; max-width: 45px; padding: 4px 0; color: #0d6efd;">
                                                        <button class="btn btn-outline-primary tambahCartBtn" type="button" data-item-id="{{ $item->id }}" style="border: none; padding: 4px 10px; font-weight: 700; background: transparent; font-size: 0.85rem;">+</button>
                                                    </div>
                                                </td>
                                                <!-- Unit Price -->
                                                <td class="text-end pe-4 text-muted fw-medium" style="font-size: 0.9rem;">
                                                    RP {{ $item->menu->harga }}
                                                </td>
                                                <!-- Subtotal -->
                                                <td class="text-end pe-4 fw-bold text-dark" style="font-size: 0.95rem;">
                                                    Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                                </td>
                                                <!-- Delete button -->
                                                <td class="text-center">
                                                    <form action="{{ route('userr.hapusKeranjang', $item->id) }}" method="POST" class="d-inline delete-cart-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-delete-cart" title="Hapus dari Keranjang">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Summary Banner -->
                        <div class="summary-banner p-3 mb-3">
                            <div class="row align-items-center g-2">
                                <div class="col-md-7 text-center text-md-start">
                                    <div class="d-inline-flex align-items-center">
                                        <i class="fas fa-info-circle text-primary me-2 fs-5"></i>
                                        <p class="mb-0 text-muted small fw-medium">Pastikan data pesanan Anda sudah benar sebelum menekan tombol Bayar Sekarang.</p>
                                    </div>
                                </div>
                                <div class="col-md-5 text-center text-md-end">
                                    <div class="d-flex justify-content-center justify-content-md-end align-items-center gap-3">
                                        <span class="fs-6 fw-bold text-secondary">Total Belanja:</span>
                                        <span class="total-price-highlight">
                                            Rp {{ number_format($keranjangItems->sum('total_harga'), 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Footer Actions -->
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 pt-2" style="border-top: 1px solid rgba(0, 0, 0, 0.05);">
                            <a href="{{ route('userr.menu') }}" class="btn-back-menu py-2 px-4">
                                <i class="fas fa-chevron-left me-2"></i> Kembali ke Menu
                            </a>
                            <button type="button" class="btn-checkout-cart py-2 px-4" data-bs-toggle="modal" data-bs-target="#confirmOrderModal">
                                <i class="fas fa-wallet me-2"></i> Bayar Sekarang
                            </button>
                        </div>
                    @else
                        <!-- Empty Cart State -->
                        <div class="text-center py-5 my-3 d-flex flex-column align-items-center justify-content-center">
                            <div class="empty-cart-container mb-4">
                                <i class="fas fa-shopping-basket fa-5x text-muted opacity-25"></i>
                                <span class="empty-badge"><i class="fas fa-times"></i></span>
                            </div>
                            <h4 class="text-muted fw-bold mb-2">Keranjang Anda Kosong</h4>
                            <p class="text-muted small mb-4">Mulai jelajahi menu lezat kami dan temukan kuliner favorit Anda.</p>
                            <a href="{{ route('userr.menu') }}" class="btn-view-menu py-2 px-4">
                                <i class="fas fa-utensils me-2"></i> Lihat Daftar Menu
                            </a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>

<!-- DEFINISI MODAL -->
@auth
<div class="modal fade" id="confirmOrderModal" tabindex="-1" aria-labelledby="confirmOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white py-3">
                <h5 class="modal-title fw-bold" id="confirmOrderModalLabel">
                    <i class="fas fa-check-circle me-2"></i> Konfirmasi Pesanan
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('assets/img/barcode.jpeg') }}" class="img-fluid rounded shadow-sm w-50 mx-auto d-block border" alt="QRIS Code">
                </div>

                <div class="alert alert-info py-2 px-3 mb-3" style="border-radius: 12px; font-size: 0.85rem; font-weight: 500;">
                    <i class="fas fa-info-circle me-2"></i> Scan kode QRIS di atas untuk melakukan pembayaran, lalu lanjutkan konfirmasi ke WhatsApp.
                </div>

                <div class="border rounded-4 p-3 mb-3 bg-light">
                    <h6 class="fw-bold mb-3 text-secondary" style="font-size: 0.85rem;">Detail Belanja:</h6>
                    <ul class="list-unstyled mb-0" style="max-height: 150px; overflow-y: auto; padding-right: 5px;">
                        @foreach ($keranjangItems as $item)
                            <li class="d-flex justify-content-between py-1.5" style="border-bottom: 1px solid rgba(0,0,0,0.04); font-size: 0.88rem;">
                                <span class="text-dark fw-medium">{{ $item->menu->nama }} <span class="text-muted small">({{ $item->jumlah }}x)</span></span>
                                <span class="fw-bold text-dark">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between fw-bold align-items-center mt-2">
                        <span class="text-secondary" style="font-size: 0.88rem;">Total Pembayaran:</span>
                        <span class="text-primary fs-5">Rp {{ number_format($keranjangItems->sum('total_harga'), 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control" id="customerName" value="{{ Auth::user()->name }}" style="border-radius: 10px;" readonly>
                    <label for="customerName">Pesanan Atas Nama</label>
                </div>
            </div>
            <div class="modal-footer border-0 p-3 bg-light" style="border-radius: 0 0 24px 24px;">
                <button type="button" class="btn btn-outline-secondary px-4 py-2" data-bs-dismiss="modal" style="border-radius: 50px; font-weight: 600; font-size: 0.85rem;">
                    <i class="fas fa-times me-2"></i> Batal
                </button>
                <button type="button" class="btn btn-primary px-4 py-2" onclick="sendOrderToWhatsApp()" style="border-radius: 50px; font-weight: 600; font-size: 0.85rem; background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%); border: none;">
                    <i class="fab fa-whatsapp me-2"></i> Lanjutkan ke WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>
@endauth

<!-- SweetAlert2 Library CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intercept Delete Item forms with SweetAlert2
        document.querySelectorAll('.delete-cart-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Stop standard submit
                
                Swal.fire({
                    title: 'Hapus Item?',
                    text: 'Apakah Anda yakin ingin menghapus menu ini dari keranjang belanja?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    customClass: {
                        popup: 'swal2-premium-popup',
                        title: 'swal2-premium-title',
                        confirmButton: 'swal2-premium-confirm-btn btn-danger-swal',
                        cancelButton: 'swal2-premium-cancel-btn'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Perform form deletion submission
                    }
                });
            });
        });

        // Quantity update AJAX handler
        document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(button => {
            button.addEventListener('click', function() {
                const itemId = this.dataset.itemId;
                const input = document.getElementById(`jumlahCart${itemId}`);
                let currentVal = parseInt(input.value);
                
                if (this.classList.contains('tambahCartBtn')) {
                    currentVal += 1;
                } else if (this.classList.contains('kurangCartBtn') && currentVal > 1) {
                    currentVal -= 1;
                } else {
                    return;
                }
                
                // Disable all controls to prevent double-clicks
                document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(btn => btn.disabled = true);
                
                fetch(`/keranjang/${itemId}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ jumlah: currentVal })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload page to perfectly refresh Blade data structure states
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message || 'Gagal memperbarui kuantitas.'
                        });
                        document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(btn => btn.disabled = false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan sistem.'
                    });
                    document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(btn => btn.disabled = false);
                });
            });
        });

        // Manual keyboard input typing handler (blocks 0 and updates DB on change)
        document.querySelectorAll('.jumlahCartInput').forEach(input => {
            // Instantly corrects typing values to prevent 0 or less
            input.addEventListener('input', function() {
                if (this.value !== "" && parseInt(this.value) < 1) {
                    this.value = 1;
                }
            });

            // Sends updated quantity when they finish typing or press Enter
            input.addEventListener('change', function() {
                const itemId = this.id.replace('jumlahCart', '');
                let currentVal = parseInt(this.value);
                
                if (isNaN(currentVal) || currentVal < 1) {
                    currentVal = 1;
                    this.value = 1;
                }

                // Disable buttons
                document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(btn => btn.disabled = true);
                
                fetch(`/keranjang/${itemId}/update`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ jumlah: currentVal })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: data.message || 'Gagal memperbarui kuantitas.'
                        });
                        document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(btn => btn.disabled = false);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan sistem.'
                    });
                    document.querySelectorAll('.kurangCartBtn, .tambahCartBtn').forEach(btn => btn.disabled = false);
                });
            });
        });
    });

    async function sendOrderToWhatsApp() {
        var keranjangItems = @json($keranjangItems);
        var totalBelanja = {{ $keranjangItems->sum('total_harga') }};

        let message = "Halo DelCafe, saya ingin memesan:\n\n";

        keranjangItems.forEach(item => {
            message += `*${item.menu.nama}*\n`;
            message += `   Jumlah: ${item.jumlah} Porsi\n`;
            message += `   Harga: Rp ${item.menu.harga}\n`;
            message += `   Subtotal: Rp ${item.total_harga.toLocaleString('id-ID')}\n\n`;
        });

        message += `*TOTAL PEMBAYARAN: Rp ${totalBelanja.toLocaleString('id-ID')}*\n\n`;
        message += `Atas nama: *{{ Auth::user()->name }}*\n\n`;
        message += "Bukti pembayaran QRIS telah saya bayar. Mohon segera dikonfirmasi. Terima kasih!";

        const phoneNumber = "6287844043032";
        const encodedMessage = encodeURIComponent(message);
        const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

        window.open(whatsappURL, '_blank');

        try {
            const response = await fetch('{{ route('userr.prosesPembayaranKeranjangWA') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    keranjangItems: keranjangItems,
                    totalBelanja: totalBelanja
                })
            });

            const data = await response.json();

            if (data.success) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                Toast.fire({
                    icon: 'success',
                    title: 'Pesanan berhasil dikirim!'
                });

                setTimeout(() => {
                    window.location.href = '{{ route('userr.riwayatPesanan') }}';
                }, 1500);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message,
                    confirmButtonColor: '#0d6efd'
                });
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memproses pesanan. Silakan hubungi admin.',
                confirmButtonColor: '#0d6efd'
            });
        }

        $('#confirmOrderModal').modal('hide');
    }
</script>

<style>
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        background-color: #f8fafc !important; /* Sleek light off-white background */
    }

    /* Hide default browser up/down number spinners for a clean, unified custom E-commerce interface */
    .jumlahCartInput::-webkit-outer-spin-button,
    .jumlahCartInput::-webkit-inner-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
    }

    .jumlahCartInput[type=number] {
        -moz-appearance: textfield !important;
    }

    body {
        font-family: 'Poppins', sans-serif;
    }

    .cart-page-section {
        position: relative !important;
        background: #f8fafc !important; /* Matches background */
        min-height: calc(100vh - 120px);
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding-top: 120px !important;
        padding-bottom: 80px !important;
    }

    .cart-card {
        background: #ffffff;
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 24px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.05); /* Modern very soft drop shadow */
        overflow: hidden;
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .cart-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #0d6efd 0%, #20c997 100%);
    }

    .cart-title {
        font-size: 1.6rem;
        font-weight: 700;
        color: #1e3c72;
        position: relative;
        display: inline-block;
    }

    .cart-title::after {
        content: '';
        position: absolute;
        width: 40px;
        height: 3px;
        background: #20c997;
        bottom: -4px;
        left: 0;
        border-radius: 2px;
    }

    /* Cart Container */
    .cart-table-container {
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 16px;
        background: #ffffff;
    }

    .hover-primary {
        transition: color 0.2s ease;
    }

    .hover-primary:hover {
        color: #0d6efd !important;
    }

    /* Styled Scrollbar inside card */
    .cart-table-container::-webkit-scrollbar {
        width: 6px;
    }
    
    .cart-table-container::-webkit-scrollbar-track {
        background: rgba(0, 0, 0, 0.02);
        border-radius: 10px;
    }
    
    .cart-table-container::-webkit-scrollbar-thumb {
        background: rgba(13, 110, 253, 0.2);
        border-radius: 10px;
    }

    .cart-table-container::-webkit-scrollbar-thumb:hover {
        background: rgba(13, 110, 253, 0.4);
    }

    /* Table elements styling */
    .table thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background-color: #f8f9fa;
        border-bottom: 2px solid rgba(0, 0, 0, 0.05);
    }

    .table thead th {
        font-weight: 700;
        color: #2a5298;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8f9fa;
        border: none;
    }

    .cart-row {
        transition: all 0.2s ease;
    }

    .cart-row:hover {
        background-color: rgba(13, 110, 253, 0.02) !important;
    }

    /* Image Thumbnail on Cart */
    .cart-img-wrapper {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.08);
        border: 2px solid #ffffff;
    }

    .cart-item-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .cart-row:hover .cart-item-img {
        transform: scale(1.1);
    }

    /* Quantity badge */
    .quantity-pill {
        background: rgba(13, 110, 253, 0.08) !important;
        border: 1.5px solid rgba(13, 110, 253, 0.15) !important;
        color: #0d6efd !important;
        border-radius: 30px;
        font-size: 0.85rem;
        display: inline-block;
    }

    /* Delete Button */
    .btn-delete-cart {
        background: transparent;
        border: none;
        color: #6c757d;
        font-size: 1.05rem;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .btn-delete-cart:hover {
        background: rgba(220, 53, 69, 0.08);
        color: #dc3545;
        transform: scale(1.08);
    }

    /* Summary block banner */
    .summary-banner {
        background: rgba(13, 110, 253, 0.04);
        border: 1.5px solid rgba(13, 110, 253, 0.08);
        border-radius: 16px;
    }

    .total-price-highlight {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0d6efd;
        text-shadow: 0 2px 10px rgba(13, 110, 253, 0.05);
    }

    /* Checkout & Back buttons */
    .btn-checkout-cart {
        background: linear-gradient(135deg, #20c997 0%, #0fa578 100%) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 50px !important;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s !important;
        box-shadow: 0 4px 12px rgba(32, 201, 151, 0.25) !important;
    }

    .btn-checkout-cart:hover {
        box-shadow: 0 6px 18px rgba(32, 201, 151, 0.4) !important;
        transform: translateY(-1.5px) !important;
        color: #ffffff !important;
    }

    .btn-back-menu {
        background: rgba(108, 117, 125, 0.08) !important;
        border: 1.5px solid rgba(108, 117, 125, 0.2) !important;
        color: #495057 !important;
        border-radius: 50px !important;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
    }

    .btn-back-menu:hover {
        background: rgba(108, 117, 125, 0.14) !important;
        color: #212529 !important;
        transform: translateY(-1.5px) !important;
    }

    /* Empty state styling */
    .empty-cart-container {
        position: relative;
        display: inline-block;
        margin-bottom: 10px;
    }

    .empty-badge {
        position: absolute;
        bottom: 2px;
        right: -2px;
        background-color: #dc3545;
        color: #ffffff;
        border: 2.5px solid #ffffff;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.65rem;
    }

    .btn-view-menu {
        background: linear-gradient(135deg, #0d6efd 0%, #0056b3 100%) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 50px !important;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s !important;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.25) !important;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
    }

    .btn-view-menu:hover {
        box-shadow: 0 6px 18px rgba(13, 110, 253, 0.4) !important;
        transform: translateY(-1.5px) !important;
        color: #ffffff !important;
    }

    /* SweetAlert2 Premium Overrides */
    .swal2-premium-popup {
        border-radius: 20px !important;
        font-family: 'Poppins', sans-serif !important;
        padding: 24px !important;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15) !important;
    }

    .swal2-premium-title {
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: #1e3c72 !important;
        margin-top: 10px !important;
    }

    .swal2-premium-confirm-btn {
        border-radius: 50px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        box-shadow: 0 4px 10px rgba(220, 53, 69, 0.25) !important;
    }

    .swal2-premium-cancel-btn {
        border-radius: 50px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 0.85rem !important;
        background-color: #6c757d !important;
        box-shadow: 0 4px 10px rgba(108, 117, 125, 0.25) !important;
    }

    /* Mobile responsive tweaks */
    @media (max-width: 991.98px) {
        html, body {
            overflow: auto !important; /* Re-enable scroll on mobile devices */
            height: auto !important;
        }

        .cart-page-section {
            min-height: 100vh;
            height: auto !important;
            padding: 100px 0 40px 0 !important;
            display: block !important;
        }

        .cart-card {
            max-height: none !important;
        }

        .cart-table-container {
            max-height: none !important;
            overflow-y: visible !important;
        }
    }
</style>

@include('layouts.footer')
