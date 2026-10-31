
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - KonserKu</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 20px;
            font-family: Arial, sans-serif;
            background: #0d0d16;
            color: white;
        }
        .card {
            width: 100%;
            max-width: 420px;
            padding: 32px;
            background: #191927;
            border: 1px solid #303044;
            border-radius: 18px;
        }
        h1 { color: #c084fc; margin-bottom: 8px; }
        p { color: #b5b5c8; }
        label { display: block; margin: 18px 0 8px; }
        input {
            width: 100%;
            padding: 13px;
            background: #0d0d16;
            border: 1px solid #414157;
            border-radius: 8px;
            color: white;
        }
        button {
            width: 100%;
            padding: 13px;
            margin-top: 24px;
            background: linear-gradient(135deg, #9333ea, #d946ef);
            color: white;
            border: 0;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
        }
        a { color: #c084fc; }
        .error { color: #fca5a5; font-size: 14px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>KonserKu.</h1>
        <h2>Selamat Datang!</h2>
        <p>Login untuk melanjutkan ke akun kamu.</p>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <p class="error">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">
            @csrf

            <label for="email">Email</label>
            <input id="email" type="email" name="email"
                   value="{{ old('email') }}" required>

            <label for="password">Password</label>
            <input id="password" type="password"
                   name="password" required>

            <button type="submit">Login</button>
        </form>

        <p>Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>

        <a href="/">← Kembali ke landing page</a>
    </div>
</body>
</html>
