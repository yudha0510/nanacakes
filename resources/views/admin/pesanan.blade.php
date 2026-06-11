@extends('layouts.admin')

@section('title', 'Pesanan Diproses')

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

.pp-badge-processing {
    background: #faeeda;
    color: #854f0b;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 999px;
    white-space: nowrap;
}

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

.pp-tag-yes {
    background: #eaf3de;
    border-color: #b7dfbf;
    color: #3b6d11;
}

.pp-item-note {
    font-size: 11.5px;
    color: #9a775f;
    margin-top: 3px;
    line-height: 1.4;
}

.pp-divider {
    height: 0.5px;
    background: rgba(196,122,58,0.15);
    margin: 0 20px;
}

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

.pp-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 14px;
    background: #fdf8f3;
    border: 0.5px solid rgba(196,122,58,0.15);
    border-radius: 10px;
    margin-bottom: 12px;
}

.pp-total-label {
    font-size: 12px;
    font-weight: 600;
    color: #9a775f;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.pp-total-amount {
    font-size: 16px;
    font-weight: 700;
    color: #c47a3a;
    font-family: 'Playfair Display', serif;
}

.pp-actions {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
    align-items: center;
}

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

.pp-btn-proof {
    background: #f5ebe0;
    color: #6b3120;
    border: 0.5px solid rgba(196,122,58,0.25) !important;
}

.pp-btn-proof:hover { background: #e8d5bc; }

.pp-btn-complete {
    background: #2c1206;
    color: #fff;
}

.pp-btn-complete:hover { opacity: 0.85; }

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
            <h1>Pesanan Diproses</h1>
            <p>Kelola pesanan yang sedang dibuat.</p>
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
                    <span class="pp-badge-processing">⚙️ Diproses</span>
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
                            <span class="pp-tag {{ $item->paper_bag ? 'pp-tag-yes' : '' }}">
                                🛍 {{ $item->paper_bag ? 'Paper Bag' : 'No Bag' }}
                            </span>
                            @if($item->use_candle)
                                <span class="pp-tag pp-tag-yes">🕯 Lilin {{ $item->candle_1 }}{{ $item->candle_2 }}</span>
                            @else
                                <span class="pp-tag">🕯 No Lilin</span>
                            @endif
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

                <div class="pp-total-row">
                    <span class="pp-total-label">Total Pembayaran</span>
                    <span class="pp-total-amount">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </div>

                <div class="pp-actions">
                    <a href="{{ asset('storage/' . $order->payment_image) }}"
                       target="_blank" class="pp-btn pp-btn-proof">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                            <polyline points="15 3 21 3 21 9"/>
                            <line x1="10" y1="14" x2="21" y2="3"/>
                        </svg>
                        Lihat Bukti Transfer
                    </a>

                    <form action="{{ route('admin.pesanan.completed', $order->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="pp-btn pp-btn-complete"
                            onclick="return confirm('Tandai pesanan ini selesai?')">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Tandai Selesai
                        </button>
                    </form>
                </div>

            </div>

        </div>

        @empty

        <div class="pp-empty">
            <div class="pp-empty-icon">🎂</div>
            <h3>Tidak Ada Pesanan Diproses</h3>
            <p>Semua pesanan sudah selesai atau belum ada yang masuk.</p>
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