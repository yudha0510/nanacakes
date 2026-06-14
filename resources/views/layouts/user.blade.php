<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') – NanaCakes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --cocoa:      #2c1608;
            --caramel:    #b5601a;
            --caramel-lt: #d4894a;
            --cream:      #fdf6ee;
            --cream-dark: #f0e4d0;
            --sand:       #e8d5b7;
            --topbar-h:   64px;
            --text-primary: #1e0e05;
            --text-muted:   #8a6040;
            --radius-sm:  6px;
            --radius-md:  10px;
            --radius-lg:  14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-primary);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-size: 14px;
        }

        /* ─── NAVBAR ──────────────────────────────── */
        .navbar {
            background: var(--cocoa);
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            padding: 0 32px;
            gap: 4px;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 1px solid rgba(255,200,130,.06);
            box-shadow: 0 2px 16px rgba(44,22,8,.22);
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            flex-shrink: 0;
            margin-right: 18px;
        }

        .logo-icon {
            width: 34px; height: 34px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, var(--caramel), var(--caramel-lt));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .logo-icon svg {
            width: 18px; height: 18px;
            stroke: #fff8ee; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .logo-text .brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 21px;
            font-weight: 700;
            color: #fff8ee;
            display: block;
            line-height: 1;
            letter-spacing: .3px;
        }

        .logo-text .brand-sub {
            font-size: 9.5px;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: rgba(245,210,160,.38);
            display: block;
            margin-top: 2px;
        }

        /* ─── NAV LINKS ───────────────────────────── */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 2px;
            flex: 1;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 7px;
            padding: 8px 13px;
            color: rgba(245,210,160,.55);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 400;
            border-radius: var(--radius-sm);
            transition: background .15s, color .15s;
            white-space: nowrap;
        }

        .nav-link:hover {
            background: rgba(255,210,140,.07);
            color: rgba(255,240,210,.85);
        }

        .nav-link.active {
            background: rgba(181,96,26,.18);
            color: #ffedd0;
            font-weight: 500;
        }

        .nav-link svg {
            width: 15px; height: 15px;
            stroke: currentColor; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0;
            opacity: .8;
        }

        .nav-link.active svg { opacity: 1; }

        /* ─── NAVBAR RIGHT ────────────────────────── */
        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-left: auto;
        }

        /* Cart button */
        .cart-btn {
            display: flex;
            align-items: center;
            gap: 7px;
            background: rgba(181,96,26,.18);
            border: 1px solid rgba(255,210,140,.14);
            color: #ffedd0;
            font-size: 13px;
            font-weight: 500;
            padding: 7px 15px;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            text-decoration: none;
            transition: background .15s, border-color .15s;
            position: relative;
        }

        .cart-btn:hover {
            background: rgba(181,96,26,.28);
            border-color: rgba(255,210,140,.22);
        }

        .cart-btn svg {
            width: 15px; height: 15px;
            stroke: currentColor; fill: none;
            stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .cart-count {
            position: absolute;
            top: -7px; right: -7px;
            background: #d94040;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            width: 18px; height: 18px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--cocoa);
        }

        /* User pill */
        .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,220,150,.06);
            border: 1px solid rgba(255,220,150,.12);
            border-radius: 999px;
            padding: 4px 14px 4px 4px;
            cursor: pointer;
            position: relative;
            transition: background .15s;
        }

        .user-pill:hover { background: rgba(255,220,150,.1); }

        .user-avatar-sm {
            width: 28px; height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--caramel), var(--caramel-lt));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #fff8ee;
            flex-shrink: 0;
            letter-spacing: .5px;
        }

        .user-avatar-sm-img {
            width: 36px; height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(196,122,58,0.3);
        }

        .user-pill-name {
            font-size: 13px;
            color: #fff8ee;
            font-weight: 500;
        }

        /* Dropdown */
        .user-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #fffaf4;
            border: 1px solid var(--sand);
            border-radius: var(--radius-lg);
            box-shadow: 0 8px 28px rgba(44,22,8,.14);
            min-width: 190px;
            padding: 8px 0;
            display: none;
            z-index: 200;
        }

        .user-pill:hover .user-dropdown,
        .user-pill:focus-within .user-dropdown { display: block; }

        .dropdown-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 16px;
            font-size: 13px;
            color: var(--text-muted);
            text-decoration: none;
            transition: background .15s, color .15s;
            width: 100%;
            background: none;
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-weight: 400;
            text-align: left;
        }

        .dropdown-item:hover {
            background: var(--cream-dark);
            color: var(--text-primary);
        }

        .dropdown-item svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none;
            stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
            opacity: .7;
        }

        .dropdown-divider {
            height: 1px;
            background: var(--cream-dark);
            margin: 6px 0;
        }

        .dropdown-item.danger { color: #c62828; }
        .dropdown-item.danger:hover { background: #fff0f0; color: #b71c1c; }

        /* ─── MOBILE TOGGLE ───────────────────────── */
        .menu-toggle {
            display: none;
            width: 34px; height: 34px;
            border-radius: var(--radius-sm);
            background: rgba(255,210,140,.07);
            border: 1px solid rgba(255,210,140,.12);
            cursor: pointer;
            align-items: center;
            justify-content: center;
            margin-right: 6px;
        }

        .menu-toggle svg {
            width: 18px; height: 18px;
            stroke: rgba(255,240,210,.7); fill: none;
            stroke-width: 2;
            stroke-linecap: round;
        }

        /* Mobile nav drawer */
        .mobile-nav {
            display: none;
            flex-direction: column;
            background: var(--cocoa);
            border-top: 1px solid rgba(255,200,130,.06);
            padding: 8px 0 12px;
            position: fixed;
            top: var(--topbar-h);
            left: 0; right: 0;
            z-index: 99;
            box-shadow: 0 8px 24px rgba(44,22,8,.2);
        }

        .mobile-nav.open { display: flex; }

        .mobile-nav .nav-link {
            border-radius: 0;
            padding: 11px 24px;
        }

        /* ─── MAIN ────────────────────────────────── */
        .main-content { flex: 1; }

        /* ─── FOOTER ──────────────────────────────── */
        .footer {
            background: var(--cocoa);
            border-top: 1px solid rgba(255,200,130,.06);
            padding: 22px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .footer-brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 19px;
            font-weight: 700;
            color: #fff8ee;
            letter-spacing: .3px;
        }

        .footer-copy {
            font-size: 12px;
            color: rgba(245,210,160,.28);
        }

        /* ─── FLASH ───────────────────────────────── */
        .flash-wrapper { padding: 12px 32px 0; }

        .flash {
            padding: 11px 16px;
            border-radius: var(--radius-md);
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .flash.success { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .flash.error   { background: #fce4ec; color: #c62828; border: 1px solid #f48fb1; }
        .flash.info    { background: #e3f0fb; color: #1565c0; border: 1px solid #90caf9; }

        /* ─── RESPONSIVE ──────────────────────────── */
        @media (max-width: 860px) {
            .nav-links { display: none; }
            .menu-toggle { display: flex; }
            .navbar { padding: 0 18px; }
            .footer { padding: 18px 20px; }
        }

        @media (max-width: 480px) {
            .user-pill-name { display: none; }
            .user-pill { padding: 4px; }
        }

        @yield('styles')
    </style>
    @stack('styles')
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">

        <button class="menu-toggle" onclick="toggleMobileNav()" type="button" aria-label="Toggle menu">
            <svg viewBox="0 0 24 24">
                <line x1="3" y1="6" x2="21" y2="6"/>
                <line x1="3" y1="12" x2="21" y2="12"/>
                <line x1="3" y1="18" x2="21" y2="18"/>
            </svg>
        </button>

        <a href="{{ route('dashboard') }}" class="navbar-brand">
            <div class="logo-icon">
                <svg viewBox="0 0 24 24">
                    <path d="M12 2C8 2 5 5 5 8c0 4 3 6 3 10h8c0-4 3-6 3-10 0-3-3-6-7-6z"/>
                    <line x1="9" y1="18" x2="15" y2="18"/>
                    <line x1="10" y1="21" x2="14" y2="21"/>
                </svg>
            </div>
            <div class="logo-text">
                <span class="brand">NanaCakes</span>
                <span class="brand-sub">Pre-Order</span>
            </div>
        </a>

        <div class="nav-links">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Beranda
            </a>
            <a href="{{ url('/menu') }}" class="nav-link {{ request()->is('menu*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                Menu Kue
            </a>
            <a href="{{ url('/pembayaran') }}" class="nav-link {{ request()->is('pembayaran*') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                Pesanan Saya
            </a>
            <a href="{{ route('help') }}" class="nav-link {{ request()->routeIs('help') ? 'active' : '' }}">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.82 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                Pusat Bantuan
            </a>
        </div>

        <div class="navbar-right">

            <a href="{{ route('cart.index') }}" class="cart-btn">
                <svg viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/>
                </svg>
                Keranjang
                @if(($cartCount ?? 0) > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>

            <div class="user-pill" tabindex="0">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                        alt="Profile"
                        class="user-avatar-sm-img">
                @else
                    <div class="user-avatar-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                @endif
                <span class="user-pill-name">{{ auth()->user()->name ?? 'User' }}</span>

                <div class="user-dropdown">
                    <a href="{{ url('/profil') }}" class="dropdown-item">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        Profil Saya
                    </a>
                    <a href="{{ url('/pembayaran') }}" class="dropdown-item">
                        <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                        Pesanan Saya
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item danger">
                            <svg viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </nav>

    <!-- MOBILE NAV DRAWER -->
    <div class="mobile-nav" id="mobileNav">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
            Beranda
        </a>
        <a href="{{ url('/menu') }}" class="nav-link {{ request()->is('menu*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            Menu Kue
        </a>
        <a href="{{ url('/pembayaran') }}" class="nav-link {{ request()->is('pembayaran*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            Pesanan Saya
        </a>
        <a href="{{ url('/pusat-bantuan') }}" class="nav-link {{ request()->is('help*') ? 'active' : '' }}">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.82 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            Pusat Bantuan
        </a>
    </div>

    <!-- FLASH MESSAGES -->
    @if(session('info'))
    <div class="flash-wrapper">
        <div class="flash info">{{ session('info') }}</div>
    </div>
    @endif

    <!-- KONTEN -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-brand">NanaCakes</div>
        <div class="footer-copy">© {{ date('Y') }} NanaCakes. Pre-Order Kue Homemade.</div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        setTimeout(() => {
            document.querySelectorAll('.flash').forEach(el => {
                el.style.transition = 'opacity 0.5s';
                el.style.opacity = '0';
                setTimeout(() => el.closest('.flash-wrapper')?.remove(), 500);
            });
        }, 4000);

        function toggleMobileNav() {
            document.getElementById('mobileNav').classList.toggle('open');
        }

        document.addEventListener('click', function(e) {
            const nav = document.getElementById('mobileNav');
            const toggle = document.querySelector('.menu-toggle');
            if (nav && toggle && !nav.contains(e.target) && !toggle.contains(e.target)) {
                nav.classList.remove('open');
            }
        });

        function updateCartCount(n) {
            const el = document.querySelector('.cart-count');
            if (el) el.textContent = n;
        }
    </script>

    @stack('scripts')

    @if(session('success'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        customClass: { popup: 'swal-toast-custom' }
    });
    </script>
    @endif

    @if(session('error'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 2500,
        timerProgressBar: true
    });
    </script>
    @endif

</body>
</html>