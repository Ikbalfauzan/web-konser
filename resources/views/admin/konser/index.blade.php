
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Konser - KonserKu</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: #100d1c;
            color: #f5f3ff;
            font-family: Arial, sans-serif;
        }
        .main-content { margin-left: 260px; padding: 30px; }
        .page-header {
            display: flex; justify-content: space-between;
            align-items: center; gap: 15px; margin-bottom: 25px;
        }
        h1 { margin: 0 0 8px; }
        .muted { color: #aaa3c4; }
        .btn {
            display: inline-block; padding: 11px 16px; border: 0;
            border-radius: 9px; text-decoration: none; cursor: pointer;
            font-weight: bold; font-size: 14px;
        }
        .btn-primary { background: #8b5cf6; color: white; }
        .btn-edit { background: #31264e; color: #d8c8ff; }
        .btn-delete { background: #57223b; color: #fecdd3; }
        .panel {
            background: #1b162b; border: 1px solid #302744;
            border-radius: 14px; padding: 20px; margin-bottom: 20px;
        }
        .alert {
            padding: 13px 16px; border-radius: 9px; margin-bottom: 18px;
        }
        .success { background: #153c31; color: #a7f3d0; }
        .error { background: #4a1e2a; color: #fecdd3; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 850px; }
        th, td {
            text-align: left; padding: 15px 12px;
            border-bottom: 1px solid #302744; vertical-align: middle;
        }
        th { color: #b9a9df; font-size: 13px; }
        .poster {
            width: 65px; height: 75px; object-fit: cover;
            border-radius: 8px; background: #302744;
        }
        .actions { display: flex; gap: 8px; align-items: center; }
        .actions form { margin: 0; }
        .pagination { margin-top: 20px; }
        .mobile-header { display: none; }
        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 18px; }
            .page-header { align-items: flex-start; flex-direction: column; }
            .mobile-header { display: block; margin-bottom: 20px; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')

    <main class="main-content">
        <div class="mobile-header">
            <button class="btn btn-primary" id="sidebarToggle" type="button">
                ☰ Menu
            </button>
        </div>

        <div class="page-header">
            <div>
                <h1>Kelola Konser</h1>
                <p class="muted">Atur informasi konser dan ketersediaan tiket.</p>
            </div>
            <a href="{{ route('admin.konser.create') }}" class="btn btn-primary">
                + Tambah Konser
            </a>
        </div>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                Ada data yang belum valid. Periksa kembali formulir konser.
            </div>
        @endif

        <section class="panel">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Poster</th>
                            <th>Nama Konser</th>
                            <th>Artis</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Harga Tiket</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($konser as $item)
                            <tr>
                                <td>
                                    @if ($item->poster)
                                        <img
                                            class="poster"
                                            src="{{ asset('storage/' . $item->poster) }}"
                                            alt="Poster {{ $item->nama_konser }}"
                                        >
                                    @else
                                        <div class="poster"></div>
                                    @endif
                                </td>
                                <td><strong>{{ $item->nama_konser }}</strong></td>
                                <td>{{ $item->artis }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>{{ $item->tanggal->format('d-m-Y H:i') }}</td>
                                <td>Rp {{ number_format((float) $item->harga_tiket, 0, ',', '.') }}</td>
                                <td>{{ $item->stok_tiket }}</td>
                                <td>
                                    <div class="actions">
                                        <a
                                            class="btn btn-edit"
                                            href="{{ route('admin.konser.edit', $item) }}"
                                        >Edit</a>

                                        <form
                                            action="{{ route('admin.konser.destroy', $item) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus konser ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-delete" type="submit">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:35px">
                                    Belum ada data konser. Klik tombol Tambah Konser untuk memulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $konser->links() }}
            </div>
        </section>
    </main>
</body>
</html>
