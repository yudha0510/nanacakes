@extends('layouts.admin')

@section('title', 'Menu Kue')
@section('page-title', 'Menu Kue')

@section('content')

<style>


    /* GRID PRODUK */
    .produk-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 22px;
    }

    /* CARD */
    .produk-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(59,26,10,0.09);
        border: 1px solid rgba(196,122,58,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        flex-direction: column;
    }

    .produk-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(59,26,10,0.14);
    }

    /* SLIDER */
    .slider-wrap {
        position: relative;
        height: 210px;
        background: #f5ede0;
        overflow: hidden;
        flex-shrink: 0;
    }

    .slider-wrap img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .slider-wrap img.active { opacity: 1; }

    /* DOTS */
    .slider-dots {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
        z-index: 2;
    }

    .slider-dots span {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: rgba(255,255,255,0.5);
        display: block;
        cursor: pointer;
        transition: background 0.3s, transform 0.3s;
    }

    .slider-dots span.active {
        background: #fff;
        transform: scale(1.3);
    }

    /* NO IMAGE */
    .no-image {
        height: 210px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: #c4a882;
        gap: 8px;
        background: #fdf6ee;
    }

    .no-image svg {
        width: 40px; height: 40px;
        stroke: #d4b896;
        fill: none;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .no-image span { font-size: 13px; }

    /* CARD BODY */
    .produk-body {
        padding: 16px 18px 18px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .produk-name {
        font-size: 16px;
        font-weight: 700;
        color: #3b1a0a;
        margin-bottom: 4px;
    }

    .produk-price {
        font-size: 15px;
        font-weight: 700;
        color: #c47a3a;
        margin-bottom: 8px;
    }

    .produk-desc {
        font-size: 13px;
        color: #7a5030;
        line-height: 1.55;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ACTION BUTTONS */
    .produk-actions {
        display: flex;
        gap: 10px;
        margin-top: 16px;
    }

    .btn-edit {
        flex: 1;
        text-align: center;
        background: #fff8ee;
        color: #7a3b1e;
        border: 1px solid rgba(196,122,58,0.3);
        padding: 9px 0;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 600;
        font-size: 13px;
        transition: background 0.2s, border-color 0.2s;
    }

    .btn-edit:hover { background: #f5e6d0; border-color: #c47a3a; }

    .btn-hapus {
        flex: 1;
        background: #fff0f0;
        color: #c62828;
        border: 1px solid rgba(220,53,69,0.2);
        padding: 9px 0;
        border-radius: 9px;
        cursor: pointer;
        font-weight: 600;
        font-size: 13px;
        font-family: inherit;
        transition: background 0.2s, border-color 0.2s;
        width: 100%;
    }

    .btn-hapus:hover { background: #ffd6d6; border-color: #dc3545; }

    /* EMPTY STATE */
    .empty-state {
        grid-column: 1 / -1;
        background: #fff;
        padding: 56px 20px;
        border-radius: 16px;
        text-align: center;
        color: #b08060;
        border: 1px dashed rgba(196,122,58,0.25);
    }

    .empty-state svg {
        width: 48px; height: 48px;
        stroke: #d4b896;
        fill: none;
        stroke-width: 1.5;
        stroke-linecap: round;
        stroke-linejoin: round;
        margin-bottom: 12px;
    }

    .empty-state p { font-size: 14px; margin-top: 6px; }

    /* ALERT */
    .alert-success {
        background: #e8f5e9;
        color: #2e7d32;
        border: 1px solid #a5d6a7;
        padding: 12px 18px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    @media (max-width: 600px) {
        .produk-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
        .produk-body { padding: 12px 14px 14px; }
        .produk-name { font-size: 14px; }
    }

    @media (max-width: 400px) {
        .produk-grid { grid-template-columns: 1fr; }
    }
</style>


<div class="produk-grid">

    @forelse($products as $product)

    <div class="produk-card">

        {{-- SLIDER GAMBAR --}}
        @if($product->images->count())

            <div class="slider-wrap" id="slider-{{ $product->id }}">

                @foreach($product->images as $key => $image)
                    <img src="{{ asset('storage/'.$image->image) }}"
                         class="{{ $key === 0 ? 'active' : '' }}"
                         alt="{{ $product->name }}">
                @endforeach

                @if($product->images->count() > 1)
                <div class="slider-dots" id="dots-{{ $product->id }}">
                    @foreach($product->images as $key => $image)
                        <span class="{{ $key === 0 ? 'active' : '' }}"></span>
                    @endforeach
                </div>
                @endif

            </div>

            @if($product->images->count() > 1)
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const slides = document.querySelectorAll('#slider-{{ $product->id }} img');
                const dots   = document.querySelectorAll('#dots-{{ $product->id }} span');
                let current  = 0;

                setInterval(() => {
                    slides[current].classList.remove('active');
                    if (dots[current]) dots[current].classList.remove('active');

                    current = (current + 1) % slides.length;

                    slides[current].classList.add('active');
                    if (dots[current]) dots[current].classList.add('active');
                }, 4000);
            });
            </script>
            @endif

        @else

            <div class="no-image">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span>Tidak Ada Gambar</span>
            </div>

        @endif

        {{-- BODY --}}
        <div class="produk-body">
            <div class="produk-name">{{ $product->name }}</div>
            <div class="produk-price">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
            <div class="produk-desc">{{ $product->description }}</div>

            <div class="produk-actions">
                <a href="{{ route('product.edit', $product->id) }}" class="btn-edit">Edit</a>

                <form action="{{ route('product.delete', $product->id) }}" method="POST" style="flex:1;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn-hapus"
                            onclick="return confirm('Yakin hapus produk ini?')">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

    </div>

    @empty

    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
        <div style="font-size:16px;font-weight:600;color:#7a5030;">Belum Ada Produk</div>
        <p>Klik "Tambah Produk" untuk menambahkan kue pertamamu.</p>
    </div>

    @endforelse

</div>

@endsection