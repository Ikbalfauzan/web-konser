
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard User - KonserKu</title>
</head>
<body>

    @include('layouts.sidebar')

    <main class="main-content">
        <div class="mobile-header">
            <button id="sidebarToggle" type="button">☰ Menu</button>
            <strong>KonserKu.</strong>
        </div>

        <h1 class="page-title">Dashboard User</h1>
        <p class="page-description">
            Selamat datang, {{ auth()->user()->name }}!
            Temukan konser dan tiket favoritmu.
        </p>

        <div class="dashboard-card">
            <h2>Siap Nonton Konser? 🎵</h2>
            <p class="page-description">
                Cari acara musik favoritmu dan persiapkan pengalaman
                konser yang tidak terlupakan.
            </p>

            <a href="/"
               style="display:inline-block;margin-top:20px;
               padding:12px 20px;background:#9333ea;color:white;
               text-decoration:none;border-radius:8px">
                Jelajahi Konser
            </a>
        </div>
    </main>

</body>
</html>
