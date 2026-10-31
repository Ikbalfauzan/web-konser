
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Konser - KonserKu</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #100d1c; color: #f5f3ff; font-family: Arial, sans-serif; }
        .main-content { margin-left: 260px; padding: 30px; }
        .panel { background: #1b162b; border: 1px solid #302744; border-radius: 14px; padding: 25px; max-width: 950px; }
        h1 { margin-top: 0; }
        .muted { color: #aaa3c4; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .field { display: flex; flex-direction: column; gap: 8px; }
        .field.full { grid-column: 1 / -1; }
        input, textarea { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #403456; background: #100d1c; color: white; font: inherit; }
        input[type=file] { padding: 10px; }
        label { font-size: 14px; color: #d8cfee; }
        .btn { display: inline-block; border: 0; border-radius: 8px; padding: 12px 17px; text-decoration: none; cursor: pointer; font-weight: bold; }
        .btn-primary { background: #8b5cf6; color: white; }
        .btn-cancel { background: #302744; color: white; }
        .form-actions { display: flex; gap: 10px; margin-top: 25px; }
        .alert { background: #4a1e2a; color: #fecdd3; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .mobile-header { display: none; }
        @media (max-width: 800px) {
            .main-content { margin-left: 0; padding: 18px; }
            .form-grid { grid-template-columns: 1fr; }
            .field.full { grid-column: auto; }
            .mobile-header { display: block; margin-bottom: 20px; }
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')

    <main class="main-content">
        <div class="mobile-header">
            <button class="btn btn-primary" id="sidebarToggle" type="button">☰ Menu</button>
        </div>

        <h1>Edit Konser</h1>
        <p class="muted">Perbarui informasi konser yang dipilih.</p>

        <section class="panel">
            <form action="{{ route('admin.konser.update', $konser) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @php($tombol = 'Simpan Perubahan')
                @include('admin.konser.form')
            </form>
        </section>
    </main>
</body>
</html>
