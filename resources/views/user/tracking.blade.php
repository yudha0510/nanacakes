@extends('layouts.user')

@section('title', 'Tracking Pesanan')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
@import url('https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.trk {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #1a0a02;
    min-height: 100vh;
    padding: 24px 28px 60px;
    color: #fff8ee;
}

/* ── HEADER ── */
.trk-header {
    margin-bottom: 20px;
}

.trk-eyebrow {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #c47a3a;
    display: block;
    margin-bottom: 5px;
}

.trk-header h1 {
    font-size: 22px;
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 2px;
    line-height: 1.2;
}

.trk-header p {
    font-size: 13px;
    color: rgba(245,222,179,0.45);
}

/* ── TABS ── */
.trk-tabs {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 20px;
}

.trk-tab {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 7px 14px;
    border-radius: 999px;
    border: 0.5px solid rgba(196,122,58,0.25);
    background: rgba(255,248,238,0.04);
    color: rgba(245,222,179,0.5);
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all 0.15s ease;
    cursor: pointer;
}

.trk-tab:hover {
    background: rgba(196,122,58,0.1);
    color: rgba(245,222,179,0.85);
    border-color: rgba(196,122,58,0.35);
}

.trk-tab.active {
    background: #c47a3a;
    color: #fff8ee;
    border-color: #c47a3a;
}

/* ── LIST ── */
.trk-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

/* ── CARD ── */
.trk-card {
    background: rgba(255,248,238,0.04);
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    overflow: hidden;
    transition: border-color 0.2s;
    animation: trkFadeUp 0.3s ease both;
}

.trk-card:hover {
    border-color: rgba(196,122,58,0.35);
}

/* ── CARD HEADER ── */
.trk-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
}

.trk-thumb {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    object-fit: cover;
    border: 0.5px solid rgba(196,122,58,0.2);
    flex-shrink: 0;
    background: rgba(44,18,6,0.6);
    display: flex;
    align-items: center;
    justify-content: center;
    color: rgba(245,222,179,0.3);
    font-size: 20px;
}

.trk-meta {
    flex: 1;
    min-width: 0;
}

.trk-order-code {
    font-size: 10px;
    color: #c47a3a;
    font-weight: 700;
    font-family: 'Courier New', monospace;
    letter-spacing: .05em;
    margin-bottom: 2px;
}

.trk-product-name {
    font-size: 13px;
    font-weight: 600;
    color: #fff8ee;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 2px;
}

.trk-product-name .more {
    font-size: 11px;
    font-weight: 500;
    color: rgba(245,222,179,0.35);
}

.trk-date {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    color: rgba(245,222,179,0.35);
}

/* ── BADGE ── */
.trk-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    flex-shrink: 0;
    white-space: nowrap;
}

