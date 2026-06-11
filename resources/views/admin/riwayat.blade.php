@extends('layouts.admin')

@section('title', 'Riwayat Pesanan')

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

.pp-user-phone {
    font-size: 12px;
    color: #9a775f;
}

.pp-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 8px;
    flex-shrink: 0;
}

.pp-total {
    font-size: 15px;
    font-weight: 700;
    color: #c47a3a;
    font-family: 'Playfair Display', serif;
}

.pp-badge {
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    white-space: nowrap;
}

.pp-badge-completed { background: #e1f5ee; color: #0f6e56; }
.pp-badge-cancelled { background: #f0ece8; color: #5f5e5a; }

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

.pp-divider {
    height: 0.5px;
    background: rgba(196,122,58,0.15);
    margin: 0 20px;
}

.pp-footer {
    padding: 14px 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pp-date {
    font-size: 12px;
    color: #9a775f;
    display: flex;
    align-items: center;
    gap: 5px;
}

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
        <div>
            <div class="pp-eyebrow">Admin · NanaCakes</div>
            <h1>Riwayat Pesanan</h1>
            <p>Arsip seluruh pesanan yang telah selesai atau dibatalkan.</p>
        </div>
        <div class="pp-badge-count">{{ $orders->count() }} Pesanan</div>
    </div>

    <div class="pp-list">

        @forelse($orders as $order)

        <div class="pp-card">

            {{-- TOP ROW --}}
            <div class="pp-top">

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
                    <div class="pp-user-phone">📞 {{ $order->user->phone }}</div>
                </div>

                <div class="pp-right">
                    <div class="pp-total">Rp {{ number_format($order->total_price, 0, ',', '.') }}</div>
                    @if($order->status === 'completed')
                        <span class="pp-badge pp-badge-completed">✅ Selesai</span>
                    @else
                        <span class="pp-badge pp-badge-cancelled">🚫 Dibatalkan</span>
                    @endif
                </div>

            </div>

            {{-- ITEMS DROPDOWN --}}
            <button class="pp-items-toggle" aria-expanded="false"
                    data-count="{{ $order->items->count() }}"
                    onclick="ppToggle(this)">
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
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pp-divider"></div>

            {{-- FOOTER --}}
            <div class="pp-footer">
                <div class="pp-date">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ $order->created_at->format('d M Y, H:i') }}
                </div>
            </div>

        </div>

        @empty

        <div class="pp-empty">
            <div class="pp-empty-icon">📭</div>
            <h3>Belum Ada Riwayat Pesanan</h3>
            <p>Pesanan yang selesai atau dibatalkan akan muncul di sini.</p>
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