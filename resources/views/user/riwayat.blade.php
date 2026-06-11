@extends('layouts.user')

@section('title', 'Riwayat Pesanan')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Lora:ital,wght@0,700;1,400&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.pmy-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fdf8f3;
    min-height: 100vh;
    padding: 1rem 1rem 4rem;
    color: #1a0a02;
}

.pmy-hero h1 {
    font-family: 'Lora', serif;
    font-size: clamp(1.8rem, 5vw, 2.4rem);
    font-weight: 700;
    color: #2c1206;
    line-height: 1.2;
    margin-bottom: .4rem;
}

.pmy-hero p { font-size: 14px; color: #9a775f; }

/* ── TABS ── */

.pmy-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 20px;
    border-radius: 999px;
    border: 1px solid #e8ddd4;
    background: #fff;
    color: #9a775f;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all .18s ease;
}

.pmy-tab:hover { background: #f5ede4; color: #5a2d0c; border-color: #d4b99a; }
.pmy-tab.active { background: #2c1206; color: #fff; border-color: #2c1206; }

/* ── LIST ── */
.pmy-list {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    flex-direction: column;
    gap: 14px;
}

/* ── CARD ── */
.pmy-card {
    background: #fff;
    border: 1px solid #ecddd0;
    border-radius: 16px;
    overflow: hidden;
    transition: border-color .2s, box-shadow .2s;
}

.pmy-card:hover {
    border-color: #d4b99a;
    box-shadow: 0 2px 12px rgba(44,18,6,.06);
}

.pmy-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 1.4rem 1.8rem;
}

.pmy-thumb {
    width: 54px;
    height: 54px;
    border-radius: 10px;
    object-fit: cover;
    border: 1px solid #ecddd0;
    flex-shrink: 0;
    background: #fdf8f3;
}

.pmy-meta { flex: 1; min-width: 0; }

.pmy-order-code {
    font-size: 11px;
    color: #c4a882;
    font-weight: 600;
    font-family: 'Courier New', monospace;
    letter-spacing: .04em;
    margin-bottom: 3px;
}

.pmy-product-name {
    font-size: 14px;
    font-weight: 700;
    color: #2c1206;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 3px;
}

.pmy-product-sub {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.pmy-product-date {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #9a775f;
}

.pmy-product-price {
    font-size: 12px;
    font-weight: 700;
    color: #2c1206;
}

/* ── BADGE ── */
.pmy-badge {
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

.pmy-badge-completed { background: #e1f5ee; color: #0f6e56; }
.pmy-badge-cancelled { background: #f0ece8; color: #5f5e5a; }

/* ── TOGGLE ── */
.pmy-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 1.25rem;
    background: #fdf8f3;
    border: none;
    border-top: 1px solid #ecddd0;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    color: #9a775f;
    font-weight: 500;
    transition: background .15s;
}

.pmy-toggle:hover { background: #f5ede4; }

.pmy-toggle svg {
    transition: transform .22s ease;
    flex-shrink: 0;
}

.pmy-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }

/* ── BODY ── */
.pmy-body { display: none; border-top: 1px solid #ecddd0; }
.pmy-body.open { display: block; }

.pmy-detail { padding: 1.25rem; }

.pmy-section-label {
    font-size: 10.5px;
    font-weight: 700;
    color: #c4a882;
    text-transform: uppercase;
    letter-spacing: .08em;
    margin-bottom: 14px;
}

/* ── DETAIL ITEMS ── */
.pmy-item {
    padding: 12px 0;
    border-bottom: 1px dashed #ecddd0;
}

.pmy-item:last-child { border-bottom: none; padding-bottom: 0; }

.pmy-item-name {
    font-size: 13px;
    font-weight: 700;
    color: #2c1206;
    margin-bottom: 8px;
}

.pmy-item-rows {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.pmy-item-row {
    display: flex;
    align-items: baseline;
    gap: 6px;
    font-size: 12px;
    color: #9a775f;
}

.pmy-item-row .lbl {
    font-weight: 600;
    color: #7a5a44;
    min-width: 90px;
    flex-shrink: 0;
}

.pmy-item-row .val {
    color: #1a0a02;
}

/* ── EMPTY ── */
.pmy-empty {
    text-align: center;
    padding: 4rem 1rem;
    color: #9a775f;
}

.pmy-empty-icon { font-size: 44px; margin-bottom: 1rem; }

.pmy-empty h3 {
    font-size: 16px;
    font-weight: 700;
    color: #2c1206;
    margin-bottom: 6px;
}

.pmy-empty p { font-size: 14px; }

/* ── ANIMATIONS ── */
@keyframes pmyFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

@media (max-width: 480px) {
    .pmy-card-header { gap: 10px; }
    .pmy-thumb { width: 44px; height: 44px; }
    .pmy-badge { font-size: 10.5px; padding: 4px 10px; }
    .pmy-item-row .lbl { min-width: 70px; }
}
</style>

<div class="pmy-page">

    {{-- ── HERO + TABS CARD ── --}}
    <div style="background:#fff;border:1px solid #ecddd0;border-radius:16px;padding:24px 28px;margin-bottom:2rem;">
        <div style="font-size:10px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:#9a775f;margin-bottom:4px;">NanaCakes</div>
        <h1 style="font-family:'Lora',serif;font-size:clamp(1.6rem,4vw,2rem);font-weight:700;color:#2c1206;margin:0 0 4px;">Riwayat Pesanan</h1>
        <p style="font-size:13px;color:#9a775f;margin:0 0 20px;">Rekap seluruh pesanan kamu</p>

        <div class="pmy-tabs" style="margin-bottom:0;justify-content:flex-start;">
            <a href="{{ route('pembayaran') }}"
            class="pmy-tab {{ request()->routeIs('pembayaran') ? 'active' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Pembayaran
            </a>
            <a href="{{ route('tracking') }}"
            class="pmy-tab {{ request()->routeIs('tracking') ? 'active' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                Tracking
            </a>
            <a href="{{ route('riwayat') }}"
            class="pmy-tab {{ request()->routeIs('riwayat') ? 'active' : '' }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="12 8 12 12 14 14"/><path d="M3.05 11a9 9 0 1 1 .5 4"/><polyline points="3 16 3 11 8 11"/></svg>
                Riwayat
            </a>
        </div>
    </div>

    {{-- ── ORDER LIST ── --}}
    <div class="pmy-list">

        @forelse ($historyOrders as $order)

            <div class="pmy-card" style="animation: pmyFadeUp 0.35s ease both; animation-delay: {{ $loop->index * 0.07 }}s">

                {{-- ── CARD HEADER ── --}}
                <div class="pmy-card-header">

                    @if ($order->items->count())
                        <img
                            src="{{ asset('storage/' . $order->items->first()->product_image) }}"
                            class="pmy-thumb"
                            alt="{{ $order->items->first()->product_name }}"
                        >
                        <div class="pmy-meta">
                            <div class="pmy-order-code">{{ $order->order_code }}</div>
                            <div class="pmy-product-name">{{ $order->items->first()->product_name }}</div>
                            <div class="pmy-product-sub">
                                <span class="pmy-product-date">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                                        <line x1="16" y1="2" x2="16" y2="6"/>
                                        <line x1="8" y1="2" x2="8" y2="6"/>
                                        <line x1="3" y1="10" x2="21" y2="10"/>
                                    </svg>
                                    {{ $order->created_at->format('d M Y') }}
                                </span>
                                <span class="pmy-product-price">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @endif

                    {{-- ── STATUS BADGE ── --}}
                    @if ($order->status === 'completed')
                        <span class="pmy-badge pmy-badge-completed">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                            Selesai
                        </span>
                    @else
                        <span class="pmy-badge pmy-badge-cancelled">
                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"/></svg>
                            Dibatalkan
                        </span>
                    @endif

                </div>

                {{-- ── ACCORDION TOGGLE ── --}}
                <button
                    class="pmy-toggle"
                    aria-expanded="false"
                    onclick="pmyToggle(this)"
                >
                    <span>Lihat detail pesanan</span>
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>

                {{-- ── CARD BODY ── --}}
                <div class="pmy-body">
                    <div class="pmy-detail">
                        <div class="pmy-section-label">Detail Item Pesanan</div>

                        @foreach ($order->items as $item)
                            <div class="pmy-item">
                                <div class="pmy-item-name">{{ $item->product_name }}</div>
                                <div class="pmy-item-rows">

                                    <div class="pmy-item-row">
                                        <span class="lbl">Jumlah</span>
                                        <span class="val">{{ $item->qty }} pcs</span>
                                    </div>

                                    <div class="pmy-item-row">
                                        <span class="lbl">Paper Bag</span>
                                        <span class="val">{{ $item->paper_bag ? 'Ya' : 'Tidak' }}</span>
                                    </div>

                                    <div class="pmy-item-row">
                                        <span class="lbl">Lilin</span>
                                        <span class="val">{{ $item->use_candle ? 'Ya' : 'Tidak' }}</span>
                                    </div>

                                    @if ($item->use_candle)
                                        <div class="pmy-item-row">
                                            <span class="lbl">Angka Lilin</span>
                                            <span class="val">{{ $item->candle_1 }} {{ $item->candle_2 }}</span>
                                        </div>
                                    @endif

                                    @if ($item->request_tambahan)
                                        <div class="pmy-item-row">
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

            <div class="pmy-empty">
                <div class="pmy-empty-icon">📭</div>
                <h3>Belum Ada Riwayat</h3>
                <p>Pesanan yang selesai atau dibatalkan akan muncul di sini.</p>
            </div>

        @endforelse

    </div>

</div>

@push('scripts')
<script>
function pmyToggle(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    btn.setAttribute('aria-expanded', String(!isOpen));
    btn.querySelector('span').textContent = isOpen ? 'Lihat detail pesanan' : 'Sembunyikan detail';
}
</script>
@endpush

@endsection