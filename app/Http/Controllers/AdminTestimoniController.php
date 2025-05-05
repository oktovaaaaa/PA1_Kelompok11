<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimoni;


class AdminTestimoniController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Testimoni::query(); 

        if ($search) {
            $query->where('nama', 'LIKE', '%' . $search . '%') // Cari di kolom 'nama'
                  ->orWhere('deskripsi', 'LIKE', '%' . $search . '%'); // Cari juga di kolom 'deskripsi'
        }

        $testimonis = $query->get(); // Eksekusi query dan ambil hasilnya
        // atau jika ingin pagination
        // $testimonis = $query->paginate(10);

        return view('testimonis.tampilan', compact('testimonis', 'search')); // Kirim $testimonis dan $search ke view
    }

    public function destroy(Testimoni $testimoni)
    {

        $testimoni->delete();
        return redirect()->route('testimonis.index')->with('success', 'Testimoni berhasil dihapus !');
    }
}
