<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Konser;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PemesananController extends Controller
{
    public function store(Request $request, Konser $konser)
    {
        $data = $request->validate([
            'jumlah_tiket' => 'required|integer|min:1|max:10',
        ], [
            'jumlah_tiket.required' => 'Jumlah tiket wajib diisi.',
            'jumlah_tiket.integer' => 'Jumlah tiket harus berupa angka bulat.',
            'jumlah_tiket.min' => 'Minimal pemesanan adalah 1 tiket.',
            'jumlah_tiket.max' => 'Maksimal pemesanan adalah 10 tiket sekali pesan.',
        ]);

        DB::transaction(function () use ($konser, $data) {
            $konserTerkunci = Konser::whereKey($konser->id)
                ->lockForUpdate()
                ->firstOrFail();

            $jumlah = (int) $data['jumlah_tiket'];

            if ($konserTerkunci->tanggal->isPast()) {
                throw ValidationException::withMessages([
                    'jumlah_tiket' => 'Konser ini sudah lewat dan tidak bisa dipesan.',
                ]);
            }

            if ($konserTerkunci->stok_tiket < $jumlah) {
                throw ValidationException::withMessages([
                    'jumlah_tiket' => 'Stok tiket tidak mencukupi. Stok saat ini: '
                        . $konserTerkunci->stok_tiket . ' tiket.',
                ]);
            }

            $totalHarga = $jumlah * (float) $konserTerkunci->harga_tiket;

            Pemesanan::create([
                'user_id' => auth()->id(),
                'konser_id' => $konserTerkunci->id,
                'jumlah_tiket' => $jumlah,
                'total_harga' => $totalHarga,
                'status' => 'berhasil',
            ]);

            $konserTerkunci->decrement('stok_tiket', $jumlah);
        });

        return redirect()
            ->route('user.tiket.index')
            ->with('success', 'Pemesanan tiket berhasil! Cek tiket kamu di menu Tiket Saya.');
    }

    public function tiketSaya()
    {
        $pemesanan = Pemesanan::with('konser')
            ->where('user_id', auth()->id())
            ->where('status', 'berhasil')
            ->latest()
            ->paginate(10);

        return view('user.tiket.index', compact('pemesanan'));
    }

    public function riwayat()
    {
        $pemesanan = Pemesanan::with('konser')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('user.pemesanan.riwayat', compact('pemesanan'));
    }
}