.badge-pending    { background: rgba(196,122,58,0.15); color: #e09040; border: 0.5px solid rgba(196,122,58,0.3); }
.badge-waiting    { background: rgba(59,130,246,0.12); color: #60a5fa; border: 0.5px solid rgba(59,130,246,0.25); }
.badge-processing { background: rgba(34,197,94,0.1);  color: #4ade80; border: 0.5px solid rgba(34,197,94,0.25); }
.badge-completed  { background: rgba(16,185,129,0.1); color: #34d399; border: 0.5px solid rgba(16,185,129,0.25); }
.badge-rejected   { background: rgba(239,68,68,0.1);  color: #f87171; border: 0.5px solid rgba(239,68,68,0.25); }
.badge-cancelled  { background: rgba(255,248,238,0.05); color: rgba(245,222,179,0.4); border: 0.5px solid rgba(245,222,179,0.1); }

/* ── TOGGLE ── */
.trk-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 8px 16px;
    background: rgba(44,18,6,0.4);
    border: none;
    border-top: 0.5px solid rgba(196,122,58,0.12);
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    color: rgba(245,222,179,0.45);
    font-weight: 500;
    transition: background 0.15s;
}

.trk-toggle:hover {
    background: rgba(196,122,58,0.07);
    color: rgba(245,222,179,0.8);
}

.trk-toggle .chev {
    font-size: 16px;
    transition: transform 0.2s ease;
    flex-shrink: 0;
}

.trk-toggle.open .chev {
    transform: rotate(180deg);
}

/* ── BODY ── */
.trk-body {
    display: none;
    border-top: 0.5px solid rgba(196,122,58,0.12);
}

.trk-body.open {
    display: block;
}

/* ── TIMELINE ── */
.tl-wrap {
    padding: 16px;
}

.tl-section-label {
    font-size: 10px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #c47a3a;
    margin-bottom: 14px;
}

.tl-step {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding-bottom: 14px;
}

.tl-step:last-child {
    padding-bottom: 0;
}

.tl-left {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex-shrink: 0;
}

.tl-dot {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    z-index: 1;
    font-size: 12px;
}

.dot-done    { background: #c47a3a; }
.dot-active  { background: rgba(196,122,58,0.12); border: 1.5px solid #c47a3a; animation: trkPulse 1.8s ease-in-out infinite; }
.dot-default { background: rgba(44,18,6,0.6); border: 0.5px solid rgba(196,122,58,0.2); }
.dot-failed  { background: rgba(239,68,68,0.15); border: 0.5px solid rgba(239,68,68,0.45); }

.tl-line {
    width: 1.5px;
    flex: 1;
    min-height: 12px;
    margin-top: 2px;
    background: rgba(196,122,58,0.15);
}

.tl-line-done { background: rgba(196,122,58,0.5); }
.tl-line-red  { background: rgba(239,68,68,0.3); }

.tl-right { flex: 1; padding-top: 4px; }

.tl-title-done    { font-size: 12px; font-weight: 600; color: #fff8ee; }
.tl-title-active  { font-size: 12px; font-weight: 700; color: #c47a3a; }
.tl-title-default { font-size: 12px; font-weight: 500; color: rgba(245,222,179,0.3); }
.tl-title-failed  { font-size: 12px; font-weight: 700; color: #f87171; }

.tl-sub {
    font-size: 11px;
    color: rgba(245,222,179,0.4);
    margin-top: 2px;
    line-height: 1.4;
}

/* ── EMPTY ── */
.trk-empty {
    text-align: center;
    padding: 5rem 1rem;
    color: rgba(245,222,179,0.4);
}

.trk-empty i {
    font-size: 40px;
    margin-bottom: 14px;
    display: block;
    color: rgba(196,122,58,0.4);
}

.trk-empty h3 {
    font-size: 16px;
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 6px;
}

.trk-empty p {
    font-size: 13px;
}

/* ── ANIMATIONS ── */
@keyframes trkFadeUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes trkPulse {
    0%, 100% { box-shadow: 0 0 0 4px rgba(196,122,58,0.1); }
    50%       { box-shadow: 0 0 0 8px rgba(196,122,58,0.04); }
}

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .trk { padding: 18px 16px 48px; }
}

@media (max-width: 480px) {
    .trk-card-header { gap: 10px; }
    .trk-thumb { width: 40px; height: 40px; }
    .trk-badge { font-size: 10.5px; padding: 3px 9px; }
}
</style>

<div class="trk">

    {{-- ── HEADER ── --}}
    <div class="trk-header">
        <span class="trk-eyebrow">NanaCakes · Pre-Order</span>
        <h1>Tracking Pesanan</h1>
        <p>Pantau progres pesanan yang sedang diproses</p>
    </div>

    {{-- ── TABS ── --}}
    <div class="trk-tabs">
        <a href="{{ route('pembayaran') }}" class="trk-tab {{ request()->routeIs('pembayaran') ? 'active' : '' }}">
            <i class="ti ti-credit-card" aria-hidden="true"></i>
            Pembayaran
        </a>
        <a href="{{ route('tracking') }}" class="trk-tab {{ request()->routeIs('tracking') ? 'active' : '' }}">
            <i class="ti ti-map-pin" aria-hidden="true"></i>
            Tracking
        </a>
        <a href="{{ route('riwayat') }}" class="trk-tab {{ request()->routeIs('riwayat') ? 'active' : '' }}">
            <i class="ti ti-history" aria-hidden="true"></i>
            Riwayat
        </a>
    </div>

    {{-- ── ORDER LIST ── --}}
    <div class="trk-list">

        @forelse ($orders as $order)

            @php
                $badgeMap = [
                    'pending'              => ['class' => 'badge-pending',    'icon' => 'ti-clock',        'label' => 'Menunggu'],
                    'waiting_verification' => ['class' => 'badge-waiting',    'icon' => 'ti-search',       'label' => 'Verifikasi'],
                    'processing'           => ['class' => 'badge-processing', 'icon' => 'ti-loader',       'label' => 'Diproses'],
                    'completed'            => ['class' => 'badge-completed',  'icon' => 'ti-circle-check', 'label' => 'Selesai'],
                    'rejected'             => ['class' => 'badge-rejected',   'icon' => 'ti-x',            'label' => 'Ditolak'],
                    'cancelled'            => ['class' => 'badge-cancelled',  'icon' => 'ti-ban',          'label' => 'Dibatalkan'],
                ];
                $badge = $badgeMap[$order->status] ?? ['class' => 'badge-cancelled', 'icon' => 'ti-minus', 'label' => $order->status];
            @endphp

            <div class="trk-card" style="animation-delay: {{ $loop->index * 0.06 }}s">

                {{-- CARD HEADER --}}
                <div class="trk-card-header">

                    @if ($order->items->count() && $order->items->first()->product_image)
                        <img src="{{ asset('storage/' . $order->items->first()->product_image) }}"
                             class="trk-thumb"
                             alt="{{ $order->items->first()->product_name }}">
                    @else
                        <div class="trk-thumb">
                            <i class="ti ti-cake" aria-hidden="true"></i>
                        </div>
                    @endif

                    <div class="trk-meta">
                        <div class="trk-order-code">{{ $order->order_code }}</div>

                        <div class="trk-product-name">
                            @if ($order->items->count())
                                {{ $order->items->first()->product_name }}
                                @if ($order->items->count() > 1)
                                    <span class="more">+{{ $order->items->count() - 1 }} lainnya</span>
                                @endif
                            @else
                                —
                            @endif
                        </div>

                        <div class="trk-date">
                            <i class="ti ti-calendar" style="font-size:11px" aria-hidden="true"></i>
                            {{ $order->created_at->format('d M Y') }}
                        </div>
                    </div>

                    <span class="trk-badge {{ $badge['class'] }}">
                        <i class="ti {{ $badge['icon'] }}" style="font-size:11px" aria-hidden="true"></i>
                        {{ $badge['label'] }}
                    </span>
                </div>

                {{-- TOGGLE --}}
                <button class="trk-toggle" aria-expanded="false" onclick="trkToggle(this)">
                    <span class="toggle-label">Lihat progress pesanan</span>
                    <i class="ti ti-chevron-down chev" aria-hidden="true"></i>
                </button>

                {{-- CARD BODY --}}
                <div class="trk-body">
                    <div class="tl-wrap">
                        <div class="tl-section-label">Progress Pesanan</div>

                        <div class="tl-list">

                            {{-- ── PENDING ── --}}
                            @if ($order->status === 'pending')

                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-active">
                                            <i class="ti ti-clock" style="font-size:12px;color:#c47a3a" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-active">Pesanan dibuat</div>
                                        <div class="tl-sub">{{ $order->created_at->format('d M Y, H.i') }} · Silakan lakukan pembayaran</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-default"><span style="font-size:10px;color:rgba(245,222,179,0.25);font-weight:700">2</span></div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-default">Verifikasi pembayaran</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-default"><span style="font-size:10px;color:rgba(245,222,179,0.25);font-weight:700">3</span></div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-default">Sedang diproses</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-default"><span style="font-size:10px;color:rgba(245,222,179,0.25);font-weight:700">4</span></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-default">Selesai</div>
                                    </div>
                                </div>

                            {{-- ── WAITING VERIFICATION ── --}}
                            @elseif ($order->status === 'waiting_verification')

                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-done"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pesanan dibuat</div>
                                        <div class="tl-sub">{{ $order->created_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-active">
                                            <i class="ti ti-search" style="font-size:12px;color:#c47a3a" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-active">Bukti pembayaran dikirim</div>
                                        <div class="tl-sub">Sedang ditinjau admin — proses hingga 1×24 jam</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-default"><span style="font-size:10px;color:rgba(245,222,179,0.25);font-weight:700">3</span></div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-default">Sedang diproses</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-default"><span style="font-size:10px;color:rgba(245,222,179,0.25);font-weight:700">4</span></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-default">Selesai</div>
                                    </div>
                                </div>

                            {{-- ── PROCESSING ── --}}
                            @elseif ($order->status === 'processing')

                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-done"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pesanan dibuat</div>
                                        <div class="tl-sub">{{ $order->created_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-done"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pembayaran diverifikasi</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-active">
                                            <i class="ti ti-cookie" style="font-size:12px;color:#c47a3a" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-active">Sedang diproses</div>
                                        <div class="tl-sub">Pesanan sedang dibuat dengan penuh cinta oleh tim NanaCakes</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-default"><span style="font-size:10px;color:rgba(245,222,179,0.25);font-weight:700">4</span></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-default">Selesai</div>
                                        <div class="tl-sub">Menunggu penyelesaian pesanan</div>
                                    </div>
                                </div>

                            {{-- ── COMPLETED ── --}}
                            @elseif ($order->status === 'completed')

                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-done"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pesanan dibuat</div>
                                        <div class="tl-sub">{{ $order->created_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-done"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pembayaran diverifikasi</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-done"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Sedang diproses</div>
                                        <div class="tl-sub">Pesanan selesai dibuat oleh tim NanaCakes</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Selesai — Terima kasih!</div>
                                        <div class="tl-sub">{{ $order->updated_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>

                            {{-- ── REJECTED ── --}}
                            @elseif ($order->status === 'rejected')

                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-red"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pesanan dibuat</div>
                                        <div class="tl-sub">{{ $order->created_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-failed">
                                            <i class="ti ti-x" style="font-size:13px;color:#f87171" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-failed">Pembayaran ditolak</div>
                                        <div class="tl-sub">Silakan upload ulang bukti yang valid di halaman Pembayaran</div>
                                    </div>
                                </div>

                            {{-- ── CANCELLED ── --}}
                            @elseif ($order->status === 'cancelled')

                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-done">
                                            <i class="ti ti-check" style="font-size:13px;color:#fff8ee" aria-hidden="true"></i>
                                        </div>
                                        <div class="tl-line tl-line-red"></div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-done">Pesanan dibuat</div>
                                        <div class="tl-sub">{{ $order->created_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>
                                <div class="tl-step">
                                    <div class="tl-left">
                                        <div class="tl-dot dot-failed">
                                            <i class="ti ti-ban" style="font-size:13px;color:#f87171" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="tl-right">
                                        <div class="tl-title-failed">Pesanan dibatalkan</div>
                                        <div class="tl-sub">{{ $order->updated_at->format('d M Y, H.i') }}</div>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </div>

            </div>

        @empty

            <div class="trk-empty">
                <i class="ti ti-inbox" aria-hidden="true"></i>
                <h3>Belum Ada Pesanan</h3>
                <p>Tidak ada pesanan yang perlu dilacak saat ini.</p>
            </div>

        @endforelse

    </div>
</div>

@push('scripts')
<script>
function trkToggle(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    btn.classList.toggle('open', !isOpen);
    btn.setAttribute('aria-expanded', String(!isOpen));
    btn.querySelector('.toggle-label').textContent = isOpen
        ? 'Lihat progress pesanan'
        : 'Sembunyikan progress';
}
</script>
@endpush

@endsection