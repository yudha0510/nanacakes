<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NanaCakes – Handmade with Love</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --espresso: #2c1206;
            --amber:    #c47a3a;
            --amber-lt: #e09040;
            --wheat:    #f5deb3;
            --cream:    #fff8ee;
            --ink:      #1a0a02;
            --muted:    rgba(245,222,179,0.55);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--ink);
            color: var(--cream);
            overflow-x: hidden;
        }

        /* ─── HERO ─────────────────────────────── */
        .hero {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('{{ asset("images/da.jpg") }}');
            background-size: cover;
            background-position: center;
            transform: scale(1.06);
            transition: transform 8s ease-out;
        }

        .hero-bg.loaded { transform: scale(1); }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(26,10,2,0.55) 0%,
                rgba(26,10,2,0.38) 45%,
                rgba(26,10,2,0.72) 100%
            );
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 0 24px;
            max-width: 640px;
        }

        .hero-eyebrow {
            display: inline-block;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--wheat);
            margin-bottom: 20px;
            opacity: 0;
            transform: translateY(12px);
            animation: fadeUp 0.7s 0.2s ease forwards;
        }

        .hero-logo-wrap {
            position: relative;
            display: inline-block;
            margin-bottom: 6px;
            opacity: 0;
            transform: translateY(14px);
            animation: fadeUp 0.8s 0.4s ease forwards;
        }

        .hero-logo {
            font-family: 'Playfair Display', serif;
            font-size: clamp(54px, 10vw, 88px);
            font-weight: 700;
            color: var(--cream);
            line-height: 1;
            letter-spacing: -1px;
        }

        /* Signature: thin amber rule cutting through logo */
        .hero-logo-rule {
            position: absolute;
            left: -8px;
            right: -8px;
            top: 50%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--amber), var(--amber-lt), var(--amber), transparent);
            transform: translateY(-50%);
            opacity: 0.7;
        }

        .hero-tagline {
            font-family: 'Playfair Display', serif;
            font-style: italic;
            font-size: clamp(15px, 2.2vw, 18px);
            color: var(--wheat);
            letter-spacing: 0.3px;
            margin-top: 10px;
            margin-bottom: 36px;
            opacity: 0;
            transform: translateY(12px);
            animation: fadeUp 0.8s 0.6s ease forwards;
        }

        .hero-cta-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 14px;
            opacity: 0;
            transform: translateY(12px);
            animation: fadeUp 0.8s 0.8s ease forwards;
        }

        .btn-primary {
            display: inline-block;
            background: var(--amber);
            color: var(--cream);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 15px 52px;
            border-radius: 50px;
            text-decoration: none;
            border: 1px solid rgba(255,200,120,0.3);
            transition: background 0.2s, transform 0.18s, box-shadow 0.2s;
            box-shadow: 0 4px 28px rgba(196,122,58,0.4);
        }

        .btn-primary:hover {
            background: var(--amber-lt);
            transform: translateY(-3px);
            box-shadow: 0 10px 36px rgba(196,122,58,0.55);
        }

        .btn-primary:active { transform: scale(0.97); }

        .hero-note {
            font-size: 11px;
            color: rgba(245,222,179,0.45);
            letter-spacing: 0.6px;
        }

        /* Scroll cue */
        .scroll-cue {
            position: absolute;
            bottom: 28px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            opacity: 0;
            animation: fadeIn 1s 1.4s ease forwards;
        }

        .scroll-cue span {
            font-size: 9px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--muted);
        }

        .scroll-cue-line {
            width: 1px;
            height: 36px;
            background: linear-gradient(to bottom, var(--amber), transparent);
            animation: scrollPulse 1.8s 1.6s ease-in-out infinite;
        }

        /* ─── PRODUCTS SECTION ─────────────────── */
        .section-products {
            padding: 72px 0 80px;
            background: var(--ink);
        }

        .section-header {
            text-align: center;
            padding: 0 24px;
            margin-bottom: 44px;
        }

        .section-eyebrow {
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: var(--amber);
            display: block;
            margin-bottom: 10px;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(26px, 4vw, 36px);
            font-weight: 700;
            color: var(--cream);
            line-height: 1.2;
        }

        /* Carousel */
        .carousel-outer {
            position: relative;
        }

        .carousel-track-wrap {
            overflow: hidden;
            padding: 8px 0 24px;
        }

        .carousel-track {
            display: flex;
            gap: 20px;
            padding: 0 48px;
            transition: transform 0.45s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: transform;
        }

        .product-card {
            flex: 0 0 240px;
            background: rgba(255,248,238,0.04);
            border: 0.5px solid rgba(196,122,58,0.18);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
            cursor: default;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px rgba(0,0,0,0.4);
            border-color: rgba(196,122,58,0.38);
        }

        .product-img-wrap {
            width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
            background: rgba(44,18,6,0.5);
        }

        .product-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
            display: block;
        }

        .product-card:hover .product-img-wrap img {
            transform: scale(1.06);
        }

        .product-info {
            padding: 14px 16px 16px;
        }

        .product-name {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 4px;
        }

        .product-desc {
            font-size: 11px;
            color: rgba(245,222,179,0.55);
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 13px;
            font-weight: 600;
            color: var(--amber);
        }

        /* Carousel nav buttons */
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(44,18,6,0.85);
            border: 0.5px solid rgba(196,122,58,0.35);
            color: var(--wheat);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            z-index: 4;
            transition: background 0.2s, border-color 0.2s;
            backdrop-filter: blur(4px);
        }

        .carousel-btn:hover {
            background: var(--amber);
            border-color: var(--amber);
        }

        .carousel-btn svg { pointer-events: none; }
        .carousel-btn-prev { left: 8px; }
        .carousel-btn-next { right: 8px; }

        /* Dots */
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 8px;
        }

        .dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: rgba(196,122,58,0.3);
            transition: background 0.25s, width 0.25s;
            cursor: pointer;
        }

        .dot.active {
            background: var(--amber);
            width: 18px;
            border-radius: 3px;
        }

        /* ─── FOOTER CTA ───────────────────────── */
        .footer-cta {
            text-align: center;
            padding: 56px 24px 64px;
            border-top: 0.5px solid rgba(196,122,58,0.12);
        }

        .footer-cta p {
            font-size: 13px;
            color: rgba(245,222,179,0.45);
            letter-spacing: 0.5px;
            margin-top: 14px;
        }

        /* ─── ANIMATIONS ───────────────────────── */
        @keyframes fadeUp {
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }

        @keyframes scrollPulse {
            0%, 100% { opacity: 0.4; transform: scaleY(0.8); }
            50%       { opacity: 1;   transform: scaleY(1); }
        }

        /* ─── RESPONSIVE ───────────────────────── */
        @media (max-width: 600px) {
            .carousel-track { padding: 0 20px; gap: 14px; }
            .product-card { flex: 0 0 200px; }
            .carousel-btn { display: none; }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body>

<!-- ─── HERO ─────────────────────────────────── -->
<section class="hero">
    <div class="hero-bg" id="heroBg"></div>
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <span class="hero-eyebrow">Handmade with Love · Since 2020</span>

        <div class="hero-logo-wrap">
            <div class="hero-logo">NanaCakes</div>
            <div class="hero-logo-rule"></div>
        </div>

        <div class="hero-tagline">Every bite tells a story</div>

        <div class="hero-cta-wrap">
            <a href="{{ route('login') }}" class="btn-primary">Order Now</a>
            <span class="hero-note">Login diperlukan untuk melanjutkan pemesanan</span>
        </div>
    </div>

    <div class="scroll-cue">
        <span>Scroll</span>
        <div class="scroll-cue-line"></div>
    </div>
</section>

<!-- ─── PRODUK ───────────────────────────────── -->
<section class="section-products">
    <div class="section-header">
        <span class="section-eyebrow">Menu Pilihan</span>
        <h2 class="section-title">Dibuat dari bahan terbaik,<br>dengan resep turun-temurun</h2>
    </div>

    <div class="carousel-outer">
        <button class="carousel-btn carousel-btn-prev" id="prevBtn" aria-label="Previous">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
        </button>

        <div class="carousel-track-wrap">
            <div class="carousel-track" id="carouselTrack">

                {{-- ── GANTI path foto & nama produk sesuai data kamu ── --}}
                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ asset('images/ayo.jpg') }}" alt="Birthday Cake" loading="lazy">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Black Forest</div>
                        <div class="product-desc">Kue coklat pekat berlapis ganache rich chocolate, tekstur moist dan padat, surga bagi pecinta coklat sejati</div>
                        <div class="product-price">Mulai Rp 220.000</div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ asset('images/hbd.jpg') }}" alt="Red Velvet" loading="lazy">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Elegant Birthday Cake</div>
                        <div class="product-desc">Kue ulang tahun elegan dengan lapisan buttercream lembut dan dekorasi pita cantik</div>
                        <div class="product-price">Mulai Rp 315.000</div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ asset('images/na.jpg') }}" alt="Choco Fudge" loading="lazy">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Nastar Nanas</div>
                        <div class="product-desc">Nastar legendaris dengan selai nanas homemade yang manis segar, kulit butter lembut</div>
                        <div class="product-price">Mulai Rp 60.000</div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ asset('images/mc.jpg') }}" alt="Lemon Drizzle" loading="lazy">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Matcha Cake</div>
                        <div class="product-desc">Kue dengan cita rasa matcha premium, buttercream lembut berpadu rasa sedikit pahit yang khas</div>
                        <div class="product-price">Mulai Rp 140.000</div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ asset('images/bc.jpg') }}" alt="Wedding Tier" loading="lazy">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Bento Cakes</div>
                        <div class="product-desc">Kue mini ukuran 10cm ala Korea yang aesthetic dan customizable, cocok untuk hadiah personal atau perayaan intim</div>
                        <div class="product-price">Mulai Rp 90.000</div>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-img-wrap">
                        <img src="{{ asset('images/cm.jpg') }}" alt="Pandan Layer" loading="lazy">
                    </div>
                    <div class="product-info">
                        <div class="product-name">Chocolate Fudge Cake</div>
                        <div class="product-desc">Kue coklat pekat berlapis ganache rich chocolate, tekstur moist dan padat, surga bagi pecinta coklat sejati</div>
                        <div class="product-price">Mulai Rp 220.000</div>
                    </div>
                </div>

            </div>
        </div>

        <button class="carousel-btn carousel-btn-next" id="nextBtn" aria-label="Next">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"/>
            </svg>
        </button>
    </div>

    <div class="carousel-dots" id="carouselDots"></div>
