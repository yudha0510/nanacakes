@extends('layouts.user')

@section('title', 'Pusat Bantuan')

@section('styles')
<style>
    .help-wrap {
        max-width: 680px;
        margin: 0 auto;
        padding: 40px 32px 80px;
    }

    /* ── HERO ─────────────────────────────────── */
    .help-hero {
        background: var(--cocoa);
        border-radius: var(--radius-lg);
        padding: 32px 30px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
    }

    .help-hero::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 200px; height: 200px;
        border-radius: 50%;
        background: rgba(181,96,26,.12);
        pointer-events: none;
    }

    .help-hero::after {
        content: '';
        position: absolute;
        bottom: -30px; left: 30%;
        width: 130px; height: 130px;
        border-radius: 50%;
        background: rgba(181,96,26,.07);
        pointer-events: none;
    }

    .help-hero-eyebrow {
        font-size: 10.5px;
        letter-spacing: 2.2px;
        text-transform: uppercase;
        color: rgba(245,210,160,.45);
        margin-bottom: 10px;
        font-weight: 500;
    }

    .help-hero-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 32px;
        font-weight: 700;
        color: #fff8ee;
        line-height: 1.2;
        margin-bottom: 12px;
        letter-spacing: .3px;
    }

    .help-hero-desc {
        font-size: 14px;
        color: rgba(245,210,160,.62);
        line-height: 1.75;
        max-width: 480px;
    }

    /* ── SECTION ──────────────────────────────── */
    .help-section {
        margin-bottom: 28px;
    }

    .help-section-label {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 10.5px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: var(--caramel);
        font-weight: 500;
        margin-bottom: 14px;
    }

    .help-section-label::after {
        content: '';
        flex: 1;
        height: 0.5px;
        background: rgba(44,22,8,.1);
    }

    .help-section-label svg {
        width: 14px; height: 14px;
        stroke: currentColor; fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
        flex-shrink: 0;
    }

    .help-card {
        background: #fff;
        border: 0.5px solid rgba(44,22,8,.1);
        border-radius: var(--radius-lg);
        overflow: hidden;
    }

    /* ── STEPS ────────────────────────────────── */
    .step-list {
        display: flex;
        flex-direction: column;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 11px 20px;
        border-bottom: 0.5px solid rgba(44,22,8,.06);
        transition: background .15s;
    }

    .step-item:last-child { border-bottom: none; }

    .step-item:hover { background: #fdf6ee; }

    .step-num {
        width: 28px; height: 28px;
        border-radius: 50%;
        background: var(--cocoa);
        color: #ffedd0;
        font-size: 12px;
        font-weight: 600;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        letter-spacing: .3px;
    }

    .step-content {
        flex: 1;
    }

    .step-title {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
        line-height: 1.5;
    }

    /* ── CATEGORIES ───────────────────────────── */
    .cat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 10px;
    }

    .cat-card {
        background: #fff;
        border: 0.5px solid rgba(44,22,8,.1);
        border-radius: var(--radius-md);
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: border-color .15s, background .15s;
        text-decoration: none;
    }

    .cat-card:hover {
        border-color: rgba(181,96,26,.3);
        background: #fdf6ee;
    }

    .cat-icon {
        width: 38px; height: 38px;
        border-radius: var(--radius-sm);
        background: var(--cocoa);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .cat-icon svg {
        width: 17px; height: 17px;
        stroke: #ffedd0; fill: none;
        stroke-width: 1.8;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .cat-name {
        font-size: 13px;
        font-weight: 500;
        color: var(--text-primary);
        line-height: 1.3;
    }

    /* ── LOCATION ─────────────────────────────── */
    .location-body {
        padding: 20px;
    }

    .location-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
    }

    .location-icon {
        width: 34px; height: 34px;
        border-radius: var(--radius-sm);
        background: rgba(181,96,26,.1);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .location-icon svg {
        width: 16px; height: 16px;
        stroke: var(--caramel); fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .location-info-label {
        font-size: 11px;
        color: var(--text-muted);
        margin-bottom: 2px;
        letter-spacing: .5px;
    }

    .location-info-value {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
    }

    .map-placeholder {
        border-radius: var(--radius-md);
        overflow: hidden;
        border: 0.5px solid rgba(44,22,8,.08);
        height: 180px;
        background: var(--cream-dark);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: var(--text-muted);
        font-size: 13px;
    }

    .map-placeholder svg {
        width: 28px; height: 28px;
        stroke: currentColor; fill: none;
        stroke-width: 1.5;
        stroke-linecap: round; stroke-linejoin: round;
        opacity: .5;
    }

    /* ── CONTACT ──────────────────────────────── */
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .contact-card {
        background: #fff;
        border: 0.5px solid rgba(44,22,8,.1);
        border-radius: var(--radius-md);
        padding: 16px;
        transition: border-color .15s;
    }

    .contact-card:hover { border-color: rgba(181,96,26,.25); }

    .contact-card.full { grid-column: 1 / -1; }

    .contact-card-top {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .contact-badge {
        width: 28px; height: 28px;
        border-radius: var(--radius-sm);
        background: rgba(181,96,26,.1);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }

    .contact-badge svg {
        width: 14px; height: 14px;
        stroke: var(--caramel); fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .contact-type {
        font-size: 11px;
        color: var(--text-muted);
        letter-spacing: .5px;
        text-transform: uppercase;
    }

    .contact-value {
        font-size: 13.5px;
        font-weight: 500;
        color: var(--text-primary);
    }

    /* ── FAQ ──────────────────────────────────── */
    .faq-list {
        display: flex;
        flex-direction: column;
    }

    .faq-item {
        border-bottom: 0.5px solid rgba(44,22,8,.06);
    }

    .faq-item:last-child { border-bottom: none; }

    .faq-question {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        padding: 16px 20px;
        cursor: pointer;
        user-select: none;
        list-style: none;
        transition: background .15s;
    }

    .faq-question:hover { background: #fdf6ee; }

    .faq-question::-webkit-details-marker { display: none; }

    .faq-q-text {
        font-size: 14px;
        font-weight: 500;
        color: var(--text-primary);
        line-height: 1.5;
    }

    .faq-chevron {
        width: 18px; height: 18px;
        stroke: var(--text-muted); fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
        flex-shrink: 0;
        transition: transform .2s;
    }

    details[open] .faq-chevron {
        transform: rotate(180deg);
    }

    .faq-answer {
        padding: 0 20px 16px 20px;
        font-size: 13.5px;
        color: var(--text-muted);
        line-height: 1.75;
    }

    /* ── RESPONSIVE ───────────────────────────── */
    @media (max-width: 600px) {
        .help-wrap { padding: 24px 16px 60px; }
        .help-hero { padding: 28px 22px; }
        .help-hero-title { font-size: 26px; }
        .contact-grid { grid-template-columns: 1fr; }
        .contact-card.full { grid-column: 1; }
        .cat-grid { grid-template-columns: 1fr 1fr; }
    }
</style>
@endsection

@section('content')
<div class="help-wrap">

    {{-- ── HERO ─────────────────────────────── --}}
    <div class="help-hero">
        <div class="help-hero-eyebrow">Pusat Bantuan</div>
        <div class="help-hero-title">Halo! Ada yang bisa<br>kami bantu? 👋</div>
        <div class="help-hero-desc">
            NanaCakes adalah layanan pemesanan kue homemade yang menyediakan berbagai pilihan kue
            untuk ulang tahun, pernikahan, dan berbagai acara spesial lainnya.
        </div>
    </div>

    {{-- ── CARA PEMESANAN ───────────────────── --}}
    <div class="help-section">
        <div class="help-section-label">
            <svg viewBox="0 0 24 24"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"/></svg>
            Cara Pemesanan
        </div>
        <div class="help-card">
            <div class="step-list">
                @php
                $steps = [
                    ['num' => 1, 'title' => 'Pilih kue pada halaman menu'],
                    ['num' => 2, 'title' => 'Masukkan ke keranjang'],
                    ['num' => 3, 'title' => 'Lakukan checkout'],
                    ['num' => 4, 'title' => 'Transfer pembayaran sesuai total pesanan'],
                    ['num' => 5, 'title' => 'Upload bukti pembayaran'],
                    ['num' => 6, 'title' => 'Admin memverifikasi pesanan'],
                    ['num' => 7, 'title' => 'Pesanan diproses, selesai dan siap diambil'],
                ];
                @endphp

                @foreach($steps as $step)
                <div class="step-item">
                    <div class="step-num">{{ $step['num'] }}</div>
                    <div class="step-content">
                        <div class="step-title">{{ $step['title'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── KATEGORI KUE ──────────────────────── --}}
    <div class="help-section">
        <div class="help-section-label">
            <svg viewBox="0 0 24 24"><path d="M12 2C8 2 5 5 5 8c0 4 3 6 3 10h8c0-4 3-6 3-10 0-3-3-6-7-6z"/><line x1="9" y1="18" x2="15" y2="18"/><line x1="10" y1="21" x2="14" y2="21"/></svg>
            Kategori Kue
        </div>
        <div class="cat-grid">
            <a href="{{ url('/menu?category=birthday') }}" class="cat-card">
                <div class="cat-icon">
                    <svg viewBox="0 0 24 24"><path d="M20 7H4a2 2 0 00-2 2v10a2 2 0 002 2h16a2 2 0 002-2V9a2 2 0 00-2-2z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/><line x1="12" y1="12" x2="12" y2="16"/><line x1="10" y1="14" x2="14" y2="14"/></svg>
                </div>
                <div class="cat-name">Birthday Cakes</div>
            </a>
            <a href="{{ url('/menu?category=wedding') }}" class="cat-card">
                <div class="cat-icon">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                </div>
                <div class="cat-name">Cupcakes</div>
            </a>
            <a href="{{ url('/menu?category=sweet') }}" class="cat-card">
                <div class="cat-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 100 20A10 10 0 0012 2z"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>
                </div>
                <div class="cat-name">Sweet Cakes</div>
            </a>
            <a href="{{ url('/menu?category=other') }}" class="cat-card">
                <div class="cat-icon">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                </div>
                <div class="cat-name">Other</div>
            </a>
        </div>
    </div>

    {{-- ── LOKASI TOKO ───────────────────────── --}}
    <div class="help-section">
        <div class="help-section-label">
            <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
            Lokasi Toko
        </div>
        <div class="help-card">
            <div class="location-body">
                <div class="location-row">
                    <div class="location-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <div class="location-info-label">Alamat</div>
                        <div class="location-info-value">Jl. XXXXXXX, Boyolali, Jawa Tengah</div>
                    </div>
                </div>
                {{-- Google Maps --}}
                <iframe
                    src="https://www.google.com/maps/embed?pb=!4v1780989311007!6m8!1m7!1sb6ogzAF2U9rgceHpseKPwQ!2m2!1d-7.56361899316569!2d110.7136123286636!3f347.99909876789263!4f-0.7141091654585665!5f0.7820865974627469"
                    width="100%"
                    height="180"
                    style="border:0; border-radius: var(--radius-md);"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>  
        </div>
    </div>

    {{-- ── HUBUNGI ADMIN ─────────────────────── --}}
    <div class="help-section">
        <div class="help-section-label">
            <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.22 1.18 2 2 0 012.18 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.06 6.06l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
            Hubungi Admin
        </div>
        <div class="contact-grid">
            <div class="contact-card">
                <div class="contact-card-top">
                    <div class="contact-badge">
                        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.22 1.18 2 2 0 012.18 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.06 6.06l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                    </div>
                    <div class="contact-type">WhatsApp</div>
                </div>
                <div class="contact-value">089527588500</div>
            </div>

            <div class="contact-card">
                <div class="contact-card-top">
                    <div class="contact-badge">
                        <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div class="contact-type">Email</div>
                </div>
                <div class="contact-value">nanacakes@gmail.com</div>
            </div>

            <div class="contact-card full">
                <div class="contact-card-top">
                    <div class="contact-badge">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div class="contact-type">Jam Operasional</div>
                </div>
                <div class="contact-value">Senin – Minggu, 08.00 – 20.00 WIB</div>
            </div>
        </div>
    </div>

    {{-- ── FAQ ───────────────────────────────── --}}
    <div class="help-section">
        <div class="help-section-label">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 015.82 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
            FAQ
        </div>
        <div class="help-card">
            <div class="faq-list">

                <details class="faq-item">
                    <summary class="faq-question">
                        <span class="faq-q-text">Berapa lama proses pembuatan kue?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="faq-answer">
                        1–3 hari tergantung jenis kue yang dipesan. Untuk kue custom atau pesanan dalam jumlah besar, waktu pengerjaan bisa lebih lama. Silakan konfirmasi ke admin terlebih dahulu.
                    </div>
                </details>

                <details class="faq-item">
                    <summary class="faq-question">
                        <span class="faq-q-text">Apakah bisa custom desain?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="faq-answer">
                        Ya, NanaCakes menerima pesanan dengan desain custom. Hubungi admin via WhatsApp atau email untuk mendiskusikan desain, ukuran, dan pilihan rasa yang diinginkan.
                    </div>
                </details>

                <details class="faq-item">
                    <summary class="faq-question">
                        <span class="faq-q-text">Apakah bisa membatalkan pesanan?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="faq-answer">
                        Pembatalan pesanan hanya bisa dilakukan sebelum pesanan diproses oleh admin. Segera hubungi admin jika ingin membatalkan. Pesanan yang sudah diproses tidak dapat dibatalkan.
                    </div>
                </details>

                <details class="faq-item">
                    <summary class="faq-question">
                        <span class="faq-q-text">Metode pembayaran apa saja yang diterima?</span>
                        <svg class="faq-chevron" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
                    </summary>
                    <div class="faq-answer">
                        Saat ini NanaCakes menerima pembayaran via transfer bank. Setelah checkout, detail rekening tujuan akan ditampilkan. Jangan lupa upload bukti transfer agar pesanan segera diverifikasi.
                    </div>
                </details>

            </div>
        </div>
    </div>

</div>
@endsection