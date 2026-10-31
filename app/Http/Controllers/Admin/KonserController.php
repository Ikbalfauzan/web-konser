<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Konser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KonserController extends Controller
{
    public function index()
    {
        $konser = Konser::latest()->paginate(10);

        return view('admin.konser.index', compact('konser'));
    }

    public function create()
    {
        return view('admin.konser.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_konser' => 'required|string|max:255',
            'artis' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga_tiket' => 'required|numeric|min:0',
            'stok_tiket' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')
                ->store('poster-konser', 'public');
        }

        Konser::create($data);

        return redirect()
            ->route('admin.konser.index')
            ->with('success', 'Konser berhasil ditambahkan.');
    }

    public function edit(Konser $konser)
    {
        return view('admin.konser.edit', compact('konser'));
    }

    public function update(Request $request, Konser $konser)
    {
        $data = $request->validate([
            'nama_konser' => 'required|string|max:255',
            'artis' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'harga_tiket' => 'required|numeric|min:0',
            'stok_tiket' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
            'poster' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            if ($konser->poster) {
                Storage::disk('public')->delete($konser->poster);
            }

            $data['poster'] = $request->file('poster')
                ->store('poster-konser', 'public');
        }

        $konser->update($data);

        return redirect()
            ->route('admin.konser.index')
            ->with('success', 'Data konser berhasil diperbarui.');
    }

    public function destroy(Konser $konser)
    {
        if ($konser->poster) {
            Storage::disk('public')->delete($konser->poster);
        }

        $konser->delete();

        return redirect()
            ->route('admin.konser.index')
            ->with('success', 'Konser berhasil dihapus.');
    }
}