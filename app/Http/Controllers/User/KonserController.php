<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Konser;

class KonserController extends Controller
{
    public function index()
    {
        $konser = Konser::where('stok_tiket', '>', 0)
            ->orderBy('tanggal', 'asc')
            ->paginate(9);

        return view('user.konser.index', compact('konser'));
    }

    public function show(Konser $konser)
    {
        return view('user.konser.show', compact('konser'));
    }
}