@extends('layouts.main')
@section('title', 'DelCafe - Keranjang')

@include('layouts.navbar')

<div class="container section-title pt-5 mt-5" data-aos="fade-up">
    <br>
    <h2>Keranjang</h2>
    <br>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(count($keranjangItems) > 0)
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nama Menu</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keranjangItems as $item)
                        <tr>
                            <td>{{ $item->menu->nama }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>Rp {{ $item->menu->harga }}</td>
                            <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('userr.hapusKeranjang', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <h4 class="mb-0">Total Belanja: Rp {{ number_format($keranjangItems->sum('total_harga'), 0, ',', '.') }}</h4>
            <button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#confirmOrderModal">Bayar Sekarang</button>
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('userr.menu') }}" class="btn btn-outline-secondary">Kembali ke Menu</a>
        </div>
    @else
        <div class="text-center py-5">
            <h3 class="text-muted">Keranjang Anda masih kosong.</h3>
            <a href="{{ route('userr.menu') }}" class="btn btn-secondary mt-3">Mulai Belanja</a>
        </div>
    @endif

</div>

<!-- Modal Konfirmasi Pesanan -->
<div class="modal fade" id="confirmOrderModal" tabindex="-1" aria-labelledby="confirmOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmOrderModalLabel">Konfirmasi Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin memesan barang-barang ini?</p>
                <img src="{{ asset('assets/images/delivery.png') }}" alt="Ilustrasi Pengiriman" class="img-fluid mb-3">
                <p>Total Belanja: Rp {{ number_format($keranjangItems->sum('total_harga'), 0, ',', '.') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <!-- Tombol Kirim ke WhatsApp -->
                <button type="button" class="btn btn-primary" onclick="sendOrderToWhatsApp()">Kirim ke WhatsApp</button>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script>
    async function sendOrderToWhatsApp() {
        // Ambil data keranjang dari PHP ke JavaScript
        var keranjangItems = @json($keranjangItems);
        var totalBelanja = {{ $keranjangItems->sum('total_harga') }};

        // Format pesan WhatsApp
        let message = "Halo, saya ingin memesan:\n";

        keranjangItems.forEach(item => {
            message += `- ${item.menu.nama} (${item.jumlah} x Rp ${item.menu.harga}) = Rp ${item.total_harga}\n`;
        });

        message += `\nTotal: Rp ${totalBelanja}\n`;
        message += "Mohon segera diproses. Terima kasih!";

        // Nomor WhatsApp tujuan (ganti dengan nomor Anda)
        const phoneNumber = "62881080811110";

        // Encode pesan agar aman dalam URL
        const encodedMessage = encodeURIComponent(message);

        // Buat URL WhatsApp
        const whatsappURL = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

        // Buka URL di tab baru
        window.open(whatsappURL, '_blank');

        try {
            // Kirim permintaan AJAX ke server untuk memproses pesanan
            const response = await fetch('{{ route('userr.prosesPembayaranKeranjangWA') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Tambahkan CSRF token
                },
                body: JSON.stringify({
                    keranjangItems: keranjangItems,
                    totalBelanja: totalBelanja
                })
            });

            const data = await response.json();

            if (data.success) {
                // Pesan berhasil diproses dan keranjang dikosongkan
                alert(data.message); // Tampilkan pesan sukses
                window.location.href = '{{ route('userr.riwayatPesanan') }}'; // Redirect ke riwayat pesanan
            } else {
                // Terjadi kesalahan
                alert(data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat memproses pesanan.');
        }


        // Tutup modal setelah mengirim
        $('#confirmOrderModal').modal('hide');
    }
</script>
