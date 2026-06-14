@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');

/* ── RESET & BASE ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── PAGE ── */
.rwy-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #1a0a02;
    min-height: 100vh;
    padding: 28px 32px 60px;
    color: #fff8ee;
}

/* ── HEADER ── */
.rwy-header { margin-bottom: 28px; }

.rwy-header-eyebrow {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #c47a3a;
    display: block;
    margin-bottom: 6px;
}

.rwy-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3.5vw, 2.2rem);
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 4px;
    line-height: 1.15;
}

.rwy-header p {
    font-size: 13px;
    color: rgba(245,222,179,0.5);
    margin-bottom: 20px;
}

/* ── TABS ── */
.rwy-tabs { display: flex; gap: 8px; flex-wrap: wrap; }

.rwy-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    border-radius: 999px;
    border: 0.5px solid rgba(196,122,58,0.25);
    background: rgba(255,248,238,0.04);
    color: rgba(245,222,179,0.5);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all 0.18s ease;
}

.rwy-tab:hover {
    background: rgba(196,122,58,0.12);
    color: rgba(245,222,179,0.85);
    border-color: rgba(196,122,58,0.4);
}

.rwy-tab.active {
    background: #c47a3a;
    color: #fff8ee;
    border-color: #c47a3a;
}

/* ── LIST ── */
.rwy-list { display: flex; flex-direction: column; gap: 14px; }

/* ── CARD ── */
.rwy-card {
    background: rgba(255,248,238,0.04);
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 16px;
    overflow: hidden;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.rwy-card:hover {
    border-color: rgba(196,122,58,0.35);
    box-shadow: 0 4px 24px rgba(0,0,0,0.3);
}

/* ── CARD HEADER ── */
.rwy-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 22px;
}

.rwy-thumb {
    width: 54px;
    height: 54px;
    border-radius: 10px;
    object-fit: cover;
    border: 0.5px solid rgba(196,122,58,0.2);
    flex-shrink: 0;
    background: rgba(44,18,6,0.5);
}

.rwy-meta { flex: 1; min-width: 0; }

.rwy-order-code {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.04em;
    color: rgba(196,122,58,0.7);
    font-family: 'Courier New', monospace;
    margin-bottom: 3px;
}

.rwy-product-name {
    font-size: 14px;
    font-weight: 700;
    color: #fff8ee;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 4px;
}

.rwy-product-sub {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.rwy-product-date {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: rgba(245,222,179,0.45);
}

.rwy-product-price {
    font-size: 12px;
    font-weight: 700;
    color: #c47a3a;
}

/* ── BADGE ── */
.rwy-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    flex-shrink: 0;
    white-space: nowrap;
}

.rwy-badge-completed { background: rgba(16,185,129,0.1); color: #34d399; border: 0.5px solid rgba(16,185,129,0.25); }
.rwy-badge-cancelled { background: rgba(255,248,238,0.05); color: rgba(245,222,179,0.45); border: 0.5px solid rgba(245,222,179,0.1); }

/* ── TOGGLE ── */
.rwy-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 22px;
    background: rgba(44,18,6,0.4);
    border: none;
    border-top: 0.5px solid rgba(196,122,58,0.12);
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    color: rgba(245,222,179,0.5);
    font-weight: 500;
    transition: background 0.15s;
}

.rwy-toggle:hover {
    background: rgba(196,122,58,0.08);
    color: rgba(245,222,179,0.8);
}

.rwy-toggle svg { transition: transform 0.22s ease; flex-shrink: 0; }
.rwy-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }

/* ── CARD BODY ── */
.rwy-body { display: none; border-top: 0.5px solid rgba(196,122,58,0.12); }
.rwy-body.open { display: block; }

/* ── DETAIL ── */
.rwy-detail { padding: 18px 22px; }

.rwy-section-label {
    font-size: 10px;
    font-weight: 700;
    color: #c47a3a;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
}

/* ── ITEMS ── */
.rwy-item {
    padding: 12px 0;
    border-bottom: 0.5px dashed rgba(196,122,58,0.15);
}

.rwy-item:last-child { border-bottom: none; padding-bottom: 0; }

.rwy-item-name {
    font-size: 13px;
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 8px;
}

.rwy-item-rows {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.rwy-item-row {
    display: flex;
    align-items: baseline;
    gap: 8px;
    font-size: 12px;
}

.rwy-item-row .lbl {
    font-weight: 600;
    color: rgba(196,122,58,0.8);
    min-width: 90px;
    flex-shrink: 0;
}

.rwy-item-row .val { color: rgba(245,222,179,0.75); }

/* ── EMPTY ── */
.rwy-empty {
    text-align: center;
    padding: 5rem 1rem;
    color: rgba(245,222,179,0.4);
}

.rwy-empty-icon { font-size: 48px; margin-bottom: 16px; }

.rwy-empty h3 {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 8px;
}

.rwy-empty p { font-size: 13px; }

/* ── ANIMATIONS ── */
@keyframes rwyFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .rwy-page { padding: 20px 16px 48px; }
}

