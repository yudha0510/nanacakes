@extends('layouts.user')

@section('title', 'Beranda')

@push('styles')
<style>

    /* ─── PAGE ────────────────────────────────── */
    .home-page {
        display: flex;
        flex-direction: column;
        background: #1a0a02;
        color: #fff8ee;
    }

    /* ─── HERO ────────────────────────────────── */
    .hero-section {
        background: #1a0a02;
        padding: 56px 60px 48px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 48px;
        min-height: 480px;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: -100px; right: 200px;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(196,122,58,.12) 0%, transparent 65%);
        pointer-events: none;
    }

    /* ── Left ── */
    .hero-left {
        flex: 1;
        position: relative;
        z-index: 2;
        max-width: 480px;
    }

    .hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #c47a3a;
        margin-bottom: 18px;
    }

    .hero-eyebrow::before {
        content: '';
        display: block;
        width: 24px; height: 1.5px;
        background: #c47a3a;
        border-radius: 2px;
    }

    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 52px;
        font-weight: 700;
        color: #fff8ee;
        line-height: 1.1;
        margin-bottom: 18px;
        letter-spacing: -.3px;
    }

    .hero-title em {
        font-style: italic;
        color: #c47a3a;
    }

    .hero-desc {
        font-size: 14px;
        color: rgba(245,222,179,0.6);
        line-height: 1.75;
        margin-bottom: 32px;
        max-width: 360px;
        font-weight: 300;
    }

    .hero-cta {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
        margin-bottom: 44px;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #c47a3a;
        color: #fff8ee;
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        padding: 13px 26px;
        border-radius: var(--radius-sm);
        text-decoration: none;
        transition: background .2s, box-shadow .2s, transform .2s;
        border: none; cursor: pointer;
    }

    .btn-primary:hover {
        background: #e09040;
        box-shadow: 0 6px 20px rgba(196,122,58,.38);
        transform: translateY(-1px);
    }

    .btn-secondary {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: rgba(245,222,179,0.7);
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        text-decoration: none;
        transition: color .2s;
        border: none; background: none; cursor: pointer; padding: 0;
    }

    .btn-secondary:hover { color: #c47a3a; }

    .btn-secondary svg {
        width: 18px; height: 18px;
        stroke: currentColor; fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
        transition: transform .2s;
    }

    .btn-secondary:hover svg { transform: translateX(3px); }

    .hero-trust {
        display: flex;
        align-items: center;
        gap: 22px;
    }

    .trust-item {
        display: flex;
        align-items: center;
        gap: 7px;
        color: rgba(245,222,179,0.4);
        font-size: 12px;
    }

    .trust-item svg {
        width: 16px; height: 16px;
        stroke: #c47a3a; fill: none;
        stroke-width: 1.8;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .trust-sep {
        width: 1px; height: 18px;
        background: rgba(196,122,58,0.2);
    }

    /* ── Right ── */
    .hero-right {
        flex-shrink: 0;
        position: relative;
        z-index: 2;
        width: 400px;
    }

    .hero-img-wrap {
        position: relative;
        width: 100%;
    }

    .hero-illustration-box {
        width: 100%;
        height: 400px;
        background: rgba(44,18,6,0.6);
        border: 0.5px solid rgba(196,122,58,0.2);
        border-radius: var(--radius-lg);
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .hero-illustration-box::before {
        content: '';
        position: absolute;
        width: 280px; height: 280px;
        background: rgba(196,122,58,.07);
        border-radius: 50%;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .hero-illustration-box::after {
        content: '';
        position: absolute;
        width: 360px; height: 360px;
        border: 1px dashed rgba(196,122,58,.12);
        border-radius: 50%;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        pointer-events: none;
    }

    .hero-cake-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        position: relative;
        z-index: 1;
    }

    /* floating badge */
    .hero-float-badge {
        position: absolute;
        bottom: 24px; left: -22px;
        background: #2c1206;
        border: 0.5px solid rgba(196,122,58,0.25);
        border-radius: var(--radius-md);
        padding: 12px 16px;
        box-shadow: 0 8px 28px rgba(0,0,0,0.4);
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 175px;
        z-index: 5;
    }

    .float-icon {
        width: 38px; height: 38px;
        background: linear-gradient(135deg, #c47a3a, #e09040);
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    .float-text strong {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #fff8ee;
        line-height: 1.2;
    }

    .float-text span {
        font-size: 11px;
        color: rgba(245,222,179,0.45);
    }

    /* ─── SECTION COMMON ──────────────────────── */
    .section-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 34px;
        font-weight: 700;
        color: #fff8ee;
        letter-spacing: .1px;
        margin-bottom: 8px;
    }

    .section-sub {
        font-size: 13.5px;
        color: rgba(245,222,179,0.4);
        font-weight: 300;
    }

    /* ─── FEATURED PRODUCTS ───────────────────── */
    .featured-section {
        background: #1a0a02;
        padding: 52px 60px 56px;
        border-top: 0.5px solid rgba(196,122,58,0.12);
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    .feat-card {
        background: rgba(255,248,238,0.04);
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 0.5px solid rgba(196,122,58,0.15);
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        transition: transform .25s, box-shadow .25s, border-color .25s;
        display: flex;
        flex-direction: column;
        animation: fadeUp .4s both;
    }

    .feat-card:nth-child(1) { animation-delay: .06s; }
    .feat-card:nth-child(2) { animation-delay: .12s; }
    .feat-card:nth-child(3) { animation-delay: .18s; }
    .feat-card:nth-child(4) { animation-delay: .24s; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .feat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.5);
        border-color: rgba(196,122,58,0.35);
    }

    .feat-img {
        width: 100%;
        height: 190px;
        overflow: hidden;
    }

    .feat-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform .4s ease;
    }

    .feat-card:hover .feat-img img { transform: scale(1.06); }

    .feat-body {
        padding: 16px 18px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .feat-cat {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #c47a3a;
        margin-bottom: 6px;
    }

    .feat-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-weight: 700;
        color: #fff8ee;
        line-height: 1.25;
        margin-bottom: 4px;
    }

    .feat-desc {
        font-size: 12px;
        color: rgba(245,222,179,0.45);
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
        margin-bottom: 14px;
    }

    .view-all-wrap {
        text-align: center;
        margin-top: 32px;
    }

    .btn-view-all {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        border: 0.5px solid rgba(196,122,58,0.3);
        color: rgba(245,222,179,0.7);
        font-family: 'DM Sans', sans-serif;
        font-size: 13.5px;
        font-weight: 500;
        padding: 11px 28px;
        border-radius: var(--radius-sm);
        text-decoration: none;
        transition: all .2s;
    }

    .btn-view-all:hover {
        background: #c47a3a;
        color: #fff8ee;
        border-color: #c47a3a;
        box-shadow: 0 4px 14px rgba(196,122,58,.3);
    }

    /* ─── WHY US ──────────────────────────────── */
    .why-section {
        background: #2c1206;
        padding: 52px 60px;
        border-top: 0.5px solid rgba(196,122,58,0.12);
    }

    .why-section .section-title { color: #fff8ee; }
    .why-section .section-sub   { color: rgba(245,210,160,.38); }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
    }

    .why-card {
        background: rgba(255,255,255,.03);
        border: 0.5px solid rgba(196,122,58,0.1);
        border-radius: var(--radius-md);
        padding: 24px 20px;
        text-align: center;
        transition: background .2s, border-color .2s;
    }

    .why-card:hover {
        background: rgba(196,122,58,.1);
        border-color: rgba(196,122,58,.3);
    }

    .why-icon {
        width: 48px; height: 48px;
        background: rgba(196,122,58,.15);
        border-radius: var(--radius-md);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
    }

    .why-icon svg {
        width: 22px; height: 22px;
        stroke: #c47a3a; fill: none;
        stroke-width: 1.7;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .why-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 17px;
        font-weight: 700;
        color: #fff8ee;
        margin-bottom: 8px;
    }

    .why-desc {
        font-size: 12.5px;
        color: rgba(245,210,160,.4);
        line-height: 1.65;
    }

    /* ─── RESPONSIVE ──────────────────────────── */
    @media (max-width: 1100px) {
        .featured-grid  { grid-template-columns: repeat(3, 1fr); }
        .why-grid       { grid-template-columns: repeat(2, 1fr); }
        .hero-right     { width: 340px; }
        .hero-title     { font-size: 42px; }
    }

    @media (max-width: 860px) {
        .hero-section   { padding: 40px 28px 36px; gap: 32px; }
        .featured-section,
        .why-section    { padding: 40px 24px; }
        .featured-grid  { grid-template-columns: repeat(2, 1fr); gap: 14px; }
        .hero-right     { width: 280px; }
        .hero-title     { font-size: 36px; }
        .hero-illustration-box { height: 320px; }
    }

    @media (max-width: 680px) {
        .hero-section   { flex-direction: column; padding: 32px 20px; min-height: unset; }
        .hero-right     { width: 100%; }
        .hero-illustration-box { height: 240px; }
        .hero-float-badge  { display: none; }
        .hero-title     { font-size: 34px; }
        .hero-left      { max-width: 100%; }
    }

    @media (max-width: 480px) {
        .featured-grid  { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .why-grid       { grid-template-columns: 1fr 1fr; }
        .hero-trust     { flex-wrap: wrap; gap: 10px; }
        .trust-sep      { display: none; }
    }

    @media (max-width: 360px) {
        .featured-grid  { grid-template-columns: 1fr; }
    }

</style>
@endpush

@section('content')
<div class="home-page">

    {{-- ══ HERO ══ --}}
    <section class="hero-section">

        <div class="hero-left">
            <span class="hero-eyebrow">Pre-Order Kue Homemade</span>

            <h1 class="hero-title">
                Sweet Moments<br>
                Start with<br>
                <em>NanaCakes</em>
            </h1>

            <p class="hero-desc">
                Koleksi kue premium dengan kualitas terbaik untuk menemani setiap momen berharga. Pesan sekarang dan ciptakan kenangan yang lebih berkesan bersama NanaCakes. 🎂✨
            </p>

            <div class="hero-cta">
                <a href="{{ url('/menu') }}" class="btn-primary">
                    <svg viewBox="0 0 24 24" width="15" height="15" stroke="currentColor" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/>
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <path d="M16 10a4 4 0 01-8 0"/>
                    </svg>
                    Pesan Sekarang
                </a>
                <a href="{{ url('/menu') }}" class="btn-secondary">
                    Lihat Menu
                    <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>

            <div class="hero-trust">
                <div class="trust-item">
                    <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    Pre-order
                </div>
                <div class="trust-sep"></div>
                <div class="trust-item">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    Bahan Premium
                </div>
                <div class="trust-sep"></div>
                <div class="trust-item">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Higienis & Aman
                </div>
                <div class="trust-sep"></div>
            </div>
        </div>

        {{-- Kanan: ilustrasi tanpa gambar --}}
        <div class="hero-right">
            <div class="hero-img-wrap">
                <div class="hero-illustration-box">
                    {{-- Ganti src dengan path gambar kamu --}}
                    <img src="{{ asset('images/aa.jpg') }}" alt="NanaCakes" class="hero-cake-img">
                </div>

                <div class="hero-float-badge">
                    <div class="float-icon">🍰</div>
                    <div class="float-text">
                        <strong>Banyak Menu Tersedia</strong>
                        <span>Siap Menemani Perayaanmu</span>
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- ══ FEATURED PRODUCTS ══ --}}
    <section class="featured-section">

        <div class="section-header">
            <h2 class="section-title">Pilihan Kue Terbaik</h2>
        </div>

        <div class="featured-grid">

            {{-- Card 1 --}}
            <div class="feat-card">
                <div class="feat-img">
                    <img src="{{ asset('images/yu.jpg') }}" alt="Birthday Cake">
                </div>
                <div class="feat-body">
                    <span class="feat-cat">Birthday Cake</span>
                    <h3 class="feat-name">Elegant Birthday Cake</h3>
                    <p class="feat-desc">
                        Kue ulang tahun dengan desain minimalis dan buttercream lembut yang memberikan tampilan elegan.
                    </p>
                </div>
            </div>

            {{-- Card 2 --}}
            <div class="feat-card">
                <div class="feat-img">
                    <img src="{{ asset('images/ao.jpg') }}" alt="Birthday Cake">
                </div>
                <div class="feat-body">
                    <span class="feat-cat">Cupcakes</span>
                    <h3 class="feat-name">Matcha Cupcake</h3>
                    <p class="feat-desc">
                        Cupcake matcha premium dengan buttercream matcha yang lembut, rasa sedikit pahit berpadu manis, tampilan hijau aesthetic yang kekinian
                    </p>
                </div>
            </div>

            {{-- Card 3 --}}
            <div class="feat-card">
                <div class="feat-img">
                    <img src="{{ asset('images/ayo.jpg') }}" alt="Birthday Cake">
                </div>
                <div class="feat-body">
                    <span class="feat-cat">Sweet Cakes</span>
                    <h3 class="feat-name">Black Forest</h3>
                    <p class="feat-desc">
                        Kue coklat klasik berlapis whipped cream lembut dan ceri merah, salah satu kue ulang tahun paling ikonik dan digemari semua kalangan
                    </p>
                </div>
            </div>

            {{-- Card 4 --}}
            <div class="feat-card">
                <div class="feat-img">
                    <img src="{{ asset('images/nu.jpg') }}" alt="Birthday Cake">
                </div>
                <div class="feat-body">
                    <span class="feat-cat">Others</span>
                    <h3 class="feat-name">Nastar Nanas</h3>
                    <p class="feat-desc">
                        Nastar legendaris dengan selai nanas homemade yang manis segar, kulit butter lembut meleleh di mulut, kue wajib hadir di momen lebaran 25 pcs / toples
                    </p>
                </div>
            </div>

        </div>

        <div class="view-all-wrap">
            <a href="{{ url('/menu') }}" class="btn-view-all">
                Lihat Semua Menu
                <svg viewBox="0 0 24 24" width="14" height="14" stroke="currentColor" fill="none" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>

    </section>

    {{-- ══ WHY US ══ --}}
    <section class="why-section">

        <div class="section-header">
            <h2 class="section-title">Mengapa NanaCakes?</h2>
            <p class="section-sub">Kami hadir untuk membuat momenmu semakin istimewa</p>
        </div>

        <div class="why-grid">
            <div class="why-card">
                <div class="why-icon">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                </div>
                <div class="why-title">Dibuat dengan Cinta</div>
                <div class="why-desc">Setiap kue dirancang dan dibuat dengan penuh perhatian dan dedikasi.</div>
            </div>
            <div class="why-card">
                <div class="why-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="why-title">Bahan Pilihan</div>
                <div class="why-desc">Menggunakan bahan-bahan segar dan berkualitas tinggi tanpa pengawet.</div>
            </div>
            <div class="why-card">
                <div class="why-icon">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M12 1v4M12 19v4M4.22 4.22l2.83 2.83M16.95 16.95l2.83 2.83M1 12h4M19 12h4M4.22 19.78l2.83-2.83M16.95 7.05l2.83-2.83"/></svg>
                </div>
                <div class="why-title">Rasa Istimewa</div>
                <div class="why-desc">Menghadirkan kelezatan yang cocok untuk berbagai momen spesial.</div>
            </div>
            <div class="why-card">
                <div class="why-icon">
                    <svg viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 5v3h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                </div>
                <div class="why-title">Pesan dengan Mudah</div>
                <div class="why-desc">Nikmati proses pemesanan yang praktis untuk berbagai kebutuhan acara.</div>
            </div>
        </div>

    </section>

</div>
@endsection

@push('scripts')
<script>
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.feat-card, .why-card').forEach(el => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
</script>
@endpush