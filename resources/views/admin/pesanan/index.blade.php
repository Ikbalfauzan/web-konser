
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pesanan - KonserKu</title>

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

        .stats {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
            margin: 25px 0;
        }

        .stat-card, .panel {
            background: #1b162b;
            border: 1px solid #302744;
            border-radius: 14px;
            padding: 20px;
        }

        .stat-label { color: #aaa3c4; font-size: 13px; }
        .stat-number { font-size: 24px; font-weight: bold; margin-top: 10px; }
        .filters { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px; }

        input, select {
            padding: 11px;
            border: 1px solid #403456;
            border-radius: 8px;
            background: #100d1c;
            color: white;
            font-size: 14px;
        }

        input { flex: 1; min-width: 200px; }

        .btn {
            display: inline-block;
            border: none;
            border-radius: 8px;
            padding: 11px 15px;
            text-decoration: none;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-primary { background: #8b5cf6; color: white; }
        .btn-neutral { background: #302744; color: white; }

        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 900px; }

        th, td {
            padding: 14px 10px;
            text-align: left;
            border-bottom: 1px solid #302744;
            vertical-align: top;
            font-size: 14px;
        }

        th { color: #c4b5fd; }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .berhasil { background: #153c31; color: #a7f3d0; }
        .dibatalkan { background: #4a1e2a; color: #fecdd3; }

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

        <h1>📋 Data Pesanan</h1>
        <p class="muted">
            Lihat dan pantau semua pesanan tiket dari pengguna KonserKu.
        </p>

        <section class="stats">
            <div class="stat-card">
                <div class="stat-label">Total Pesanan</div>
                <div class="stat-number">{{ $totalPesanan }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Pesanan Berhasil</div>
                <div class="stat-number">{{ $pesananBerhasil }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Pesanan Dibatalkan</div>
                <div class="stat-number">{{ $pesananDibatalkan }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-label">Total Nilai Pesanan Berhasil</div>
                <div class="stat-number" style="font-size:20px">
                    Rp {{ number_format((float) $totalPendapatan, 0, ',', '.') }}
                </div>
            </div>
        </section>

        <section class="panel">
            <form action="{{ route('admin.pesanan.index') }}" method="GET" class="filters">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama user, email, konser, atau ID pesanan..."
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

                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-neutral">
                    Reset
                </a>
            </form>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Kode Pesanan</th>
                            <th>Nama Pemesan</th>
                            <th>Konser</th>
                            <th>Jumlah Tiket</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pesan</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($pesanan as $item)
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
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="text-align:center;padding:30px;">
                                    Belum ada data pesanan.
                                    Pesanan akan muncul setelah user memesan tiket.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                {{ $pesanan->links() }}
            </div>
        </section>
    </main>
</body>
</html>
