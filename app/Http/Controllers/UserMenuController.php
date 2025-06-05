<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class UserMenuController extends Controller
{
public function index(Request $request)
{
    $search = $request->input('search');
    $query = Menu::query();

    if ($search) {
        $query->where('nama', 'like', '%' . $search . '%')
              ->orWhere('deskripsi', 'like', '%' . $search . '%');
    }

    $menus = $query->paginate(8)->appends(['search' => $search]);

    return view('userr.menu', compact('menus', 'search'));
}
}

