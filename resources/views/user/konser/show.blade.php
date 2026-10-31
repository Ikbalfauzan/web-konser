
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $konser->nama_konser }} - KonserKu</title>

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

        .back {
            display: inline-block;
            color: #c4b5fd;
            text-decoration: none;
            margin-bottom: 24px;
        }

        .detail-card {
            max-width: 950px;
            background: #1b162b;
            border: 1px solid #302744;
            border-radius: 16px;
            overflow: hidden;
        }

        .poster {
            display: block;
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            background: #302744;
        }

        .no-poster {
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 65px;
            background: linear-gradient(135deg, #38215e, #171126);
        }

        .detail-body { padding: 28px; }

        .artist { color: #c4b5fd; }

        h1 { margin: 8px 0 20px; }

        .info {
            color: #d1c9e2;
            line-height: 1.9;
            margin: 20px 0;
        }

        .price {
            color: #c4b5fd;
            font-size: 25px;
            font-weight: bold;
        }

        .description {
            color: #d1c9e2;
            line-height: 1.8;
            white-space: pre-line;
        }

        .stock { color: #86efac; }

        .btn {
            display: inline-block;
            background: #8b5cf6;
            color: white;
            padding: 12px 18px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 12px;
        }

        .mobile-header { display: none; }

        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 18px; }
            .detail-body { padding: 20px; }
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

        <a href="{{ route('user.konser.index') }}" class="back">
            ← Kembali ke Daftar Konser
        </a>

        <article class="detail-card">
            @if ($konser->poster)
                <img
                    class="poster"
                    src="{{ asset('storage/' . $konser->poster) }}"
                    alt="Poster {{ $konser->nama_konser }}"
                >
            @else
                <div class="no-poster">🎵</div>
            @endif

            <div class="detail-body">
                <p class="artist">{{ $konser->artis }}</p>

                <h1>{{ $konser->nama_konser }}</h1>

                <div class="info">
                    <div>📍 Lokasi: {{ $konser->lokasi }}</div>
                    <div>📅 Tanggal: {{ $konser->tanggal->format('d M Y, H:i') }} WIB</div>
                </div>

                <p class="price">
                    Rp {{ number_format((float) $konser->harga_tiket, 0, ',', '.') }}
                </p>

               
@if ($konser->stok_tiket > 0 && !$konser->tanggal->isPast())
    <p class="stock">
        🎟️ Tiket tersedia: {{ $konser->stok_tiket }}
    </p>

    <form
        action="{{ route('user.konser.pesan', $konser) }}"
        method="POST"
        style="margin: 20px 0;"
    >
        @csrf

        <label for="jumlah_tiket" style="display:block;margin-bottom:8px;">
            Jumlah Tiket
        </label>

        <input
            type="number"
            id="jumlah_tiket"
            name="jumlah_tiket"
            min="1"
            max="{{ min(10, $konser->stok_tiket) }}"
            value="{{ old('jumlah_tiket', 1) }}"
            required
            style="width:100%;max-width:250px;padding:12px;border-radius:8px;border:1px solid #403456;background:#100d1c;color:white;"
        >

        @error('jumlah_tiket')
            <p style="color:#fda4af;">{{ $message }}</p>
        @enderror

        <p style="color:#c4b5fd;margin-top:14px;">
            Total harga:
            <strong id="totalHarga">
                Rp {{ number_format((float) $konser->harga_tiket, 0, ',', '.') }}
            </strong>
        </p>

        <button type="submit" class="btn">
            Pesan Tiket
        </button>
    </form>
@else
    <p style="color:#fda4af;">
        Tiket sudah habis atau tanggal konser telah lewat.
    </p>
@endif


                <h3>Deskripsi Konser</h3>

                <p class="description">{{ $konser->deskripsi ?: 'Belum ada deskripsi untuk konser ini.' }}</p>

                <a href="{{ route('user.konser.index') }}" class="btn">
                    Kembali ke Daftar Konser
                </a>
            </div>
        </article>
    </main>
    <script>
    const jumlahInput = document.getElementById('jumlah_tiket');
    const totalHarga = document.getElementById('totalHarga');

    if (jumlahInput && totalHarga) {
        const hargaPerTiket = {{ (float) $konser->harga_tiket }};

        function hitungTotal() {
            const jumlah = Math.max(0, Number(jumlahInput.value) || 0);
            const total = jumlah * hargaPerTiket;

            totalHarga.textContent = 'Rp ' + new Intl.NumberFormat('id-ID', {
                maximumFractionDigits: 0
            }).format(total);
        }

        jumlahInput.addEventListener('input', hitungTotal);
        hitungTotal();
    }
</script>
</body>
</html>
