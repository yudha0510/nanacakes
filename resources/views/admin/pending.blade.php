@extends('layouts.admin')

@section('title', 'Pesanan Pending')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.pp-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 16px 28px 60px;
    color: #1a0a02;
}

.pp-header {
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    padding: 22px 26px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.pp-header-left {}

.pp-eyebrow {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #9a775f;
    margin-bottom: 4px;
}

.pp-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: #2c1206;
    margin: 0 0 4px;
}

.pp-header p {
    font-size: 13px;
    color: #9a775f;
    margin: 0;
}

.pp-badge-count {
    background: #faeeda;
    color: #854f0b;
    font-size: 13px;
    font-weight: 700;
    padding: 8px 18px;
    border-radius: 999px;
    white-space: nowrap;
    flex-shrink: 0;
}

.pp-list {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.pp-card {
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    overflow: hidden;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.pp-card:hover {
    border-color: rgba(196,122,58,0.4);
    box-shadow: 0 2px 12px rgba(44,18,6,0.06);
}

/* TOP ROW */
.pp-top {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
}

.pp-thumb {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    object-fit: cover;
    border: 0.5px solid rgba(196,122,58,0.18);
    flex-shrink: 0;
    background: #fdf8f3;
}

.pp-thumb-stack {
    position: relative;
    width: 50px;
    height: 50px;
    flex-shrink: 0;
}

.pp-thumb-stack img {
    position: absolute;
    width: 38px;
    height: 38px;
    border-radius: 8px;
    object-fit: cover;
    border: 1.5px solid #fff;
}

.pp-thumb-stack img:first-child { top: 0; left: 0; z-index: 2; }
.pp-thumb-stack img:last-child  { bottom: 0; right: 0; z-index: 1; }

.pp-meta { flex: 1; min-width: 0; }

.pp-order-code {
    font-size: 11px;
    font-weight: 600;
    color: #c4a882;
    font-family: 'Courier New', monospace;
    letter-spacing: 0.04em;
    margin-bottom: 3px;
}

.pp-user-name {
    font-size: 14px;
    font-weight: 700;
    color: #2c1206;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.pp-date {
    font-size: 12px;
    color: #9a775f;
}

.pp-total {
    font-size: 15px;
    font-weight: 700;
    color: #c47a3a;
    font-family: 'Playfair Display', serif;
    flex-shrink: 0;
}

/* ITEMS TOGGLE */
.pp-items-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 9px 20px;
    background: #fdf8f3;
    border: none;
    border-top: 0.5px solid rgba(196,122,58,0.15);
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    font-weight: 600;
    color: #9a775f;
    transition: background 0.15s;
    text-align: left;
}

.pp-items-toggle:hover { background: #f5ede4; }

.pp-items-toggle svg {
    transition: transform 0.22s ease;
    flex-shrink: 0;
}

.pp-items-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }

/* ITEMS BODY */
.pp-items-body {
    display: none;
    border-top: 0.5px solid rgba(196,122,58,0.15);
    padding: 14px 20px;
    flex-direction: column;
    gap: 10px;
}

.pp-items-body.open { display: flex; }

.pp-item-row {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 12px;
    background: #fdf8f3;
    border-radius: 10px;
}

.pp-item-img {
    width: 52px;
    height: 52px;
    object-fit: cover;
    border-radius: 8px;
    flex-shrink: 0;
    border: 0.5px solid rgba(196,122,58,0.15);
}

.pp-item-name {
    font-size: 13px;
    font-weight: 700;
    color: #2c1206;
    margin-bottom: 5px;
}

.pp-tags {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
    margin-bottom: 4px;
}

.pp-tag {
    font-size: 11px;
    padding: 2px 9px;
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.2);
    border-radius: 999px;
    color: #9a775f;
    font-weight: 500;
}

.pp-item-note {
    font-size: 11.5px;
    color: #9a775f;
    margin-top: 3px;
    line-height: 1.4;
}

/* DIVIDER */
.pp-divider {
    height: 0.5px;
    background: rgba(196,122,58,0.15);
    margin: 0 20px;
}

/* PAYMENT SECTION */
.pp-payment {
    padding: 14px 20px;
}

.pp-section-label {
    font-size: 10px;
    font-weight: 700;
    color: #c4a882;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 10px;
}

/* PROOF IMAGE */


.pp-proof-img:hover { opacity: 0.9; }


.pp-proof-link:hover { background: #f5ede4; color: #5a2d0c; }

.pp-no-proof {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 12px 14px;
    background: #fdf8f3;
    border: 0.5px solid rgba(196,122,58,0.15);
    border-radius: 10px;
    font-size: 13px;
    color: #c4a882;
    margin-bottom: 12px;
}

/* ACTION BUTTONS */
.pp-actions { display: flex; gap: 8px; flex-wrap: wrap; align-items: flex-start; }

.pp-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 16px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    border: none;
    transition: opacity 0.15s, transform 0.1s;
    text-decoration: none;
}

.pp-btn:active { transform: scale(0.97); }

.pp-btn-accept {
    background: #2d6a4f;
    color: #fff;
}

.pp-btn-accept:hover { opacity: 0.88; }

.pp-reject-wrap { display: flex; flex-direction: column; gap: 6px; flex: 1; min-width: 200px; }

.pp-select {
    width: 100%;
    padding: 9px 12px;
    border: 0.5px solid rgba(196,122,58,0.25);
    border-radius: 9px;
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #fdf8f3;
    color: #2c1206;
    outline: none;
    appearance: none;
    cursor: pointer;
}