@media (max-width: 480px) {
    .rwy-card-header { gap: 10px; }
    .rwy-thumb { width: 44px; height: 44px; }
    .rwy-badge { font-size: 10.5px; padding: 4px 10px; }
    .rwy-item-row .lbl { min-width: 70px; }
}
</style>

<div class="rwy-page">

    {{-- ── HEADER + TABS ── --}}
    <div class="rwy-header">
        <span class="rwy-header-eyebrow">NanaCakes · Pre-Order</span>
        <h1>Riwayat Pesanan</h1>
        <p>Rekap seluruh pesanan kamu</p>

        <div class="rwy-tabs">
            <a href="{{ route('pembayaran') }}"
               class="rwy-tab {{ request()->routeIs('pembayaran') ? 'active' : '' }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Pembayaran
            </a>
            <a href="{{ route('tracking') }}"
               class="rwy-tab {{ request()->routeIs('tracking') ? 'active' : '' }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                Tracking
            </a>
            <a href="{{ route('riwayat') }}"
               class="rwy-tab {{ request()->routeIs('riwayat') ? 'active' : '' }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="12 8 12 12 14 14"/><path d="M3.05 11a9 9 0 1 1 .5 4"/><polyline points="3 16 3 11 8 11"/></svg>
                Riwayat
            </a>
        </div>
    </div>

    {{-- ── ORDER LIST ── --}}
    <div class="rwy-list">

        @forelse ($historyOrders as $order)

            <div class="rwy-card"
                 style="animation: rwyFadeUp 0.35s ease both; animation-delay: {{ $loop->index * 0.07 }}s">

                {{-- CARD HEADER --}}
                <div class="rwy-card-header">

                    @if ($order->items->count())
                        <img src="{{ asset('storage/' . $order->items->first()->product_image) }}"
                             class="rwy-thumb"
                             alt="{{ $order->items->first()->product_name }}">
                        <div class="rwy-meta">
                            <div class="rwy-order-code">{{ $order->order_code }}</div>
                            <div class="rwy-product-name">{{ $order->items->first()->product_name }}</div>
                            <div class="rwy-product-sub">
                                <span class="rwy-product-date">
                                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                    {{ $order->created_at->format('d M Y') }}
                                </span>
                                <span class="rwy-product-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- STATUS BADGE --}}
                    @if ($order->status === 'completed')
                        <span class="rwy-badge rwy-badge-completed">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Selesai
                        </span>
                    @else
                        <span class="rwy-badge rwy-badge-cancelled">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                            Dibatalkan
                        </span>
                    @endif

                </div>

                {{-- TOGGLE --}}
                <button class="rwy-toggle" aria-expanded="false" onclick="rwyToggle(this)">
                    <span>Lihat detail pesanan</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>

                {{-- CARD BODY --}}
                <div class="rwy-body">
                    <div class="rwy-detail">
                        <div class="rwy-section-label">Detail Item Pesanan</div>

                        @foreach ($order->items as $item)
                            <div class="rwy-item">
                                <div class="rwy-item-name">{{ $item->product_name }}</div>
                                <div class="rwy-item-rows">

                                    <div class="rwy-item-row">
                                        <span class="lbl">Jumlah</span>
                                        <span class="val">{{ $item->qty }} pcs</span>
                                    </div>

                                    <div class="rwy-item-row">
                                        <span class="lbl">Paper Bag</span>
                                        <span class="val">{{ $item->paper_bag ? 'Ya' : 'Tidak' }}</span>
                                    </div>

                                    <div class="rwy-item-row">
                                        <span class="lbl">Lilin</span>
                                        <span class="val">{{ $item->use_candle ? 'Ya' : 'Tidak' }}</span>
                                    </div>

                                    @if ($item->use_candle)
                                        <div class="rwy-item-row">
                                            <span class="lbl">Angka Lilin</span>
                                            <span class="val">{{ $item->candle_1 }} {{ $item->candle_2 }}</span>
                                        </div>
                                    @endif

                                    @if ($item->request_tambahan)
                                        <div class="rwy-item-row">
                                            <span class="lbl">Request</span>
                                            <span class="val">{{ $item->request_tambahan }}</span>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>

        @empty

            <div class="rwy-empty">
                <div class="rwy-empty-icon">📭</div>
                <h3>Belum Ada Riwayat</h3>
                <p>Pesanan yang selesai atau dibatalkan akan muncul di sini.</p>
            </div>

        @endforelse

    </div>

</div>

@push('scripts')
<script>
function rwyToggle(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    btn.setAttribute('aria-expanded', String(!isOpen));
    btn.querySelector('span').textContent = isOpen ? 'Lihat detail pesanan' : 'Sembunyikan detail';
}
</script>
@endpush

@endsection