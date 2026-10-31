<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konser;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class TiketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');

        $pemesanan = Pemesanan::with(['user', 'konser'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })->orWhereHas('konser', function ($konserQuery) use ($search) {
                        $konserQuery->where('nama_konser', 'like', "%{$search}%");
                    });
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
        $totalTiket = Pemesanan::where('status', 'berhasil')->sum('jumlah_tiket');
        $totalBerhasil = Pemesanan::where('status', 'berhasil')->count();
        $totalDibatalkan = Pemesanan::where('status', 'dibatalkan')->count();

        return view('admin.tiket.index', compact(
            'pemesanan',
            'search',
            'status',
            'totalPesanan',
            'totalTiket',
            'totalBerhasil',
            'totalDibatalkan'
        ));
    }

    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $data = $request->validate([
            'status' => 'required|in:berhasil,dibatalkan',
        ]);

        DB::transaction(function () use ($pemesanan, $data) {
            $pesanan = Pemesanan::whereKey($pemesanan->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($pesanan->status === $data['status']) {
                return;
            }

            $konser = Konser::whereKey($pesanan->konser_id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($data['status'] === 'dibatalkan') {
                $konser->increment('stok_tiket', $pesanan->jumlah_tiket);
            } else {
                if ($konser->stok_tiket < $pesanan->jumlah_tiket) {
                    throw ValidationException::withMessages([
                        'status' => 'Stok tiket tidak cukup untuk mengaktifkan kembali pesanan ini.',
                    ]);
                }

                $konser->decrement('stok_tiket', $pesanan->jumlah_tiket);
            }

            $pesanan->update([
                'status' => $data['status'],
            ]);
        });

        return redirect()
            ->route('admin.tiket.index')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
