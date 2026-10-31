
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya - KonserKu</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #100d1c; color: #f5f3ff; font-family: Arial, sans-serif; }
        .main-content { margin-left: 260px; padding: 30px; }
        h1 { margin-top: 0; }
        .muted { color: #aaa3c4; }
        .panel { background: #1b162b; border: 1px solid #302744; border-radius: 14px; padding: 20px; margin-top: 24px; }
        .alert { background: #153c31; color: #a7f3d0; padding: 13px; border-radius: 8px; }
        .ticket { border-bottom: 1px solid #302744; padding: 18px 0; }
        .ticket:last-child { border-bottom: 0; }
        .ticket h3 { margin: 0 0 10px; }
        .info { color: #d1c9e2; line-height: 1.8; }
        .status { display: inline-block; color: #86efac; background: #153c31; padding: 6px 10px; border-radius: 20px; font-size: 12px; }
        .empty { text-align: center; padding: 35px 10px; }
        .btn { display: inline-block; background: #8b5cf6; color: white; padding: 11px 16px; border-radius: 8px; text-decoration: none; }
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

        <h1>🎟️ Tiket Saya</h1>
        <p class="muted">Daftar tiket konser yang berhasil kamu pesan.</p>

        @if (session('success'))
            <p class="alert">{{ session('success') }}</p>
        @endif

        <section class="panel">
            @forelse ($pemesanan as $item)
                <article class="ticket">
                    <h3>{{ $item->konser?->nama_konser ?? 'Konser tidak tersedia' }}</h3>

                    <div class="info">
                        Artis: {{ $item->konser?->artis ?? '-' }}<br>
                        Lokasi: {{ $item->konser?->lokasi ?? '-' }}<br>
                        Tanggal:
                        {{ $item->konser?->tanggal?->format('d M Y, H:i') ?? '-' }}<br>
                        Jumlah tiket: {{ $item->jumlah_tiket }}<br>
                        Total harga: Rp {{ number_format((float) $item->total_harga, 0, ',', '.') }}<br>
                        Kode pesanan: KK-{{ str_pad((string) $item->id, 6, '0', STR_PAD_LEFT) }}
                    </div>

                    <p><span class="status">Pesanan Berhasil</span></p>
                </article>
            @empty
                <div class="empty">
                    <h2>Belum Ada Tiket</h2>
                    <p class="muted">Kamu belum memesan tiket konser.</p>
                    <a href="{{ route('user.konser.index') }}" class="btn">
                        Cari Konser
                    </a>
                </div>
            @endforelse

            {{ $pemesanan->links() }}
        </section>
    </main>
</body>
</html>
