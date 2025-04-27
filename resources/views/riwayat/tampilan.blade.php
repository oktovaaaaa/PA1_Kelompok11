@extends('layouts.mainadmin')

@section('contents')
    <div class="container text-center pt-5 my-5">
        <h1>Riwayat Pesanan</h1>

        <div class="mt-4">
            <form action="{{ route('riwayat.tampilan') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Cari riwayat pemesanan..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-outline-primary">Cari</button>
            </form>
        </div>
        <br>

        @if (isset($riwayats) && $riwayats->isEmpty())
            <div class="alert alert-info mt-4">
                Tidak ada pesanan yang ditemukan "{{ request('search') }}".
            </div>
        @endif

        <table class="table pt-5 my-5">
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
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
