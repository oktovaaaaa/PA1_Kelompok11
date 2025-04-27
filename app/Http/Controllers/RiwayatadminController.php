<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User; // Import model User

class RiwayatadminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Pesanan::query();

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhere('daftar_menu', 'LIKE', '%' . $search . '%');
        }

        $semuaRiwayatPesanan = $query->with('user')->get();

        return view('riwayat.tampilan', compact('semuaRiwayatPesanan'));
    }

    public function approveRejectPesanan(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:berhasil,ditolak',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        if ($pesanan->status != 'menunggu') {
            return redirect()->back()->with('error', 'Pesanan ini tidak dapat diubah statusnya.');
        }

        $action = $request->input('action');
        $pesanan->status = $action;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diubah menjadi ' . $action);
    }
}
