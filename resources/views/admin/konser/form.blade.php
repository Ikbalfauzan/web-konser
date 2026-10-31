
@if ($errors->any())
    <div class="alert error">
        <strong>Periksa kembali data berikut:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-grid">
    <div class="field">
        <label for="nama_konser">Nama Konser</label>
        <input
            id="nama_konser"
            name="nama_konser"
            value="{{ old('nama_konser', $konser?->nama_konser) }}"
            required
        >
    </div>

    <div class="field">
        <label for="artis">Nama Artis</label>
        <input
            id="artis"
            name="artis"
            value="{{ old('artis', $konser?->artis) }}"
            required
        >
    </div>

    <div class="field">
        <label for="lokasi">Lokasi Konser</label>
        <input
            id="lokasi"
            name="lokasi"
            value="{{ old('lokasi', $konser?->lokasi) }}"
            required
        >
    </div>

    <div class="field">
        <label for="tanggal">Tanggal dan Waktu</label>
        <input
            id="tanggal"
            type="datetime-local"
            name="tanggal"
            value="{{ old('tanggal', $konser?->tanggal?->format('Y-m-d\TH:i')) }}"
            required
        >
    </div>

    <div class="field">
        <label for="harga_tiket">Harga Tiket (Rp)</label>
        <input
            id="harga_tiket"
            type="number"
            name="harga_tiket"
            min="0"
            step="1000"
            value="{{ old('harga_tiket', $konser?->harga_tiket) }}"
            required
        >
    </div>

    <div class="field">
        <label for="stok_tiket">Stok Tiket</label>
        <input
            id="stok_tiket"
            type="number"
            name="stok_tiket"
            min="0"
            value="{{ old('stok_tiket', $konser?->stok_tiket ?? 0) }}"
            required
        >
    </div>

    <div class="field full">
        <label for="deskripsi">Deskripsi Konser</label>
        <textarea id="deskripsi" name="deskripsi" rows="5">{{ old('deskripsi', $konser?->deskripsi) }}</textarea>
    </div>

    <div class="field full">
        <label for="poster">Poster Konser (JPG, PNG, WEBP; maksimal 2 MB)</label>
        <input
            id="poster"
            type="file"
            name="poster"
            accept=".jpg,.jpeg,.png,.webp"
        >

        @if ($konser?->poster)
            <p class="muted">Poster saat ini:</p>
            <img
                src="{{ asset('storage/' . $konser->poster) }}"
                alt="Poster konser"
                style="width:130px;border-radius:10px"
            >
        @endif
    </div>
</div>

<div class="form-actions">
    <button class="btn btn-primary" type="submit">{{ $tombol }}</button>
    <a class="btn btn-cancel" href="{{ route('admin.konser.index') }}">Batal</a>
</div>
