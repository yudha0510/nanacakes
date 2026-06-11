<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') – NanaCakes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --cocoa:        #2c1608;
            --cocoa-mid:    #5c2d0e;
            --caramel:      #b5601a;
            --caramel-lt:   #d4894a;
            --cream:        #fdf6ee;
            --cream-dark:   #f0e4d0;
            --sand:         #e8d5b7;
            --sidebar-w:    256px;
            --topbar-h:     60px;
            --text-primary: #1e0e05;
            --text-muted:   #8a6040;
            --text-faint:   #b89070;
            --radius-sm:    6px;
            --radius-md:    10px;
            --radius-lg:    14px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--text-primary);
            display: flex;
            min-height: 100vh;
            font-size: 14px;
        }

        /* ─── SIDEBAR ─────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            min-height: 100vh;
            background: var(--cocoa);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0;
            z-index: 200;
            border-right: 1px solid rgba(255,200,130,.06);
        }

        /* Logo */
        .sidebar-logo {
            padding: 24px 22px 20px;
            border-bottom: 1px solid rgba(255,200,130,.08);
            flex-shrink: 0;
        }

        .logo-mark {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-icon {
            width: 36px; height: 36px;
            border-radius: var(--radius-sm);
            background: linear-gradient(135deg, var(--caramel), var(--caramel-lt));
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .logo-icon svg {
            width: 20px; height: 20px;
            stroke: #fff8ee; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .logo-text .brand {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 700;
            color: #fff8ee;
            display: block;
            line-height: 1;
            letter-spacing: .3px;
        }

        .logo-text .brand-sub {
            font-size: 10px;
            letter-spacing: 1.8px;
            text-transform: uppercase;
            color: rgba(245,210,160,.38);
            display: block;
            margin-top: 3px;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            padding: 12px 0 8px;
            overflow-y: auto;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .nav-section {
            margin-bottom: 2px;
        }

        .nav-section-label {
            font-size: 9.5px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: rgba(245,210,160,.28);
            padding: 14px 22px 6px;
            display: block;
            font-weight: 500;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 22px;
            color: rgba(245,210,160,.55);
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 400;
            transition: background .15s, color .15s;
            position: relative;
            border-radius: 0;
            white-space: nowrap;
        }

        .nav-item:hover {
            background: rgba(255,210,140,.07);
            color: rgba(255,240,210,.85);
        }

        .nav-item.active {
            background: rgba(181,96,26,.18);
            color: #ffedd0;
            font-weight: 500;
        }

        .nav-item.active::before {
            content: '';
            position: absolute;
            left: 0; top: 4px; bottom: 4px;
            width: 3px;
            background: var(--caramel-lt);
            border-radius: 0 3px 3px 0;
        }

        .nav-item svg {
            width: 16px; height: 16px;
            stroke: currentColor; fill: none;
            stroke-width: 1.8;
            stroke-linecap: round; stroke-linejoin: round;
            flex-shrink: 0;
            opacity: .8;
        }

        .nav-item.active svg { opacity: 1; }

        .nav-badge {
            margin-left: auto;
            background: var(--caramel);
            color: #fff8ee;
            font-size: 10px;
            font-weight: 600;
            padding: 1px 6px;
            border-radius: 999px;
            line-height: 1.6;
        }

        /* Footer */
        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid rgba(255,200,130,.08);
            flex-shrink: 0;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .user-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--caramel), var(--caramel-lt));
            display: flex; align-items: center; justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: #fff8ee;
            flex-shrink: 0;
            letter-spacing: .5px;
        }

        .user-name {
            font-size: 13px;
            color: #fff8ee;
            font-weight: 500;
            line-height: 1.25;
        }

        .user-role {
            font-size: 11px;
            color: rgba(245,210,160,.38);
            margin-top: 1px;
        }

        .logout-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            background: transparent;
            border: 1px solid rgba(255,110,80,.22);
            border-radius: var(--radius-sm);
            padding: 8px 12px;
            color: rgba(255,180,155,.6);
            font-size: 12.5px;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            cursor: pointer;
            transition: background .15s, color .15s, border-color .15s;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255,100,70,.12);
            color: rgba(255,190,170,.85);
            border-color: rgba(255,100,70,.35);
        }

        .logout-btn svg {
            width: 14px; height: 14px;
            stroke: currentColor; fill: none;
            stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
        }

        /* ─── MAIN ────────────────────────────────── */
        .main {
            margin-left: var(--sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            min-width: 0;
        }

        /* Topbar */
        .topbar {
            background: #fffaf4;
            border-bottom: 1px solid rgba(181,96,26,.1);
            padding: 0 28px;
            height: var(--topbar-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        /* Mobile menu toggle */
        .menu-toggle {
            display: none;
            width: 34px; height: 34px;
            border-radius: var(--radius-sm);
            background: var(--cream-dark);
            border: 1px solid var(--sand);
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        .menu-toggle svg {
            width: 18px; height: 18px;
            stroke: var(--cocoa-mid); fill: none;
            stroke-width: 2;
            stroke-linecap: round;
        }

        .page-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--cocoa);
            letter-spacing: .2px;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .topbar-date {
            font-size: 12px;
            color: var(--text-faint);
            font-weight: 400;
            padding-right: 10px;
            border-right: 1px solid var(--sand);
        }

        /* Notification */
        .notif-wrapper { position: relative; }

        .notif-btn {
            width: 34px; height: 34px;
            border-radius: var(--radius-sm);
            background: var(--cream-dark);
            border: 1px solid var(--sand);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            transition: background .15s;
        }

        .notif-btn:hover { background: var(--sand); }

        .notif-btn svg {
            width: 16px; height: 16px;
            stroke: var(--cocoa-mid); fill: none;
            stroke-width: 2;
            stroke-linecap: round; stroke-linejoin: round;
        }

        .notif-dot {
            position: absolute;
            top: 5px; right: 5px;
            width: 7px; height: 7px;
            background: #d94040;
            border-radius: 50%;
            border: 1.5px solid #fffaf4;
        }

        .notif-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: 300px;
            background: #fffaf4;
            border: 1px solid var(--sand);
            border-radius: var(--radius-lg);
            box-shadow: 0 8px 24px rgba(44,22,8,.1);
            overflow: hidden;
            display: none;
            z-index: 999;
        }

        .notif-dropdown.show { display: block; }

        .notif-header {
            padding: 12px 16px;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text-muted);
            border-bottom: 1px solid var(--cream-dark);
            letter-spacing: .3px;
            text-transform: uppercase;
        }

        .notif-item {
            padding: 12px 16px;
            border-bottom: 1px solid var(--cream-dark);
            cursor: pointer;
            transition: background .15s;
        }

        .notif-item:last-child { border-bottom: none; }
        .notif-item:hover { background: var(--cream-dark); }

        .notif-title {
            font-size: 13px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .notif-time {
            font-size: 11.5px;
            color: var(--text-faint);
            margin-top: 2px;
        }

        /* Topbar avatar */
        .topbar-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--caramel), var(--caramel-lt));
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #fff8ee;
            border: 2px solid var(--cream-dark);
            cursor: default;
        }

        /* Content */
        .content {
            padding: 28px;
            flex: 1;
        }

        /* ─── OVERLAY (mobile) ────────────────────── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(44,22,8,.45);
            z-index: 190;
        }

        /* ─── RESPONSIVE ──────────────────────────── */
        @media (max-width: 900px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
            }

            .sidebar.open { transform: translateX(0); }

            .sidebar-overlay.show { display: block; }

            .main { margin-left: 0; }

            .menu-toggle { display: flex; }

            .topbar-date { display: none; }

            .content { padding: 20px 16px; }
        }

        @media (max-width: 480px) {
            .topbar { padding: 0 16px; }
        }

        @yield('styles')
    </style>
    @stack('styles')
