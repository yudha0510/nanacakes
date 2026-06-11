@extends('layouts.user')

@section('title', 'Menu Kue')

@push('styles')
<style>

    /* ─── PAGE WRAP ───────────────────────────── */
    .menu-page {
        padding: 32px 36px 48px;
        max-width: 1280px;
        margin: 0 auto;
    }

    /* ─── HERO ────────────────────────────────── */
    .menu-hero {
        background: #1a0d06;
        border-radius: var(--radius-lg);
        padding: 40px 44px;
        margin-bottom: 36px;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 32px;
        min-height: 200px;
    }

    /* subtle radial glow */
    .menu-hero::before {
        content: '';
        position: absolute;
        top: -80px; right: 280px;
        width: 340px; height: 340px;
        background: radial-gradient(circle, rgba(181,96,26,.18) 0%, transparent 70%);
        pointer-events: none;
    }

    /* grain overlay */
    .menu-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
        opacity: .35;
        pointer-events: none;
    }

    /* ── Hero Left ── */
    .hero-left {
        position: relative;
        z-index: 2;
        flex: 1;
    }

    .hero-eyebrow {
        display: inline-block;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--caramel-lt);
        background: rgba(181,96,26,.18);
        border: 1px solid rgba(181,96,26,.28);
        border-radius: 999px;
        padding: 4px 13px;
        margin-bottom: 16px;
    }

    .hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 38px;
        font-weight: 700;
        color: #fff8ee;
        line-height: 1.18;
        margin-bottom: 10px;
        letter-spacing: .2px;
    }

    .hero-title em {
        font-style: italic;
        color: var(--caramel-lt);
    }

    .hero-subtitle {
        font-size: 13.5px;
        color: rgba(245,210,160,.5);
        margin-bottom: 28px;
        font-weight: 300;
        line-height: 1.6;
        max-width: 380px;
    }

    /* badges */
    .hero-badges {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .hero-badge {
        display: flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,210,140,.1);
        border-radius: var(--radius-md);
        padding: 10px 16px 10px 10px;
        backdrop-filter: blur(4px);
        transition: border-color .2s, background .2s;
    }

    .hero-badge:hover {
        background: rgba(181,96,26,.12);
        border-color: rgba(181,96,26,.28);
    }

    .badge-icon {
        width: 32px; height: 32px;
        background: rgba(181,96,26,.22);
        border-radius: var(--radius-sm);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .badge-icon svg {
        width: 15px; height: 15px;
        stroke: var(--caramel-lt); fill: none;
        stroke-width: 1.8;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .badge-text strong {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #fff8ee;
        line-height: 1.25;
    }

    .badge-text span {
        font-size: 10.5px;
        color: rgba(245,210,160,.42);
    }

    /* ── Hero Right ── */
    .hero-right {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 14px;
    }

    .hero-illustration {
        width: 140px; height: 140px;
        background: rgba(181,96,26,.12);
        border: 1px solid rgba(255,210,140,.1);
        border-radius: var(--radius-lg);
        display: flex; align-items: center; justify-content: center;
        font-size: 72px;
        line-height: 1;
        filter: drop-shadow(0 8px 24px rgba(181,96,26,.3));
    }

    .hero-stats {
        display: flex;
        gap: 10px;
    }

    .hero-stat {
        background: rgba(255,255,255,.05);
        border: 1px solid rgba(255,210,140,.1);
        border-radius: var(--radius-md);
        padding: 8px 14px;
        text-align: center;
    }

    .hero-stat strong {
        display: block;
        font-family: 'Cormorant Garamond', serif;
        font-size: 20px;
        font-weight: 700;
        color: var(--caramel-lt);
        line-height: 1;
    }

    .hero-stat span {
        display: block;
        font-size: 10px;
        color: rgba(245,210,160,.38);
        margin-top: 2px;
        white-space: nowrap;
    }

    /* ─── FILTER ──────────────────────────────── */
    .filter-section {
        margin-bottom: 28px;
        text-align: center;
    }

    .filter-label {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 2.2px;
        text-transform: uppercase;
        color: var(--text-faint);
        display: block;
        margin-bottom: 12px;
    }

    .filter-bar {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .filter-btn {
        padding: 8px 20px;
        border-radius: 999px;
        border: 1.5px solid rgba(181,96,26,.18);
        background: #fff;
        color: var(--text-muted);
        font-size: 13px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        cursor: pointer;
        transition: all .2s;
        white-space: nowrap;
    }

    .filter-btn:hover {
        border-color: var(--caramel);
        color: var(--caramel);
        background: rgba(181,96,26,.04);
    }

    .filter-btn.active {
        background: var(--cocoa);
        border-color: var(--cocoa);
        color: #ffedd0;
        font-weight: 500;
        box-shadow: 0 3px 12px rgba(44,22,8,.22);
    }

    /* ─── PRODUCT GRID ────────────────────────── */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    /* ── Card ── */
    .product-card {
        background: #ffffff;
        border-radius: var(--radius-lg);
        overflow: hidden;
        border: 1px solid rgba(196,122,58,.12);
        box-shadow: 0 4px 20px rgba(196,122,58,.08);
        transition: transform .25s, box-shadow .25s;
        display: flex;
        flex-direction: column;
        animation: cardIn .4s both;
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(12px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .product-card:nth-child(1) { animation-delay: .05s; }
    .product-card:nth-child(2) { animation-delay: .10s; }
    .product-card:nth-child(3) { animation-delay: .15s; }
    .product-card:nth-child(4) { animation-delay: .20s; }
    .product-card:nth-child(5) { animation-delay: .25s; }
    .product-card:nth-child(6) { animation-delay: .30s; }
    .product-card:nth-child(7) { animation-delay: .35s; }
    .product-card:nth-child(8) { animation-delay: .40s; }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(196,122,58,.18);
    }

    /* ── Slider ── */
    .card-slider {
        position: relative;
        height: 200px;
        overflow: hidden;
        flex-shrink: 0;
        background: var(--cream-dark);
    }

    /* category-tinted bg */
    .card-slider[data-cat="Cupcakes"]  { background: #f8ede0; }
    .card-slider[data-cat="Birthday Cake"] { background: #e8f5f0; }
    .card-slider[data-cat="Sweet Cakes"]   { background: #fde8f0; }
    .card-slider[data-cat="Others"]        { background: #ede8f8; }

    .card-slider img {
        position: absolute;
        inset: 0;
        width: 100%; height: 100%;
        object-fit: cover;
        transition: opacity .45s ease;
    }

    /* frosted category tag */
    .slider-dots {
        position: absolute;
        bottom: 9px; left: 50%;
        transform: translateX(-50%);
        display: flex; gap: 5px;
        z-index: 5;
    }

    .slider-dots span {
        width: 5px; height: 5px;
        border-radius: 50%;
        display: block;
        background: rgba(255,255,255,.4);
        transition: background .3s, width .3s;
    }

    .slider-dots span.active-dot {
        background: #fff;
        width: 14px;
        border-radius: 3px;
    }

    /* placeholder */
    .no-img-placeholder {
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-faint);
        font-size: 12px;
        gap: 8px;
    }

    .no-img-placeholder svg {
        width: 34px; height: 34px;
        stroke: var(--sand); fill: none;
        stroke-width: 1.3;
        stroke-linecap: round; stroke-linejoin: round;
    }

    /* ── Card Body ── */
    .card-body {
        padding: 18px 18px 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 6px;
        line-height: 1.25;
        letter-spacing: .1px;
    }

    .product-desc {
        font-size: 12.5px;
        color: #9a7555;
        line-height: 1.65;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
        margin-bottom: 14px;
    }

    /* ── Card Footer ── */
    .card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: auto;
    }

    .product-price {
        font-family: 'Cormorant Garamond', serif;
        font-size: 21px;
        font-weight: 700;
        color: var(--caramel);
        line-height: 1;
    }

    .product-price small {
        font-size: 11px;
        font-weight: 400;
        color: var(--text-faint);
        font-family: 'DM Sans', sans-serif;
        margin-left: 1px;
    }

    .btn-order {
        display: flex;
        align-items: center;
        gap: 6px;
        background: var(--cream-dark);
        color: var(--cocoa-mid);
        border: 1.5px solid rgba(181,96,26,.16);
        padding: 9px 16px;
        border-radius: var(--radius-sm);
        font-size: 12.5px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        transition: all .22s;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-order:hover {
        background: var(--caramel);
        color: #fff8ee;
        border-color: transparent;
        box-shadow: 0 4px 14px rgba(181,96,26,.32);
        transform: translateY(-1px);
    }

    .btn-order svg {
        width: 13px; height: 13px;
        stroke: currentColor; fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
    }

    /* ─── EMPTY STATE ─────────────────────────── */
    .empty-state {
        grid-column: 1 / -1;
        background: #fff;
        border-radius: var(--radius-lg);
        border: 1px solid rgba(196,122,58,.1);
        padding: 72px 24px;
        text-align: center;
        color: var(--text-faint);
    }

    .empty-state svg {
        width: 44px; height: 44px;
        stroke: var(--sand); fill: none;
        stroke-width: 1.2;
        stroke-linecap: round; stroke-linejoin: round;
        display: block;
        margin: 0 auto 14px;
    }

    .empty-state p {
        font-size: 14px;
    }

    /* ─── RESPONSIVE ──────────────────────────── */
    @media (max-width: 1100px) {
        .product-grid { grid-template-columns: repeat(3, 1fr); }
    }

    @media (max-width: 860px) {
        .menu-page { padding: 20px 18px 40px; }
        .menu-hero { padding: 28px 26px; }
        .hero-title { font-size: 28px; }
        .product-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }

    @media (max-width: 640px) {
        .menu-hero { flex-direction: column; min-height: unset; gap: 24px; }
        .hero-right { display: none; }
        .hero-badges { gap: 8px; }
        .hero-badge { padding: 8px 12px; }
        .hero-title { font-size: 26px; }
    }

    @media (max-width: 480px) {
        .product-grid { gap: 10px; }
        .card-slider { height: 160px; }
        .filter-btn { padding: 7px 14px; font-size: 12px; }
    }

    @media (max-width: 380px) {
        .product-grid { grid-template-columns: 1fr; }
    }

</style>
@endpush

@section('content')
<div class="menu-page">

    {{-- ══ HERO ══ --}}
    <section class="menu-hero">

        <div class="hero-left">
            <span class="hero-eyebrow">✦ Koleksi Terbaru</span>
            <h1 class="hero-title">
                Temukan Kue Impianmu<br>
                di <em>NanaCakes</em>
            </h1>
            <p class="hero-subtitle">
                Nikmati berbagai pilihan kue berkualitas untuk menemani setiap momen spesial.
                Hadir dengan cita rasa istimewa dan tampilan yang memikat.
            </p>
            <div class="hero-badges">
                <div class="hero-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Pemesanan Praktis</strong>
                        <span>Proses yang mudah dan cepat.</span>
                    </div>
                </div>
                <div class="hero-badge">
                    <div class="badge-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <div class="badge-text">
                        <strong>Bahan Berkualitas</strong>
                        <span>Fresh setiap hari</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-right">
            <div class="hero-illustration">🎂</div>
            <div class="hero-stats">
                <div class="hero-stat">
                    <strong>{{ $products->count() }}+</strong>
                    <span>Pilihan Kue</span>
                </div>
                <div class="hero-stat">
                    <strong>100%</strong>
                    <span>Homemade</span>
                </div>
            </div>
        </div>

    </section>

    {{-- ══ FILTER ══ --}}
    <div class="filter-section">
        <span class="filter-label">Kategori</span>
        <div class="filter-bar">
            <button class="filter-btn active" onclick="filterCategory(this, 'semua')">Semua</button>
            <button class="filter-btn" onclick="filterCategory(this, 'Birthday Cake')">Birthday Cake</button>
            <button class="filter-btn" onclick="filterCategory(this, 'Cupcakes')">Cupcakes</button>
            <button class="filter-btn" onclick="filterCategory(this, 'Sweet Cakes')">Sweet Cakes</button>
            <button class="filter-btn" onclick="filterCategory(this, 'Others')">Others</button>
        </div>
    </div>

    {{-- ══ PRODUCT GRID ══ --}}
    <div class="product-grid" id="productGrid">

        @forelse($products as $product)

            <div class="product-card" data-category="{{ $product->category }}">

                {{-- SLIDER --}}
                <div class="card-slider" data-cat="{{ $product->category }}">

                    @if($product->images->count())

                        @foreach($product->images as $key => $image)
                            <img src="{{ asset('storage/' . $image->image) }}"
                                 class="slide-img slide-{{ $product->id }}"
                                 style="opacity:{{ $key == 0 ? '1' : '0' }}; z-index:{{ $key == 0 ? 2 : 1 }};"
                                 alt="{{ $product->name }}">
                        @endforeach

                        <div class="slider-dots" id="dots-{{ $product->id }}">
                            @foreach($product->images as $key => $image)
                                <span class="{{ $key == 0 ? 'active-dot' : '' }}"></span>
                            @endforeach
                        </div>

                    @else
                        <div class="no-img-placeholder">
                            <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            Belum ada foto
                        </div>
                    @endif
                </div>

                {{-- BODY --}}
                <div class="card-body">
                    <h3 class="product-name">{{ $product->name }}</h3>
                    <p class="product-desc">{{ $product->description ?: 'Kue lezat buatan tangan dengan bahan-bahan pilihan berkualitas tinggi.' }}</p>

                    <div class="card-footer">
                        <div class="product-price">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                            @if($product->category === 'Cupcake')
                                <small>/pcs</small>
                            @endif
                        </div>

                        <button class="btn-order"
                            onclick="openOrderModal(
                                '{{ $product->id }}',
                                '{{ addslashes($product->name) }}',
                                '{{ $product->price }}',
                                [{{ $product->images->map(fn($i) => '"'.asset('storage/'.$i->image).'"')->join(',') }}],
                                '{{ addslashes($product->description) }}'
                            )">
                            <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                            Pesan
                        </button>
                    </div>
                </div>

            </div>

        @empty

            <div class="empty-state">
                <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                <p>Belum ada produk tersedia.</p>
            </div>

        @endforelse

    </div>

</div>

@include('user.order-modal')

@endsection

@push('scripts')
<script>
    // ── Filter ──────────────────────────────────
    function filterCategory(btn, category) {
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        document.querySelectorAll('.product-card').forEach((card, i) => {
            const match = category === 'semua' || card.dataset.category === category;
            card.style.display = match ? 'flex' : 'none';
            if (match) {
                card.style.animationDelay = (i * 0.05) + 's';
                card.style.animation = 'none';
                void card.offsetWidth; // reflow
                card.style.animation = '';
            }
        });
    }

    // ── Image Slider ─────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($products as $product)
        @if($product->images->count() > 1)
        (function () {
            const slides = document.querySelectorAll('.slide-{{ $product->id }}');
            const dots   = document.querySelectorAll('#dots-{{ $product->id }} span');
            let cur = 0;

            setInterval(() => {
                slides[cur].style.opacity = '0';
                slides[cur].style.zIndex  = '1';
                dots[cur].classList.remove('active-dot');

                cur = (cur + 1) % slides.length;

                slides[cur].style.opacity = '1';
                slides[cur].style.zIndex  = '2';
                dots[cur].classList.add('active-dot');
            }, 3800);
        })();
        @endif
        @endforeach
    });
</script>
@endpush