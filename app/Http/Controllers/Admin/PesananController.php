<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $pesanan = Pemesanan::with(['user', 'konser'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })->orWhereHas('konser', function ($konserQuery) use ($search) {
                        $konserQuery->where('nama_konser', 'like', "%{$search}%");
                    })->orWhere('id', $search);
                });
            })
            ->when(
                in_array($status, ['berhasil', 'dibatalkan'], true),
                fn ($query) => $query->where('status', $status)
            )
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalPesanan = Pemesanan::count();

        $pesananBerhasil = Pemesanan::where('status', 'berhasil')->count();

        $pesananDibatalkan = Pemesanan::where('status', 'dibatalkan')->count();

        $totalPendapatan = Pemesanan::where('status', 'berhasil')
            ->sum('total_harga');

        return view('admin.pesanan.index', compact(
            'pesanan',
            'search',
            'status',
            'totalPesanan',
            'pesananBerhasil',
            'pesananDibatalkan',
            'totalPendapatan'
        ));
    }
}