</section>

<!-- ─── FOOTER CTA ─────────────────────────── -->
<div class="footer-cta">
    <a href="{{ route('login') }}" class="btn-primary">Mulai Pesan Sekarang</a>
    <p>© {{ date('Y') }} NanaCakes · Handmade with Love</p>
</div>

<script>
    // Hero bg load animation
    const heroBg = document.getElementById('heroBg');
    const tempImg = new Image();
    tempImg.onload = () => heroBg.classList.add('loaded');
    tempImg.src = heroBg.style.backgroundImage.replace(/url\(['"]?(.*?)['"]?\)/, '$1')
                  || "{{ asset('images/hero-bg.jpg') }}";
    heroBg.classList.add('loaded');

    // Carousel
    const track = document.getElementById('carouselTrack');
    const cards = track.querySelectorAll('.product-card');
    const dotsWrap = document.getElementById('carouselDots');
    const CARD_W = () => cards[0].offsetWidth + 20; // width + gap
    const VISIBLE = () => Math.floor(track.parentElement.offsetWidth / CARD_W());

    let current = 0;
    const maxIndex = () => Math.max(0, cards.length - VISIBLE());

    // Build dots
    const totalDots = () => maxIndex() + 1;
    function buildDots() {
        dotsWrap.innerHTML = '';
        for (let i = 0; i < totalDots(); i++) {
            const d = document.createElement('div');
            d.className = 'dot' + (i === current ? ' active' : '');
            d.addEventListener('click', () => goTo(i));
            dotsWrap.appendChild(d);
        }
    }

    function updateDots() {
        dotsWrap.querySelectorAll('.dot').forEach((d, i) => {
            d.classList.toggle('active', i === current);
        });
    }

    function goTo(idx) {
        current = Math.max(0, Math.min(idx, maxIndex()));
        track.style.transform = `translateX(-${current * CARD_W()}px)`;
        updateDots();
    }

    document.getElementById('prevBtn').addEventListener('click', () => goTo(current - 1));
    document.getElementById('nextBtn').addEventListener('click', () => goTo(current + 1));

    // Drag / swipe
    let startX = 0, dragging = false;
    track.addEventListener('mousedown', e => { startX = e.clientX; dragging = true; });
    track.addEventListener('mousemove', e => { if (!dragging) return; e.preventDefault(); });
    track.addEventListener('mouseup', e => {
        if (!dragging) return;
        dragging = false;
        const diff = startX - e.clientX;
        if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
    });
    track.addEventListener('mouseleave', () => { dragging = false; });

    track.addEventListener('touchstart', e => { startX = e.touches[0].clientX; }, { passive: true });
    track.addEventListener('touchend', e => {
        const diff = startX - e.changedTouches[0].clientX;
        if (Math.abs(diff) > 40) goTo(diff > 0 ? current + 1 : current - 1);
    });

    buildDots();
    window.addEventListener('resize', () => { buildDots(); goTo(Math.min(current, maxIndex())); });
</script>

</body>
</html>