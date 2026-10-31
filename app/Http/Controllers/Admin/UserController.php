<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan daftar pengguna
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users', 'search'));
    }

    // Menghapus akun user
    public function destroy(User $user)
    {
        // Admin tidak boleh dihapus melalui menu ini
        if ($user->role !== 'user') {
            return back()->with(
                'error',
                'Hanya akun user yang dapat dihapus dari menu ini.'
            );
        }

        // Tidak boleh menghapus akun sendiri
        if ($user->id === auth()->id()) {
            return back()->with(
                'error',
                'Kamu tidak dapat menghapus akun sendiri.'
            );
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Akun user berhasil dihapus.');
    }
}