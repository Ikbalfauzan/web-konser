
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Konser - KonserKu</title>

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

        h1 { margin: 0 0 10px; }

        .subtitle {
            color: #aaa3c4;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .concert-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 22px;
        }

        .concert-card {
            background: #1b162b;
            border: 1px solid #302744;
            border-radius: 15px;
            overflow: hidden;
            transition: transform .2s;
        }

        .concert-card:hover {
            transform: translateY(-4px);
        }

        .poster {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
            background: #302744;
        }

        .no-poster {
            height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #38215e, #171126);
            font-size: 50px;
        }

        .card-body { padding: 18px; }

        .artist {
            color: #bba2ff;
            font-size: 14px;
            margin: 0 0 10px;
        }

        .concert-name {
            font-size: 20px;
            margin: 0 0 14px;
            overflow-wrap: anywhere;
        }

        .info {
            color: #c5bfd8;
            font-size: 14px;
            line-height: 1.8;
            margin-bottom: 8px;
        }

        .price {
            color: #c4b5fd;
            font-size: 20px;
            font-weight: bold;
            margin: 15px 0;
        }

        .stock {
            font-size: 13px;
            color: #86efac;
            margin-bottom: 16px;
        }

        .btn {
            display: inline-block;
            width: 100%;
            text-align: center;
            background: #8b5cf6;
            color: white;
            padding: 12px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
        }

        .btn:hover { background: #7c3aed; }

        .empty {
            background: #1b162b;
            border: 1px solid #302744;
            border-radius: 15px;
            padding: 45px 20px;
            text-align: center;
            color: #c5bfd8;
        }

        .empty-icon { font-size: 48px; }

        .pagination { margin-top: 25px; }

        .mobile-header { display: none; }

        @media (max-width: 1100px) {
            .concert-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        }

        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 18px; }
            .concert-grid { grid-template-columns: 1fr; }
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

        <h1>🎤 Daftar Konser</h1>
        <p class="subtitle">
            Temukan konser favoritmu dan lihat informasi tiket yang tersedia.
        </p>

        @if (session('success'))
            <p>{{ session('success') }}</p>
        @endif

        @if ($konser->count() > 0)
            <div class="concert-grid">
                @foreach ($konser as $item)
                    <article class="concert-card">
                        @if ($item->poster)
                            <img
                                class="poster"
                                src="{{ asset('storage/' . $item->poster) }}"
                                alt="Poster {{ $item->nama_konser }}"
                            >
                        @else
                            <div class="no-poster">🎵</div>
                        @endif

                        <div class="card-body">
                            <p class="artist">{{ $item->artis }}</p>

                            <h2 class="concert-name">
                                {{ $item->nama_konser }}
                            </h2>

                            <div class="info">
                                📍 {{ $item->lokasi }}<br>
                                📅 {{ $item->tanggal->format('d M Y, H:i') }} WIB
                            </div>

                            <p class="price">
                                Rp {{ number_format((float) $item->harga_tiket, 0, ',', '.') }}
                            </p>

                            <p class="stock">
                                🎟️ Tersedia {{ $item->stok_tiket }} tiket
                            </p>

                            <a
                                class="btn"
                                href="{{ route('user.konser.show', $item) }}"
                            >
                                Lihat Detail
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="pagination">
                {{ $konser->links() }}
            </div>
        @else
            <div class="empty">
                <div class="empty-icon">🎵</div>
                <h2>Belum Ada Konser Tersedia</h2>
                <p>
                    Saat ini belum ada tiket konser yang tersedia.
                    Silakan cek kembali nanti.
                </p>
            </div>
        @endif
    </main>
</body>
</html>
