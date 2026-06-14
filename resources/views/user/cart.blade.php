@extends('layouts.user')

@section('title', 'Keranjang Saya')

@push('styles')
<style>
    body { background: #1a0a02 !important; }
    .main-content { background: #1a0a02; }
</style>
@endpush

@section('content')
<style>
    * { box-sizing: border-box; }

    .cart-wrap {
        padding: 32px 20px;
        max-width: 680px;
        margin: auto;
    }

    /* HEADER */
    .cart-header {
        background: rgba(255,248,238,0.04);
        border: 0.5px solid rgba(196,122,58,0.22);
        border-radius: 14px;
        padding: 22px 24px;
        margin-bottom: 18px;
    }
    .cart-header-eyebrow {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #c47a3a;
        margin-bottom: 4px;
    }
    .cart-header h1 {
        margin: 0 0 5px;
        font-size: 24px;
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #fff8ee;
    }
    .cart-header p {
        margin: 0;
        font-size: 13px;
        color: rgba(245,222,179,0.5);
    }

    /* ITEM CARD */
    .cart-item {
        background: rgba(255,248,238,0.03);
        border: 0.5px solid rgba(196,122,58,0.2);
        border-radius: 14px;
        padding: 16px 18px;
        margin-bottom: 12px;
        transition: border-color 0.2s;
    }
    .cart-item:hover {
        border-color: rgba(196,122,58,0.4);
    }
    .cart-item-inner {
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .cart-item-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        flex-shrink: 0;
        border: 0.5px solid rgba(196,122,58,0.2);
    }
    .cart-item-body {
        flex: 1;
        min-width: 0;
    }
    .cart-item-name {
        font-size: 15px;
        font-weight: 700;
        font-family: 'Playfair Display', serif;
        color: #fff8ee;
        margin: 0 0 10px;
    }

    /* QTY */
    .qty-control {
        display: flex;
        align-items: center;
        background: rgba(44,18,6,0.6);
        border: 0.5px solid rgba(196,122,58,0.2);
        border-radius: 8px;
        overflow: hidden;
        width: fit-content;
        margin-bottom: 10px;
    }
    .qty-btn {
        width: 34px;
        height: 34px;
        background: transparent;
        border: none;
        font-size: 18px;
        color: #c47a3a;
        cursor: pointer;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.15s;
    }
    .qty-btn:hover { background: rgba(196,122,58,0.12); }
    .qty-val {
        width: 38px;
        text-align: center;
        font-size: 14px;
        font-weight: 600;
        color: #fff8ee;
        border-left: 0.5px solid rgba(196,122,58,0.18);
        border-right: 0.5px solid rgba(196,122,58,0.18);
        line-height: 34px;
    }

    /* BADGES */
    .badge-row {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
    }
    .badge {
        font-size: 11px;
        background: rgba(196,122,58,0.12);
        color: #c47a3a;
        border: 0.5px solid rgba(196,122,58,0.28);
        border-radius: 6px;
        padding: 3px 9px;
        font-weight: 600;
    }
    .badge-note {
        font-size: 11px;
        background: rgba(255,248,238,0.05);
        color: rgba(245,222,179,0.55);
        border: 0.5px solid rgba(196,122,58,0.12);
        border-radius: 6px;
        padding: 3px 9px;
    }

    /* PRICE + DELETE */
    .cart-item-side {
        text-align: right;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 10px;
    }
    .cart-item-price {
        font-size: 16px;
        font-weight: 700;
        color: #c47a3a;
        font-family: 'Playfair Display', serif;
    }
    .btn-delete {
        background: transparent;
        color: rgba(220,80,60,0.8);
        border: 0.5px solid rgba(220,80,60,0.28);
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.15s, color 0.15s;
    }
    .btn-delete:hover {
        background: rgba(220,80,60,0.1);
        color: rgb(220,80,60);
    }

    /* DIVIDER */
    .cart-divider {
        border: none;
        border-top: 0.5px solid rgba(196,122,58,0.15);
        margin: 12px 0;
    }

    /* EMPTY */
    .cart-empty {
        background: rgba(255,248,238,0.03);
        border: 0.5px solid rgba(196,122,58,0.18);
        border-radius: 14px;
        padding: 56px 24px;
        text-align: center;
    }
    .cart-empty-icon { font-size: 40px; margin-bottom: 14px; }
    .cart-empty-text { font-size: 14px; color: rgba(245,222,179,0.45); }

    /* SUMMARY */
    .cart-summary {
        background: rgba(255,248,238,0.03);
        border: 0.5px solid rgba(196,122,58,0.22);
        border-radius: 14px;
        padding: 20px 22px;
        margin-top: 8px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .summary-label-eyebrow {
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: rgba(245,222,179,0.4);
        margin-bottom: 4px;
    }
    .summary-total {
        font-size: 22px;
        font-weight: 700;
        color: #c47a3a;
        font-family: 'Playfair Display', serif;
    }
    .btn-checkout {
        background: #c47a3a;
        color: #fff8ee;
        padding: 12px 28px;
        border: none;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: background 0.15s;
        letter-spacing: 0.3px;
    }
    .btn-checkout:hover { background: #e09040; }

    /* RESPONSIVE */
    @media (max-width: 520px) {
        .cart-wrap { padding: 20px 14px; }
        .cart-item-img { width: 78px; height: 78px; }
        .cart-item-inner { gap: 12px; }
        .cart-item-name { font-size: 14px; }
        .cart-item-price { font-size: 14px; }
        .cart-header h1 { font-size: 20px; }
        .summary-total { font-size: 19px; }
        .btn-checkout { padding: 11px 20px; font-size: 12px; }
        .summary-row { flex-direction: column; align-items: flex-start; gap: 14px; }
        .btn-checkout { width: 100%; text-align: center; }
    }
</style>

<div class="cart-wrap">

    {{-- HEADER --}}
    <div class="cart-header">
        <div class="cart-header-eyebrow">NanaCakes</div>
        <h1>Keranjang Saya 🛒</h1>
        <p>Periksa kembali pesananmu sebelum checkout.</p>
    </div>

    @php $grandTotal = 0; @endphp

    @forelse($carts as $cart)
        @php $grandTotal += $cart->subtotal; @endphp

        <div class="cart-item">
            <div class="cart-item-inner">

                <img
                    src="{{ asset('storage/' . $cart->product->image) }}"
                    alt="{{ $cart->product->name }}"
                    class="cart-item-img">

                <div class="cart-item-body">

                    <h2 class="cart-item-name">{{ $cart->product->name }}</h2>

                    {{-- Qty Control --}}
                    <div class="qty-control">
                        <form action="{{ route('cart.decrease', $cart->id) }}" method="POST" style="display:contents;">
                            @csrf @method('PATCH')
                            <button type="submit" class="qty-btn">−</button>
                        </form>
                        <span class="qty-val">{{ $cart->qty }}</span>
                        <form action="{{ route('cart.increase', $cart->id) }}" method="POST" style="display:contents;">
                            @csrf @method('PATCH')
                            <button type="submit" class="qty-btn">+</button>
                        </form>
                    </div>

                    {{-- Badges --}}
                    <div class="badge-row">
                        @if($cart->paper_bag)
                            <span class="badge">🛍 Paper Bag</span>
                        @endif
                        @if($cart->use_candle)
                            <span class="badge">🕯 Lilin {{ $cart->candle_1 }}{{ $cart->candle_2 }}</span>
                        @endif
                        @if($cart->request_tambahan)
                            <span class="badge-note">{{ $cart->request_tambahan }}</span>
                        @endif
                    </div>

                </div>

                <div class="cart-item-side">
                    <div class="cart-item-price">Rp {{ number_format($cart->subtotal, 0, ',', '.') }}</div>
                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-delete"
                            onclick="return confirm('Hapus produk ini?')">
                            🗑 Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>

    @empty

        <div class="cart-empty">
            <div class="cart-empty-icon">🍰</div>
            <div class="cart-empty-text">Keranjangmu masih kosong.</div>
        </div>

    @endforelse

    @if($carts->count())
        <div class="cart-summary">
            <div class="summary-row">
                <div>
                    <div class="summary-label-eyebrow">Total Pembayaran</div>
                    <div class="summary-total">Rp {{ number_format($grandTotal, 0, ',', '.') }}</div>
                </div>
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-checkout">Checkout →</button>
                </form>
            </div>
        </div>
    @endif

</div>
@endsection