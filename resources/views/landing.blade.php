
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KonserKu - Tiket Konser Online</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #0d0d16;
            color: #ffffff;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        /* NAVBAR */
        header {
            background: #12121e;
            border-bottom: 1px solid #28283b;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        nav {
            min-height: 75px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo {
            font-size: 26px;
            font-weight: bold;
            color: #c084fc;
        }

        .logo span {
            color: white;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
        }

        .nav-links a {
            color: #d1d1e0;
            font-size: 14px;
            transition: 0.3s;
        }

        .nav-links a:hover {
            color: #c084fc;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #9333ea, #d946ef);
            color: white;
            padding: 12px 22px;
            border-radius: 9px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px #9333ea44;
        }

        /* HERO */
        .hero {
            min-height: 540px;
            display: flex;
            align-items: center;
            background:
                linear-gradient(90deg, #0d0d16 12%,
                rgba(13,13,22,0.90) 43%,
                rgba(13,13,22,0.2) 100%),
                url('https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=1600&q=85')
                center/cover;
        }

        .hero-content {
            max-width: 650px;
            padding: 80px 0;
        }

        .tagline {
            display: inline-block;
            color: #d8b4fe;
            background: #9333ea22;
            border: 1px solid #9333ea55;
            border-radius: 30px;
            padding: 7px 15px;
            font-size: 12px;
            letter-spacing: 1px;
            margin-bottom: 22px;
        }

        .hero h1 {
            font-size: clamp(36px, 5vw, 62px);
            line-height: 1.15;
            margin-bottom: 22px;
        }

        .hero h1 span {
            color: #c084fc;
        }

        .hero p {
            color: #c0c0d0;
            font-size: 17px;
            max-width: 530px;
            margin-bottom: 28px;
        }

        /* SEARCH */
        .search-box {
            display: flex;
            gap: 10px;
            background: #1b1b2b;
            border: 1px solid #34344b;
            padding: 9px;
            border-radius: 12px;
            max-width: 540px;
        }

        .search-box input {
            flex: 1;
            min-width: 0;
            background: transparent;
            border: none;
            outline: none;
            padding: 10px;
            color: white;
            font-size: 14px;
        }

        .search-box input::placeholder {
            color: #a5a5ba;
        }

        /* SECTION */
        section {
            padding: 75px 0;
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
        }

        .section-heading h2 {
            font-size: 30px;
        }

        .section-heading p {
            color: #b5b5c8;
            font-size: 14px;
            margin-top: 5px;
        }

        .text-link {
            color: #c084fc;
            white-space: nowrap;
        }

        /* KATEGORI */
        .categories {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 35px;
        }

        .category {
            padding: 10px 20px;
            border-radius: 30px;
            border: 1px solid #35354a;
            color: #d1d1e0;
            background: #171724;
            font-size: 14px;
        }

        .category.active,
        .category:hover {
            background: #9333ea;
            border-color: #9333ea;
            color: white;
        }

        /* KARTU KONSER */
        .concert-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .concert-card {
            background: #171724;
            border: 1px solid #29293c;
            border-radius: 15px;
            overflow: hidden;
            transition: 0.3s;
        }

        .concert-card:hover {
            transform: translateY(-6px);
            border-color: #9333ea;
        }

        .concert-image {
            height: 220px;
            position: relative;
            overflow: hidden;
        }

        .concert-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 0.4s;
        }

        .concert-card:hover img {
            transform: scale(1.06);
        }

        .concert-label {
            position: absolute;
            top: 14px;
            left: 14px;
            background: #9333ea;
            padding: 6px 12px;
            font-size: 12px;
            border-radius: 20px;
        }

        .concert-info {
            padding: 20px;
        }

        .concert-info h3 {
            font-size: 19px;
            margin-bottom: 12px;
        }

        .concert-info p {
            color: #b5b5c8;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .concert-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #303044;
        }

        .price {
            color: #c084fc;
            font-weight: bold;
            font-size: 15px;
        }

        .btn-small {
            padding: 9px 13px;
            font-size: 12px;
        }

        /* BANNER */
        .banner {
            background:
                linear-gradient(120deg, #581c87, #9333ea, #be185d);
            border-radius: 20px;
            padding: 55px 30px;
            text-align: center;
        }

        .banner h2 {
            font-size: clamp(25px, 4vw, 36px);
            margin-bottom: 12px;
        }

        .banner p {
            color: #f3e8ff;
            margin-bottom: 25px;
        }

        .banner .btn {
            background: white;
            color: #7e22ce;
        }

        /* FOOTER */
        footer {
            background: #090910;
            border-top: 1px solid #29293c;
            padding: 30px 0;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
            color: #a5a5ba;
            font-size: 13px;
        }

        /* RESPONSIVE HP */
        @media (max-width: 850px) {
            .concert-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .nav-links {
                gap: 14px;
            }

            .nav-links a:not(.btn) {
                display: none;
            }
        }

        @media (max-width: 560px) {
            .hero {
                min-height: 500px;
                background-position: center;
            }

            .hero-content {
                padding: 60px 0;
            }

            .hero p {
                font-size: 15px;
            }

            .search-box {
                flex-direction: column;
            }

            .search-box .btn {
                width: 100%;
            }

            section {
                padding: 50px 0;
            }

            .section-heading h2 {
                font-size: 23px;
            }

            .concert-grid {
                grid-template-columns: 1fr;
            }

            .concert-image {
                height: 230px;
            }

            .logo {
                font-size: 22px;
            }

            .banner {
                padding: 40px 20px;
            }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <header>
        <div class="container">
            <nav>
                <a href="#" class="logo">
                    Konser<span>Ku.</span>
                </a>

                <div class="nav-links">
                    <a href="#home">Beranda</a>
                    <a href="#konser">Daftar Konser</a>
                    <a href="#tentang">Tentang Kami</a>
                    <a href="/login" class="btn">Masuk</a>
                </div>
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <main>
        <div class="hero" id="home">
            <div class="container">
                <div class="hero-content">
                    <span class="tagline">
                        YOUR LIVE MUSIC EXPERIENCE
                    </span>

                    <h1>
                        Rasakan Musiknya.
                        <span>Hidupkan Momennya.</span>
                    </h1>

                    <p>
                        Temukan konser favoritmu dan dapatkan tiketnya
                        dengan mudah. Nikmati pengalaman musik yang
                        tidak terlupakan bersama KonserKu.
                    </p>

                    <form action="#konser" method="GET"
                          class="search-box">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari nama konser atau artis..."
                        >
                        <button type="submit" class="btn">
                            Cari Konser
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- DAFTAR KONSER -->
        <section id="konser">
            <div class="container">

                <div class="section-heading">
                    <div>
                        <h2>Konser Pilihan</h2>
                        <p>
                            Temukan acara musik yang cocok buat kamu.
                        </p>
                    </div>

                    <a href="#konser" class="text-link">
                        Lihat semua →
                    </a>
                </div>

                <div class="categories">
                    <a href="#konser" class="category active">
                        Semua
                    </a>
                    <a href="#konser" class="category">
                        Pop
                    </a>
                    <a href="#konser" class="category">
                        Rock
                    </a>
                    <a href="#konser" class="category">
                        Festival
                    </a>
                    <a href="#konser" class="category">
                        Indie
                    </a>
                </div>

                <div class="concert-grid">

                    <!-- KONSER 1 -->
                    <article class="concert-card">
                        <div class="concert-image">
                            <img
                                src="https://images.unsplash.com/photo-1501386761578-eac5c94b800a?auto=format&fit=crop&w=800&q=80"
                                alt="Konser musik festival"
                            >
                            <span class="concert-label">
                                Populer
                            </span>
                        </div>

                        <div class="concert-info">
                            <h3>Music Festival 2026</h3>
                            <p>📅 15 November 2026</p>
                            <p>📍 Jakarta</p>

                            <div class="concert-bottom">
                                <div>
                                    <p>Mulai dari</p>
                                    <div class="price">
                                        Rp250.000
                                    </div>
                                </div>

                                <a href="/login" class="btn btn-small">
                                    Beli Tiket
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- KONSER 2 -->
                    <article class="concert-card">
                        <div class="concert-image">
                            <img
                                src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?auto=format&fit=crop&w=800&q=80"
                                alt="Konser band live"
                            >
                            <span class="concert-label">
                                Terbatas
                            </span>
                        </div>

                        <div class="concert-info">
                            <h3>Rock Night Festival</h3>
                            <p>📅 22 November 2026</p>
                            <p>📍 Bandung</p>

                            <div class="concert-bottom">
                                <div>
                                    <p>Mulai dari</p>
                                    <div class="price">
                                        Rp180.000
                                    </div>
                                </div>

                                <a href="/login" class="btn btn-small">
                                    Beli Tiket
                                </a>
                            </div>
                        </div>
                    </article>

                    <!-- KONSER 3 -->
                    <article class="concert-card">
                        <div class="concert-image">
                            <img
                                src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?auto=format&fit=crop&w=800&q=80"
                                alt="Panggung konser malam"
                            >
                            <span class="concert-label">
                                Terbaru
                            </span>
                        </div>

                        <div class="concert-info">
                            <h3>Indie Music Night</h3>
                            <p>📅 29 November 2026</p>
                            <p>📍 Yogyakarta</p>

                            <div class="concert-bottom">
                                <div>
                                    <p>Mulai dari</p>
                                    <div class="price">
                                        Rp150.000
                                    </div>
                                </div>

                                <a href="/login" class="btn btn-small">
                                    Beli Tiket
                                </a>
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        <!-- BANNER PROMOSI -->
        <section id="tentang">
            <div class="container">
                <div class="banner">
                    <h2>Siap Menikmati Konser Impianmu?</h2>

                    <p>
                        Jangan sampai kehabisan tiket.
                        Temukan konser favoritmu sekarang!
                    </p>

                    <a href="#konser" class="btn">
                        Jelajahi Konser
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <a href="#" class="logo">
                    Konser<span>Ku.</span>
                </a>

                <p>
                    © 2026 KonserKu. Semua hak dilindungi.
                </p>

                <p>Temukan musik, ciptakan kenangan.</p>
            </div>
        </div>
    </footer>

</body>
</html>
