
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin - KonserKu</title>
</head>
<body>

    @include('layouts.sidebar')

    <main class="main-content">
        <div class="mobile-header">
            <button id="sidebarToggle" type="button">☰ Menu</button>
            <strong>KonserKu.</strong>
        </div>

        <h1 class="page-title">Dashboard Admin</h1>
        <p class="page-description">
            Selamat datang, {{ auth()->user()->name }}!
            Kelola aktivitas website tiket konser di sini.
        </p>

        <div class="dashboard-card">
            <h2>Halo, Admin! 👋</h2>
            <p class="page-description">
                Gunakan menu di sebelah kiri untuk mengelola konser,
                tiket, pesanan, dan data pengguna.
            </p>
        </div>
    </main>

</body>
</html>
