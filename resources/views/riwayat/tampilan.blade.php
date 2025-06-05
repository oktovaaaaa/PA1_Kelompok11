@extends('layouts.mainadmin')

@section('contents')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <div class="container text-center pt-5 my-5">
        <h1>Riwayat Pesanan</h1>

        <div class="mt-4">
            <form action="{{ route('riwayat.tampilan') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="search" class="form-control me-2" style="max-width: 300px;"
                    placeholder="Cari riwayat pemesanan..." value="{{ request('search') }}">
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

        @if (isset($semuaRiwayatPesanan) && $semuaRiwayatPesanan->isEmpty() && request('search'))
            <div class="alert alert-info mt-4 d-flex justify-content-center">
                Tidak ada pesanan yang ditemukan "{{ request('search') }}".
            </div>
        @endif

        @if (isset($semuaRiwayatPesanan) && count($semuaRiwayatPesanan) > 0)
            <div class="table-responsive">
                <table class="table table-striped pt-5 my-5">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama User</th>
                            <th>Daftar Menu</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($semuaRiwayatPesanan as $pesanan)
                            <tr>
                                <td>{{ $pesanan->id }}</td>
                                <td>{{ $pesanan->user->name }}</td>
                                <td>
                                    <ul>
                                        @foreach(json_decode($pesanan->daftar_menu, true) as $menu)
                                            <li>{{ $menu['nama'] }} ({{ $menu['jumlah'] }} x Rp {{ number_format($menu['harga_satuan'], 0, ',', '.') }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($pesanan->status == 'menunggu')
                                        <span class="badge bg-warning text-dark">{{ ucfirst($pesanan->status) }}</span>
                                    @elseif($pesanan->status == 'berhasil')
                                        <span class="badge bg-success">{{ ucfirst($pesanan->status) }}</span>
                                    @elseif($pesanan->status == 'ditolak')
                                        <span class="badge bg-danger">{{ ucfirst($pesanan->status) }}</span>
                                    @else
                                        {{ ucfirst($pesanan->status) }}
                                    @endif
                                </td>
                                <td>{{ $pesanan->created_at }}</td>
                                <td>
@if($pesanan->status == 'menunggu')
    <form action="{{ route('admin.approveRejectPesanan', $pesanan->id) }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="action" value="berhasil">
        <button type="submit" class="btn btn-success btn-sm">Approve</button>
    </form>
    <form action="{{ route('admin.approveRejectPesanan', $pesanan->id) }}" method="POST" class="d-inline">
        @csrf
        <input type="hidden" name="action" value="ditolak">
        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
    </form>
@elseif($pesanan->status == 'berhasil' || $pesanan->status == 'ditolak')
    @include('riwayat.delete')
@endif

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <div class="py-5">
                    <i class="fas fa-history fa-3x text-secondary mb-4"></i>
                    <h5 class="fw-medium text-secondary">Belum ada riwayat pesanan</h5>
                    <p class="text-muted">Riwayat pesanan akan muncul di sini</p>
                </div>
            </div>
        @endif
    </div>
@endsection
