
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">K</div>
        <div>
            <h2>KonserKu<span>.</span></h2>
            <small>Concert Ticket Platform</small>
        </div>
    </div>

    <div class="sidebar-profile">
        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="profile-info">
            <strong>{{ auth()->user()->name }}</strong>
            <small>
                {{ auth()->user()->role === 'admin' ? 'Administrator' : 'Member' }}
            </small>
        </div>
    </div>

    <div class="sidebar-label">MENU UTAMA</div>

    <nav class="sidebar-menu">
        @if (auth()->user()->role === 'admin')

            <a href="/admin/dashboard"
               class="menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>

           <a href="{{ route('admin.konser.index') }}"
   class="menu-item {{ request()->is('admin/konser*') ? 'active' : '' }}">
    <span class="menu-icon">🎤</span>
    <span>Kelola Konser</span>
</a>

            
<a href="{{ route('admin.tiket.index') }}"
   class="menu-item {{ request()->is('admin/tiket*') ? 'active' : '' }}">
    <span class="menu-icon">🎟️</span>
    <span>Kelola Tiket</span>
</a>

            

           
<a href="{{ route('admin.pesanan.index') }}"
   class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : '' }}">
    <span class="menu-icon">📋</span>
    <span>Data Pesanan</span>
</a>


           <a href="{{ route('admin.users.index') }}"
   class="menu-item {{ request()->is('admin/users*') ? 'active' : '' }}">
    <span class="menu-icon">♙</span>
    <span>Data User</span>
</a>

        @else

            <a href="/user/dashboard"
               class="menu-item {{ request()->is('user/dashboard') ? 'active' : '' }}">
                <span class="menu-icon">▦</span>
                <span>Dashboard</span>
            </a>

           
<a href="{{ route('user.konser.index') }}"
   class="menu-item {{ request()->is('user/konser*') ? 'active' : '' }}">
    <span class="menu-icon">🎤</span>
    <span>Daftar Konser</span>
</a>


           
<a href="{{ route('user.tiket.index') }}"
   class="menu-item {{ request()->is('user/tiket-saya*') ? 'active' : '' }}">
    <span class="menu-icon">▤</span>
    <span>Tiket Saya</span>
</a>

<a href="{{ route('user.pemesanan.riwayat') }}"
   class="menu-item {{ request()->is('user/riwayat-pesanan*') ? 'active' : '' }}">
    <span class="menu-icon">◷</span>
    <span>Riwayat Pesanan</span>
</a>


            <a href="/user/profil"
               class="menu-item {{ request()->is('user/profil*') ? 'active' : '' }}">
                <span class="menu-icon">♙</span>
                <span>Profil Saya</span>
            </a>

        @endif
    </nav>

    <div class="sidebar-bottom">
        <div class="help-card">
            <strong>Butuh Bantuan?</strong>
            <p>Pastikan kamu tidak ketinggalan konser favoritmu.</p>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">
                <span class="menu-icon">↪</span>
                Logout
            </button>
        </form>
    </div>
</aside>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: #0d0d16;
        color: #f8fafc;
    }

    .sidebar {
        position: fixed;
        inset: 0 auto 0 0;
        z-index: 100;
        width: 260px;
        height: 100vh;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        padding: 25px 18px;
        background: #141421;
        border-right: 1px solid #29293c;
        transition: transform .3s ease;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 0 5px 25px;
        border-bottom: 1px solid #29293c;
    }

    .brand-icon {
        display: grid;
        place-items: center;
        width: 43px;
        height: 43px;
        border-radius: 12px;
        color: white;
        font-size: 25px;
        font-weight: bold;
        background: linear-gradient(135deg, #9333ea, #d946ef);
    }

    .sidebar-brand h2 {
        margin: 0;
        font-size: 22px;
    }

    .sidebar-brand h2 span {
        color: #c084fc;
    }

    .sidebar-brand small,
    .profile-info small {
        display: block;
        color: #9292aa;
        font-size: 11px;
        margin-top: 5px;
    }

    .sidebar-profile {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 23px 5px;
    }

    .avatar {
        width: 43px;
        height: 43px;
        flex-shrink: 0;
        display: grid;
        place-items: center;
        border-radius: 50%;
        color: #e9d5ff;
        background: #542486;
        font-size: 19px;
        font-weight: bold;
    }

    .profile-info {
        min-width: 0;
    }

    .profile-info strong {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 155px;
        font-size: 14px;
    }

    .sidebar-label {
        color: #77778f;
        font-size: 11px;
        font-weight: bold;
        letter-spacing: 1.3px;
        padding: 5px 10px 13px;
    }

    .sidebar-menu {
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .menu-item {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 13px 14px;
        border-radius: 9px;
        color: #b7b7ca;
        text-decoration: none;
        font-size: 14px;
        transition: .2s;
    }

    .menu-item:hover {
        background: #222235;
        color: white;
    }

    .menu-item.active {
        background: linear-gradient(100deg, #7629ba, #9333ea);
        color: white;
        box-shadow: 0 5px 15px #9333ea22;
    }

    .menu-icon {
        width: 21px;
        flex-shrink: 0;
        text-align: center;
        font-size: 19px;
    }

    .sidebar-bottom {
        margin-top: auto;
        padding-top: 25px;
    }

    .help-card {
        padding: 15px;
        margin-bottom: 18px;
        background: #1d1a2e;
        border: 1px solid #39304e;
        border-radius: 11px;
    }

    .help-card strong {
        font-size: 13px;
        color: #d8b4fe;
    }

    .help-card p {
        margin: 8px 0 0;
        color: #a7a4bb;
        font-size: 12px;
        line-height: 1.6;
    }

    .logout-button {
        display: flex;
        align-items: center;
        gap: 13px;
        width: 100%;
        padding: 13px 14px;
        border: 1px solid #383044;
        border-radius: 9px;
        background: transparent;
        color: #fca5a5;
        font-size: 14px;
        cursor: pointer;
        text-align: left;
    }

    .logout-button:hover {
        background: #3a1c2b;
    }

    .sidebar-overlay {
        display: none;
    }

    .main-content {
        margin-left: 260px;
        min-height: 100vh;
        padding: 35px;
    }

    .mobile-header {
        display: none;
    }

    .page-title {
        margin: 0 0 8px;
        font-size: 28px;
    }

    .page-description {
        margin: 0;
        color: #a5a5ba;
        line-height: 1.7;
    }

    .dashboard-card {
        margin-top: 28px;
        padding: 25px;
        background: #171724;
        border: 1px solid #29293c;
        border-radius: 14px;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.open {
            transform: translateX(0);
        }

        .sidebar-overlay.show {
            display: block;
            position: fixed;
            inset: 0;
            z-index: 90;
            background: #0009;
        }

        .main-content {
            margin-left: 0;
            padding: 20px;
        }

        .mobile-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 28px;
        }

        .mobile-header button {
            padding: 9px 12px;
            background: #222235;
            color: white;
            border: 1px solid #39394e;
            border-radius: 8px;
            cursor: pointer;
        }

        .page-title {
            font-size: 24px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle = document.getElementById('sidebarToggle');

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        }

        if (toggle) {
            toggle.addEventListener('click', function () {
                sidebar.classList.toggle('open');
                overlay.classList.toggle('show');
            });
        }

        overlay.addEventListener('click', closeSidebar);
    });
</script>