.pp-btn-reject {
    background: transparent;
    color: #a32d2d;
    border: 0.5px solid rgba(163,45,45,0.35) !important;
}

.pp-btn-reject:hover { background: #fcebeb; }

/* EMPTY */
.pp-empty {
    text-align: center;
    padding: 48px;
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    color: #9a775f;
}

.pp-empty-icon { font-size: 40px; margin-bottom: 12px; }
.pp-empty h3 { font-size: 15px; font-weight: 700; color: #2c1206; margin-bottom: 5px; }
.pp-empty p { font-size: 13px; }
</style>

<div class="pp-page">

    {{-- HEADER --}}
    <div class="pp-header">
        <div class="pp-header-left">
            <div class="pp-eyebrow">Admin · NanaCakes</div>
            <h1>Pesanan Pending</h1>
            <p>Kelola pesanan yang menunggu pembayaran dan verifikasi.</p>
        </div>
        <div class="pp-badge-count">{{ $orders->count() }} Pesanan</div>
    </div>

    <div class="pp-list">

        @forelse($orders as $order)

        <div class="pp-card">

            {{-- TOP ROW --}}
            <div class="pp-top">

                {{-- Thumbnail --}}
                @if($order->items->count() === 1)
                    <img src="{{ asset('storage/' . $order->items->first()->product_image) }}"
                         class="pp-thumb" alt="{{ $order->items->first()->product_name }}">
                @else
                    <div class="pp-thumb-stack">
                        <img src="{{ asset('storage/' . $order->items->first()->product_image) }}" alt="">
                        <img src="{{ asset('storage/' . $order->items->skip(1)->first()->product_image) }}" alt="">
                    </div>
                @endif

                <div class="pp-meta">
                    <div class="pp-order-code">{{ $order->order_code }}</div>
                    <div class="pp-user-name">{{ $order->user->name }}</div>
                    <div class="pp-date">{{ $order->created_at->format('d M Y, H:i') }}</div>
                </div>

                <div class="pp-total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>

            </div>

            {{-- ITEMS DROPDOWN --}}
            <button class="pp-items-toggle" aria-expanded="false" onclick="ppToggle(this)">
                <span>{{ $order->items->count() }} produk dalam pesanan ini</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </button>

            <div class="pp-items-body">
                @foreach($order->items as $item)
                <div class="pp-item-row">
                    <img src="{{ asset('storage/' . $item->product_image) }}"
                         class="pp-item-img" alt="{{ $item->product_name }}">
                    <div style="flex:1;min-width:0;">
                        <div class="pp-item-name">{{ $item->product_name }}</div>
                        <div class="pp-tags">
                            <span class="pp-tag">Qty: {{ $item->qty }}</span>
                            <span class="pp-tag">Paper Bag: {{ $item->paper_bag ? 'Ya' : 'Tidak' }}</span>
                            <span class="pp-tag">Lilin: {{ $item->use_candle ? 'Ya' : 'Tidak' }}</span>
                        </div>
                        @if($item->request_tambahan)
                            <div class="pp-item-note">📝 {{ $item->request_tambahan }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pp-divider"></div>

            {{-- PAYMENT --}}
            <div class="pp-payment">
                <div class="pp-section-label">Bukti Pembayaran</div>

                @if($order->payment_image)
                    <a href="{{ asset('storage/' . $order->payment_image) }}"
                    target="_blank" class="pp-btn"
                    style="background:#6c757d;color:#fff;margin-bottom:12px;display:inline-flex;">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            <polyline points="15 3 21 3 21 9"/>
                            <line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                        Lihat Bukti Pembayaran
                    </a>

                    <div class="pp-actions">
                        <form action="{{ route('admin.orders.accept', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="pp-btn pp-btn-accept"
                                onclick="return confirm('Terima pesanan ini?')">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                Terima
                            </button>
                        </form>

                        <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST"
                              class="pp-reject-wrap">
                            @csrf
                            <select name="reject_reason" required class="pp-select">
                                <option value="">Pilih alasan penolakan...</option>
                                <option value="Bukti pembayaran kurang jelas">Bukti pembayaran kurang jelas</option>
                                <option value="Nominal pembayaran tidak sesuai">Nominal pembayaran tidak sesuai</option>
                                <option value="Bukti pembayaran tidak valid">Bukti pembayaran tidak valid</option>
                                <option value="Pembayaran tidak ditemukan">Pembayaran tidak ditemukan</option>
                            </select>
                            <button type="submit" class="pp-btn pp-btn-reject"
                                onclick="return confirm('Tolak pesanan ini?')">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                Tolak
                            </button>
                        </form>
                    </div>

                @else
                    <div class="pp-no-proof">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Belum ada bukti pembayaran yang diupload.
                    </div>
                @endif

            </div>

        </div>

        @empty

        <div class="pp-empty">
            <div class="pp-empty-icon">🎉</div>
            <h3>Tidak Ada Pesanan Pending</h3>
            <p>Semua pesanan sudah ditangani.</p>
        </div>

        @endforelse

    </div>

</div>

@push('scripts')
<script>
function ppToggle(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.contains('open');

    body.classList.toggle('open', !isOpen);
    btn.setAttribute('aria-expanded', String(!isOpen));

    const count = btn.dataset.count;

    btn.querySelector('span').textContent = isOpen
        ? count + ' produk dalam pesanan ini'
        : 'Sembunyikan produk';
}
</script>
@endpush

@endsection