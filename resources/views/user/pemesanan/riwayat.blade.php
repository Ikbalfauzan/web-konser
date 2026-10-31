
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - KonserKu</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #100d1c; color: #f5f3ff; font-family: Arial, sans-serif; }
        .main-content { margin-left: 260px; padding: 30px; }
        h1 { margin-top: 0; }
        .muted { color: #aaa3c4; }
        .panel { background: #1b162b; border: 1px solid #302744; border-radius: 14px; padding: 20px; margin-top: 24px; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 650px; }
        th, td { text-align: left; padding: 14px 10px; border-bottom: 1px solid #302744; }
        th { color: #c4b5fd; }
        .status { display: inline-block; padding: 6px 10px; border-radius: 20px; font-size: 12px; }
        .berhasil { background: #153c31; color: #a7f3d0; }
        .dibatalkan { background: #4a1e2a; color: #fecdd3; }
        .menunggu { background: #493819; color: #fde68a; }
        .mobile-header { display: none; }
        @media (max-width:800px) {
            .main-content { margin-left: 0; padding: 18px; }
            .mobile-header { display: block; margin-bottom: 20px; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')

    <main class="main-content">
        <div class="mobile-header">
            <button class="btn" id="sidebarToggle" type="button">☰ Menu</button>
        </div>

        <h1>🧾 Riwayat Pesanan</h1>
        <p class="muted">Lihat seluruh pesanan tiket yang pernah kamu buat.</p>

        <section class="panel">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Konser</th>
                        <th>Tanggal Pesan</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemesanan as $item)
                        <tr>
                            <td>KK-{{ str_pad((string) $item->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $item->konser?->nama_konser ?? 'Konser tidak tersedia' }}</td>
                            <td>{{ $item->created_at->format('d-m-Y H:i') }}</td>
                            <td>{{ $item->jumlah_tiket }}</td>
                            <td>Rp {{ number_format((float) $item->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <span class="status {{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center;padding:30px;">
                                Belum ada riwayat pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{ $pemesanan->links() }}
        </section>
    </main>
</body>
</html>