</head>
<body>

    <!-- SIDEBAR OVERLAY (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">
                <div class="logo-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 2C8 2 5 5 5 8c0 4 3 6 3 10h8c0-4 3-6 3-10 0-3-3-6-7-6z"/>
                        <line x1="9" y1="18" x2="15" y2="18"/>
                        <line x1="10" y1="21" x2="14" y2="21"/>
                    </svg>
                </div>
                <div class="logo-text">
                    <span class="brand">NanaCakes</span>
                    <span class="brand-sub">Admin Panel</span>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">

            <div class="nav-section">
                <span class="nav-section-label">Utama</span>
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <rect x="3" y="3" width="7" height="7" rx="1"/>
                        <rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/>
                        <rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>
                    Dashboard
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-section-label">Pesanan</span>
                <a href="{{ route('admin.pesanan') }}"
                class="nav-item {{ request()->routeIs('admin.pesanan') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>

                    Semua Pesanan
                </a>

                <a href="{{ route('orders.pending') }}"
                class="nav-item {{ request()->routeIs('orders.pending') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>

                    Pesanan Pending

                    @if(isset($pendingOrders) && $pendingOrders > 0)
                        <span class="nav-badge">{{ $pendingOrders }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.riwayat') }}"
                   class="nav-item {{ request()->routeIs('admin.riwayat') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <path d="M3 3v5h5"/>
                        <path d="M3.05 13A9 9 0 1 0 6 5.3L3 8"/>
                    </svg>
                    Riwayat Pesanan
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-section-label">Produk</span>
                <a href="{{ route('product.index') }}"
                   class="nav-item {{ request()->routeIs('product.index') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/>
                    </svg>
                    Menu Kue
                </a>

                <a href="{{ route('admin.tambah-produk') }}"
                   class="nav-item {{ request()->routeIs('admin.tambah-produk') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    Tambah Produk
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-section-label">Pelanggan</span>
                <a href="{{ route('admin.customer') }}"
                   class="nav-item {{ request()->routeIs('admin.customer') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 00-3-3.87"/>
                        <path d="M16 3.13a4 4 0 010 7.75"/>
                    </svg>
                    Data Pelanggan
                </a>
            </div>

            <div class="nav-section">
                <span class="nav-section-label">Laporan</span>
                <a href="{{ route('admin.laporan') }}"
                    class="nav-item {{ request()->routeIs('admin.laporan') ? 'active' : '' }}">
                    <svg viewBox="0 0 24 24">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    Laporan Penjualan
                </a>
            </div>

        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <svg viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div class="main">
        <header class="topbar">
            <div class="topbar-left">
                <button class="menu-toggle" onclick="toggleSidebar()" type="button" aria-label="Toggle menu">
                    <svg viewBox="0 0 24 24">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
                <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            </div>

            <div class="topbar-right">
                <span class="topbar-date" id="topbar-date"></span>

                <div class="notif-wrapper">
                    <button class="notif-btn" onclick="toggleNotif()" type="button" aria-label="Notifikasi">
                        <svg viewBox="0 0 24 24">
                            <path d="M18 8A6 6 0 006 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 01-3.46 0"/>
                        </svg>
                        @if(isset($pendingOrders) && isset($waitingVerification) && ($pendingOrders > 0 || $waitingVerification > 0))
                            <span class="notif-dot"></span>
                        @endif
                    </button>

                    <div class="notif-dropdown" id="notifDropdown">
                        <div class="notif-header">Notifikasi</div>

                        @if(isset($pendingOrders) && $pendingOrders > 0)
                        <div class="notif-item">
                            <div class="notif-title">{{ $pendingOrders }} pesanan baru masuk</div>
                            <div class="notif-time">Menunggu pembayaran</div>
                        </div>
                        @endif

                        @if(isset($waitingVerification) && $waitingVerification > 0)
                        <div class="notif-item">
                            <div class="notif-title">{{ $waitingVerification }} pembayaran perlu verifikasi</div>
                            <div class="notif-time">Segera cek bukti transfer</div>
                        </div>
                        @endif

                        @if(isset($processingOrders) && $processingOrders > 0)
                        <div class="notif-item">
                            <div class="notif-title">{{ $processingOrders }} pesanan sedang diproses</div>
                            <div class="notif-time">Dalam tahap produksi</div>
                        </div>
                        @endif

                        @if(
                            (!isset($pendingOrders) || $pendingOrders == 0) &&
                            (!isset($waitingVerification) || $waitingVerification == 0) &&
                            (!isset($processingOrders) || $processingOrders == 0)
                        )
                        <div class="notif-item">
                            <div class="notif-title">Tidak ada notifikasi</div>
                            <div class="notif-time">Semua pesanan sudah ditangani</div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="topbar-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <main class="content">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Topbar date
        const d = new Date();
        document.getElementById('topbar-date').textContent =
            d.toLocaleDateString('id-ID', { weekday:'long', day:'numeric', month:'long', year:'numeric' });

        // Notification dropdown
        function toggleNotif() {
            document.getElementById('notifDropdown').classList.toggle('show');
        }

        document.addEventListener('click', function(e) {
            const wrapper = document.querySelector('.notif-wrapper');
            if (wrapper && !wrapper.contains(e.target)) {
                document.getElementById('notifDropdown').classList.remove('show');
            }
        });

        // Mobile sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('show');
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
        timer: 2500,
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
        timer: 3000,
        timerProgressBar: true
    });
    </script>
    @endif

</body>
</html>