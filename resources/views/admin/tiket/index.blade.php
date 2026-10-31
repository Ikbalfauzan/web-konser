
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Tiket - KonserKu</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: #100d1c;
            color: #f5f3ff;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 260px;
            padding: 30px;
        }

        h1 { margin: 0 0 8px; }
        .muted { color: #aaa3c4; }

        .page-header { margin-bottom: 25px; }

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin-bottom: 22px;
        }

        .stat-card, .panel {
            background: #1b162b;
            border: 1px solid #302744;
            border-radius: 14px;
            padding: 20px;
        }

        .stat-label { color: #aaa3c4; font-size: 13px; }
        .stat-number { font-size: 26px; font-weight: bold; margin-top: 10px; }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }

        input, select {
            background: #100d1c;
            color: white;
            border: 1px solid #403456;
            border-radius: 8px;
            padding: 11px;
            font-size: 14px;
        }

        input { flex: 1; min-width: 180px; }

        .btn {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            padding: 10px 13px;
            cursor: pointer;
            text-decoration: none;
            font-weight: bold;
            font-size: 13px;
        }

        .btn-primary { background: #8b5cf6; color: white; }
        .btn-cancel { background: #57223b; color: #fecdd3; }
        .btn-neutral { background: #302744; color: white; }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 950px; }
        th, td {
            text-align: left;
            padding: 14px 10px;
            border-bottom: 1px solid #302744;
            vertical-align: top;
        }
        th { color: #c4b5fd; font-size: 13px; }
        td { font-size: 14px; }

        .status {
            display: inline-block;
            border-radius: 20px;
            padding: 6px 9px;
            font-size: 12px;
            font-weight: bold;
        }

        .berhasil { background: #153c31; color: #a7f3d0; }
        .dibatalkan { background: #4a1e2a; color: #fecdd3; }

        .alert {
            padding: 13px 16px;
            border-radius: 9px;
            margin-bottom: 18px;
        }

        .success { background: #153c31; color: #a7f3d0; }
        .error { background: #4a1e2a; color: #fecdd3; }

        .pagination { margin-top: 20px; }
        .mobile-header { display: none; }

        @media (max-width: 1100px) {
            .stats { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 18px; }
            .mobile-header { display: block; margin-bottom: 20px; }
            .stats { grid-template-columns: 1fr 1fr; }
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
            <h1>🎟️ Kelola Tiket</h1>
            <p class="muted">
                Pantau pesanan tiket yang dibuat oleh pengguna KonserKu.
            </p>
        </div>

        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <section class="stats">
            <div class="stat-card">
                <div class="stat-label">Total Pesanan</div>
                <div class="stat-number">{{ $totalPesanan }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Tiket dalam Pesanan Aktif</div>
                <div class="stat-number">{{ $totalTiket }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Pesanan Berhasil</div>
                <div class="stat-number">{{ $totalBerhasil }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Pesanan Dibatalkan</div>
                <div class="stat-number">{{ $totalDibatalkan }}</div>
            </div>
        </section>

        <section class="panel">
            <form action="{{ route('admin.tiket.index') }}" method="GET" class="filters">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama user, email, atau konser..."
                    value="{{ $search }}"
                >

                <select name="status">
                    <option value="">Semua Status</option>
                    <option value="berhasil" @selected($status === 'berhasil')>
                        Berhasil
                    </option>
                    <option value="dibatalkan" @selected($status === 'dibatalkan')>
                        Dibatalkan
                    </option>
                </select>

                <button type="submit" class="btn btn-primary">Cari</button>
                <a href="{{ route('admin.tiket.index') }}" class="btn btn-neutral">
                    Reset
                </a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Pemesan</th>
                            <th>Konser</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pemesanan as $item)
                            <tr>
                                <td>
                                    <strong>
                                        KK-{{ str_pad((string) $item->id, 6, '0', STR_PAD_LEFT) }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $item->user?->name ?? 'Akun tidak tersedia' }}<br>
                                    <span class="muted">
                                        {{ $item->user?->email ?? '-' }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->konser?->nama_konser ?? 'Konser tidak tersedia' }}<br>
                                    <span class="muted">
                                        {{ $item->konser?->artis ?? '-' }}
                                    </span>
                                </td>

                                <td>{{ $item->jumlah_tiket }} tiket</td>

                                <td>
                                    Rp {{ number_format((float) $item->total_harga, 0, ',', '.') }}
                                </td>

                                <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>

                                <td>
                                    <span class="status {{ $item->status }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>

                                <td>
                                    @if ($item->status === 'berhasil')
                                        <form
                                            action="{{ route('admin.tiket.updateStatus', $item) }}"
                                            method="POST"
                                            onsubmit="return confirm('Batalkan pesanan ini? Stok tiket akan dikembalikan.')"
                                        >
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="dibatalkan">

                                            <button type="submit" class="btn btn-cancel">
                                                Batalkan
                                            </button>
                                        </form>
                                    @else
                                        <form
                                            action="{{ route('admin.tiket.updateStatus', $item) }}"
                                            method="POST"
                                            onsubmit="return confirm('Aktifkan kembali pesanan ini? Stok tiket akan dikurangi kembali.')"
                                        >
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="berhasil">

                                            <button type="submit" class="btn btn-primary">
                                                Aktifkan
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="text-align:center;padding:30px;">
                                    Belum ada data pesanan tiket.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $pemesanan->links() }}
            </div>
        </section>
    </main>
</body>
</html>
