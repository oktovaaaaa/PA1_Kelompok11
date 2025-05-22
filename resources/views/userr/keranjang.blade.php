@extends('layouts.main')
@section('title', 'DelCafe - Keranjang')

@include('layouts.navbar')


<br><br>
<div class="container section-title pt-5 mt-5" data-aos="fade-up">
    <br>
    <h2>Keranjang</h2>


    <div class="card-body p-0">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        {{-- Asumsi kode ini berada di dalam struktur layout Bootstrap seperti container, row, dan column --}}

        @if (count($keranjangItems) > 0)
            {{-- MULAI: Pindahkan *SEMUANYA* yang memberikan tampilan card ke sini --}}
            <div class="mb-4"> {{-- ATAU kelas lain yang memberikan efek card --}}
                <div class="card">
                    <div class="card-body">

                        {{-- Isi keranjang (tabel, total, tombol) tetap di dalam card-body --}}
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="ps-4">Menu</th>
                                        <th scope="col" class="text-center">Jumlah</th>
                                        <th scope="col" class="text-end pe-4">Harga Satuan</th>
                                        <th scope="col" class="text-end pe-4">Subtotal</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($keranjangItems as $item)
                                        <tr class="border-top">
                                            <td class="ps-4">
                                                <h6 class="mb-0">{{ $item->menu->nama }}</h6>
                                                <small class="text-muted">{{ $item->menu->kategori }}</small>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                                    {{ $item->jumlah }}
                                                </span>
                                            </td>
                                            <td class="text-end pe-4">
                                                Rp {{ number_format($item->menu->harga, 0, ',', '.') }}
                                            </td>
                                            <td class="text-end pe-4 fw-bold">
                                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('userr.hapusKeranjang', $item->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-outline-danger btn-sm rounded-circle"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-light p-4 mt-4">
                            <div class="row align-items-center">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle text-primary me-2 fs-5"></i>
                                        <p class="mb-0 text-muted">Pastikan pesanan Anda sudah benar sebelum melakukan
                                            pembayaran.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="mb-0">Total:</h4>
                                        <h3 class="mb-0 text-primary">
                                            Rp {{ number_format($keranjangItems->sum('total_harga'), 0, ',', '.') }}
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between p-4">
                            <a href="{{ route('userr.menu') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-chevron-left me-2"></i> Kembali ke Menu
                            </a>
                            <button type="button" class="btn btn-success btn-lg px-4" data-bs-toggle="modal"
                                data-bs-target="#confirmOrderModal">
                                <i class="fas fa-wallet me-2"></i> Bayar Sekarang
                            </button>
                        </div>

                    </div> {{-- SELESAI: Tutup card-body di sini --}}
                </div> {{-- SELESAI: Tutup card di sini --}}
            </div> {{-- SELESAI: Tutup div mb-4 (ATAU KELAS LAIN) di sini --}}
        @else
            {{-- Konten keranjang kosong dipindahkan ke luar struktur card --}}
            <div class="text-center py-5 my-5">
                <div class="empty-cart-icon mb-4">
                    <i class="fas fa-shopping-cart fa-5x text-muted opacity-25"></i>
                    <div class="empty-cart-overlay">
                        <i class="fas fa-ban fa-3x text-danger"></i>
                    </div>
                </div>
                <h3 class="text-muted mb-3">Keranjang Anda kosong</h3>
                <p class="text-muted mb-4">Mulai belanja dan temukan menu favorit Anda</p>
                <a href="{{ route('userr.menu') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-utensils me-2"></i> Lihat Menu
                </a>
            </div>
        @endif

        {{-- Tag penutup </div> dari elemen layout luar yang membungkus @if... @else --}}
    </div>
</div>
</div>

{{-- DEFINISI MODAL (posisinya sepertinya di luar 3 div penutup di atas) --}}
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
                    <img src="{{ asset('assets/img/barcode.jpeg') }}" class="img-fluid animated w-50 mx-auto d-block"
                        alt="QRIS Code"> {{-- Tambahkan alt text --}}
                </div>

                <div class="alert alert-info">
                    <i class="fas fa-info-circle me-2"></i> Pastikan data pesanan dan nomor WhatsApp Anda
                    benar.<br><b>Scan dengan Qris untuk melakukan pembayaran</b>
                </div>

                <div class="border rounded p-3 mb-3">
                    <h6 class="fw-bold mb-3">Detail Pesanan:</h6>
                    <ul class="list-unstyled mb-0">
                        @foreach ($keranjangItems as $item)
                            <li class="d-flex justify-content-between py-1">
                                <span>{{ $item->menu->nama }} ({{ $item->jumlah }}x)</span>
                                <span>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span class="text-primary">Rp
                            {{ number_format($keranjangItems->sum('total_harga'), 0, ',', '.') }}</span>
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
                {{-- Pastikan fungsi sendOrderToWhatsApp() sudah didefinisikan di JavaScript Anda --}}
                <button type="button" class="btn btn-primary" onclick="sendOrderToWhatsApp()">
                    <i class="fab fa-whatsapp me-2"></i> Lanjutkan ke WhatsApp
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Tag penutup </div> terakhir yang ada di kode Anda, letakkan di sini --}}
</div>

@include('layouts.footer')

<style>
    .empty-cart-icon {
        position: relative;
        display: inline-block;
    }

    .empty-cart-overlay {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });

    async function sendOrderToWhatsApp() {
        var keranjangItems = @json($keranjangItems);
        var totalBelanja = {{ $keranjangItems->sum('total_harga') }};

        let message = "Halo DelCafe, saya ingin memesan:\n\n";

        keranjangItems.forEach(item => {
            message += `${item.menu.nama}\n`;
            message += `   Jumlah: ${item.jumlah}\n`;
            message += `   Harga: Rp ${item.menu.harga.toLocaleString('id-ID')}\n`;
            message += `   Subtotal: Rp ${item.total_harga.toLocaleString('id-ID')}\n\n`;
        });

        message += `*TOTAL PEMBAYARAN: Rp ${totalBelanja.toLocaleString('id-ID')}*\n\n`;
        message += `Atas nama: *{{ Auth::user()->name }}*\n\n`;
        message += "Mohon konfirmasi ketersediaan menu dan total yang harus dibayarkan. Terima kasih!";

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
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Pesanan berhasil dikirim!'
                })

                setTimeout(() => {
                    window.location.href = '{{ route('userr.riwayatPesanan') }}';
                }, 1500);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message
                })
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Gagal memproses pesanan. Silakan coba lagi.'
            })
        }

        $('#confirmOrderModal').modal('hide');
    }
</script>


dellp
