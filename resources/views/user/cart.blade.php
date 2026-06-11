@extends('layouts.user')

@section('title', 'Keranjang Saya')

@section('content')
<div style="padding:40px 24px;max-width:100%;margin:auto;">

    {{-- HEADER CARD --}}
    <div style="background:#fff;border:0.5px solid rgba(196,122,58,0.18);border-radius:14px;padding:24px 28px;margin-bottom:20px;">
        <div style="font-size:10px;font-weight:500;letter-spacing:2px;text-transform:uppercase;color:#9a7a5a;margin-bottom:4px;">NanaCakes</div>
        <h1 style="font-size:26px;font-weight:500;font-family:'Playfair Display',serif;color:#3b1a0a;margin:0 0 6px;">Keranjang Saya 🛒</h1>
        <p style="font-size:13px;color:#9a7a5a;margin:0;">Periksa kembali pesananmu sebelum checkout.</p>
    </div>

    @php $grandTotal = 0; @endphp

    @forelse($carts as $cart)
        @php $grandTotal += $cart->subtotal; @endphp

        <div style="background:#fff;border:0.5px solid rgba(196,122,58,0.18);border-radius:14px;padding:18px 20px;margin-bottom:14px;">
            <div style="display:flex;gap:18px;align-items:center;">

                <img
                    src="{{ asset('storage/' . $cart->product->image) }}"
                    alt="{{ $cart->product->name }}"
                    style="width:110px;height:110px;object-fit:cover;border-radius:10px;flex-shrink:0;">

                <div style="flex:1;min-width:0;">

                    <h2 style="font-size:15px;font-weight:500;font-family:'Playfair Display',serif;color:#3b1a0a;margin:0 0 10px;">
                        {{ $cart->product->name }}
                    </h2>

                    {{-- Qty Control --}}
                    <div style="display:flex;align-items:center;margin-bottom:12px;">
                        <div style="display:flex;align-items:center;background:#fdf0e4;border:0.5px solid rgba(196,122,58,0.2);border-radius:8px;overflow:hidden;">
                            <form action="{{ route('cart.decrease', $cart->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    style="width:34px;height:34px;background:transparent;border:none;font-size:17px;color:#c47a3a;cursor:pointer;font-weight:500;display:flex;align-items:center;justify-content:center;">−</button>
                            </form>
                            <span style="width:36px;text-align:center;font-size:14px;font-weight:500;color:#3b1a0a;border-left:0.5px solid rgba(196,122,58,0.18);border-right:0.5px solid rgba(196,122,58,0.18);line-height:34px;">{{ $cart->qty }}</span>
                            <form action="{{ route('cart.increase', $cart->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit"
                                    style="width:34px;height:34px;background:transparent;border:none;font-size:17px;color:#c47a3a;cursor:pointer;font-weight:500;display:flex;align-items:center;justify-content:center;">+</button>
                            </form>
                        </div>
                    </div>

                    {{-- Info Tambahan --}}
                    <div style="display:flex;flex-wrap:wrap;gap:6px;">
                        @if($cart->paper_bag)
                            <span style="font-size:11px;background:#fdf0e4;color:#b86a28;border:0.5px solid rgba(196,122,58,0.25);border-radius:6px;padding:3px 9px;font-weight:500;">🛍 Paper Bag</span>
                        @endif
                        @if($cart->use_candle)
                            <span style="font-size:11px;background:#fdf0e4;color:#b86a28;border:0.5px solid rgba(196,122,58,0.25);border-radius:6px;padding:3px 9px;font-weight:500;">🕯 Lilin {{ $cart->candle_1 }}{{ $cart->candle_2 }}</span>
                        @endif
                        @if($cart->request_tambahan)
                            <span style="font-size:11px;background:#f5f5f2;color:#7a5030;border:0.5px solid rgba(0,0,0,0.08);border-radius:6px;padding:3px 9px;">{{ $cart->request_tambahan }}</span>
                        @endif
                    </div>

                </div>

                <div style="text-align:right;flex-shrink:0;">
                    <div style="font-size:16px;font-weight:500;color:#c47a3a;font-family:'Playfair Display',serif;margin-bottom:14px;">
                        Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                    </div>
                    <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Hapus produk ini?')"
                            style="background:transparent;color:#c0392b;border:0.5px solid rgba(192,57,43,0.3);padding:7px 13px;border-radius:8px;font-size:12px;font-weight:500;cursor:pointer;font-family:'Lato',sans-serif;transition:background 0.15s;"
                            onmouseover="this.style.background='rgba(192,57,43,0.06)'" onmouseout="this.style.background='transparent'">
                            🗑 Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>

    @empty

        <div style="background:#fff;border:0.5px solid rgba(196,122,58,0.18);border-radius:14px;padding:48px;text-align:center;">
            <div style="font-size:36px;margin-bottom:12px;">🍰</div>
            <div style="font-size:14px;color:#9a7a5a;">Keranjangmu masih kosong.</div>
        </div>

    @endforelse

    @if($carts->count())
        <div style="background:#fff;border:0.5px solid rgba(196,122,58,0.18);border-radius:14px;padding:20px 24px;margin-top:8px;">
            <div style="display:flex;justify-content:space-between;align-items:center;">
                <div>
                    <div style="font-size:10px;font-weight:500;letter-spacing:1.5px;text-transform:uppercase;color:#9a7a5a;margin-bottom:3px;">Total Pembayaran</div>
                    <div style="font-size:22px;font-weight:500;color:#c47a3a;font-family:'Playfair Display',serif;">
                        Rp {{ number_format($grandTotal, 0, ',', '.') }}
                    </div>
                </div>
                <form action="{{ route('checkout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="background:#c47a3a;color:#fff8ee;padding:11px 28px;border:none;border-radius:9px;font-size:13px;font-weight:500;cursor:pointer;font-family:'Lato',sans-serif;transition:background 0.15s;"
                        onmouseover="this.style.background='#b36a2e'" onmouseout="this.style.background='#c47a3a'">
                        Checkout →
                    </button>
                </form>
            </div>
        </div>
    @endif

</div>
@endsection