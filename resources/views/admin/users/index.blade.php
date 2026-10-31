
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data User - KonserKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #0d0d16;
            color: #f8fafc;
            font-family: Arial, sans-serif;
        }

        .main-content {
            margin-left: 260px;
            padding: 35px;
            min-height: 100vh;
        }

        .mobile-header {
            display: none;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 28px;
        }

        .page-header h1 {
            margin: 0 0 8px;
            font-size: 28px;
        }

        .page-header p {
            margin: 0;
            color: #a5a5ba;
            font-size: 14px;
        }

        .badge-admin {
            display: inline-block;
            color: #d8b4fe;
            background: #9333ea22;
            border: 1px solid #9333ea55;
            border-radius: 20px;
            padding: 8px 14px;
            font-size: 12px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 18px;
            margin-bottom: 25px;
        }

        .stat-card {
            padding: 22px;
            background: #171724;
            border: 1px solid #29293c;
            border-radius: 13px;
        }

        .stat-card p {
            margin: 0 0 12px;
            color: #a5a5ba;
            font-size: 13px;
        }

        .stat-card h2 {
            margin: 0;
            font-size: 27px;
        }

        .stat-card .purple {
            color: #c084fc;
        }

        .panel {
            background: #171724;
            border: 1px solid #29293c;
            border-radius: 14px;
            overflow: hidden;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            padding: 22px;
            border-bottom: 1px solid #303044;
        }

        .panel-header h2 {
            margin: 0 0 6px;
            font-size: 19px;
        }

        .panel-header p {
            margin: 0;
            color: #a5a5ba;
            font-size: 13px;
        }

        .search-form {
            display: flex;
            gap: 8px;
        }

        .search-form input {
            width: 230px;
            max-width: 100%;
            padding: 11px 13px;
            background: #0d0d16;
            border: 1px solid #38384e;
            border-radius: 8px;
            color: white;
            outline: none;
        }

        .search-form input:focus {
            border-color: #a855f7;
        }

        .btn {
            display: inline-block;
            padding: 11px 15px;
            background: linear-gradient(135deg, #9333ea, #c026d3);
            color: white;
            border: 0;
            border-radius: 8px;
            text-decoration: none;
            font-size: 13px;
            cursor: pointer;
        }

        .btn-secondary {
            background: #29293c;
            border: 1px solid #414157;
        }

        .table-wrap {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            white-space: nowrap;
        }

        th {
            padding: 16px 20px;
            text-align: left;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .5px;
            color: #a5a5ba;
            background: #141421;
        }

        td {
            padding: 17px 20px;
            border-top: 1px solid #29293c;
            font-size: 13px;
        }

        tbody tr:hover {
            background: #202032;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            background: #542486;
            color: #f3e8ff;
            border-radius: 10px;
            font-size: 15px;
            font-weight: bold;
        }

        .user-name {
            font-weight: bold;
            color: #f8fafc;
        }

        .user-email {
            color: #a5a5ba;
            margin-top: 5px;
        }

        .role {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
        }

        .role-user {
            background: #164e63;
            color: #a5f3fc;
        }

        .role-admin {
            background: #581c87;
            color: #e9d5ff;
        }

        .delete-btn {
            padding: 8px 11px;
            border: 1px solid #7f1d1d;
            border-radius: 7px;
            background: #3b151b;
            color: #fca5a5;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-btn:hover {
            background: #7f1d1d;
            color: white;
        }

        .protected-label {
            color: #77778f;
            font-size: 12px;
        }

        .alert {
            padding: 13px 16px;
            margin-bottom: 18px;
            border-radius: 9px;
            font-size: 14px;
        }

        .alert-success {
            background: #123528;
            color: #86efac;
            border: 1px solid #166534;
        }

        .alert-error {
            background: #3b151b;
            color: #fca5a5;
            border: 1px solid #7f1d1d;
        }

        .empty {
            padding: 45px 20px;
            text-align: center;
            color: #a5a5ba;
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            padding: 20px;
            border-top: 1px solid #303044;
            color: #a5a5ba;
            font-size: 13px;
        }

        .pagination-links {
            display: flex;
            gap: 7px;
            flex-wrap: wrap;
        }

        .pagination-links a,
        .pagination-links span {
            display: inline-block;
            padding: 8px 11px;
            border: 1px solid #38384e;
            border-radius: 6px;
            color: #ddd6fe;
            text-decoration: none;
        }

        .pagination-links .current {
            background: #9333ea;
            border-color: #9333ea;
            color: white;
        }

        .pagination-links .disabled {
            opacity: .4;
        }

        @media (max-width: 768px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }

            .mobile-header {
                display: flex;
                align-items: center;
                gap: 15px;
                margin-bottom: 25px;
            }

            .mobile-header button {
                padding: 9px 12px;
                background: #222235;
                color: white;
                border: 1px solid #39394e;
                border-radius: 8px;
                cursor: pointer;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .stats {
                grid-template-columns: 1fr;
                gap: 12px;
            }

            .panel-header {
                align-items: stretch;
                flex-direction: column;
            }

            .search-form input {
                width: 100%;
                min-width: 0;
            }
        }
    </style>
</head>
<body>

    @include('layouts.sidebar')

    <main class="main-content">

        <div class="mobile-header">
            <button id="sidebarToggle" type="button">☰ Menu</button>
            <strong>KonserKu.</strong>
        </div>

        <div class="page-header">
            <div>
                <h1>Data User</h1>
                <p>Kelola dan pantau akun pengguna KonserKu.</p>
            </div>

            <span class="badge-admin">● Admin Panel</span>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- KARTU STATISTIK -->
        <div class="stats">
            <div class="stat-card">
                <p>Total Semua Akun</p>
                <h2 class="purple">{{ \App\Models\User::count() }}</h2>
            </div>

            <div class="stat-card">
                <p>Total User</p>
                <h2>{{ \App\Models\User::where('role', 'user')->count() }}</h2>
            </div>

            <div class="stat-card">
                <p>Total Admin</p>
                <h2>{{ \App\Models\User::where('role', 'admin')->count() }}</h2>
            </div>
        </div>

        <!-- TABEL DATA -->
        <section class="panel">

            <div class="panel-header">
                <div>
                    <h2>Daftar Pengguna</h2>
                    <p>Informasi akun yang terdaftar di sistem.</p>
                </div>

                <form action="{{ route('admin.users.index') }}"
                      method="GET" class="search-form">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari nama atau email..."
                    >

                    <button class="btn" type="submit">Cari</button>

                    @if ($search)
                        <a href="{{ route('admin.users.index') }}"
                           class="btn btn-secondary">Reset</a>
                    @endif
                </form>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pengguna</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>
                                    {{ $users->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="user-cell">
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div>
                                            <div class="user-name">
                                                {{ $user->name }}
                                            </div>
                                            <div class="user-email">
                                                {{ $user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="role role-admin">
                                            ADMIN
                                        </span>
                                    @else
                                        <span class="role role-user">
                                            USER
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $user->created_at
                                        ? $user->created_at->format('d/m/Y H:i')
                                        : '-' }}
                                </td>

                                <td>
                                    @if ($user->role === 'user')
                                        <form
                                            action="{{ route('admin.users.destroy', $user) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus akun {{ addslashes($user->name) }}?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button class="delete-btn" type="submit">
                                                Hapus
                                            </button>
                                        </form>
                                    @else
                                        <span class="protected-label">
                                            Dilindungi
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="empty">
                                    Data pengguna tidak ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="pagination">
                <div>
                    @if ($users->total() > 0)
                        Menampilkan {{ $users->firstItem() }}–{{ $users->lastItem() }}
                        dari {{ $users->total() }} akun
                    @else
                        Tidak ada akun ditemukan
                    @endif
                </div>

                <div class="pagination-links">
                    @if ($users->onFirstPage())
                        <span class="disabled">← Sebelumnya</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}">
                            ← Sebelumnya
                        </a>
                    @endif

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}">
                            Berikutnya →
                        </a>
                    @else
                        <span class="disabled">Berikutnya →</span>
                    @endif
                </div>
            </div>

        </section>

    </main>

</body>
</html>
