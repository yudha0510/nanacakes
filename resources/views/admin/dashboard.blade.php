@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@push('styles')
<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.db-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 16px 28px 60px;
    color: #1a0a02;
}

.db-header {
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    padding: 22px 26px;
    margin-bottom: 20px;
}

.db-eyebrow {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #9a775f;
    margin-bottom: 4px;
}

.db-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 700;
    color: #2c1206;
    margin: 0 0 4px;
}

.db-header p {
    font-size: 13px;
    color: #9a775f;
    margin: 0;
}

/* STAT CARDS */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 14px;
    margin-bottom: 20px;
}

.stat-card {
    background: #fff;
    border-radius: 14px;
    padding: 18px 20px;
    border: 0.5px solid rgba(196,122,58,0.18);
    position: relative;
    overflow: hidden;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
    border-color: rgba(196,122,58,0.4);
    box-shadow: 0 2px 12px rgba(44,18,6,0.06);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2.5px;
    border-radius: 14px 14px 0 0;
}

.stat-card.orange::before { background: #c47a3a; }
.stat-card.green::before  { background: #3b6d11; }
.stat-card.blue::before   { background: #185fa5; }
.stat-card.pink::before   { background: #a32d2d; }

.stat-icon {
    width: 36px; height: 36px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
}

.stat-icon.orange { background: #faeeda; }
.stat-icon.green  { background: #eaf3de; }
.stat-icon.blue   { background: #e6f1fb; }
.stat-icon.pink   { background: #fcebeb; }

.stat-icon svg {
    width: 18px; height: 18px;
    fill: none;
    stroke-width: 1.8;
    stroke-linecap: round;
    stroke-linejoin: round;
}

.stat-icon.orange svg { stroke: #c47a3a; }
.stat-icon.green  svg { stroke: #3b6d11; }
.stat-icon.blue   svg { stroke: #185fa5; }
.stat-icon.pink   svg { stroke: #a32d2d; }

.stat-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #9a775f;
    margin-bottom: 5px;
}

.stat-value {
    font-size: 26px;
    font-weight: 700;
    color: #2c1206;
    font-family: 'Playfair Display', serif;
    line-height: 1;
    margin-bottom: 5px;
}

.stat-sub { font-size: 12px; color: #9a775f; }
.stat-sub.down { color: #a32d2d; }

/* BOTTOM GRID */
.bottom-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.db-card {
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    padding: 20px 22px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.db-card:hover {
    border-color: rgba(196,122,58,0.4);
    box-shadow: 0 2px 12px rgba(44,18,6,0.06);
}

.db-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 16px;
}

.db-card-title {
    font-size: 13px;
    font-weight: 700;
    color: #2c1206;
}

.db-card-link {
    font-size: 12px;
    color: #c47a3a;
    text-decoration: none;
    font-weight: 600;
}

.db-card-link:hover { opacity: 0.8; }

/* TABLE */
.table-wrap { overflow-x: auto; }

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 13px;
}

thead th {
    text-align: left;
    font-size: 10px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #9a775f;
    padding: 0 12px 10px 0;
    border-bottom: 0.5px solid rgba(196,122,58,0.15);
    font-weight: 600;
}

tbody td {
    padding: 11px 12px 11px 0;
    color: #2c1206;
    border-bottom: 0.5px solid rgba(196,122,58,0.08);
    vertical-align: middle;
}

tbody tr:last-child td { border-bottom: none; }

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 11px;
    padding: 3px 10px;
    border-radius: 999px;
    font-weight: 700;
}

.status-badge.done     { background: #e1f5ee; color: #0f6e56; }
.status-badge.pending  { background: #faeeda; color: #854f0b; }
.status-badge.cancel   { background: #fcebeb; color: #a32d2d; }
.status-badge.process  { background: #e6f1fb; color: #185fa5; }

/* STATUS LIST */
.menu-list { display: flex; flex-direction: column; gap: 12px; }

.menu-item {
    display: flex;
    align-items: center;
    gap: 12px;
}

.menu-rank {
    width: 30px; height: 30px;
    border-radius: 8px;
    background: #faeeda;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.menu-info { flex: 1; }

.menu-name {
    font-size: 13px;
    font-weight: 600;
    color: #2c1206;
    margin-bottom: 5px;
}

.menu-bar-wrap {
    height: 4px;
    background: rgba(196,122,58,0.1);
    border-radius: 2px;
    overflow: hidden;
}

.menu-bar {
    height: 100%;
    background: #c47a3a;
    border-radius: 2px;
    transition: width 0.6s ease;
}

.menu-count {
    font-size: 14px;
    font-weight: 700;
    color: #c47a3a;
    font-family: 'Playfair Display', serif;
    flex-shrink: 0;
    min-width: 24px;
    text-align: right;
}

@media (max-width: 900px) {
    .bottom-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

<div class="db-page">

    {{-- HEADER --}}
    <div class="db-header">
        <div class="db-eyebrow">Admin · NanaCakes</div>
        <h1>Dashboard</h1>
        <p>Selamat datang, {{ auth()->user()->name ?? 'Admin' }}! Berikut ringkasan aktivitas NanaCakes hari ini.</p>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">

        <div class="stat-card orange">
            <div class="stat-icon orange">
                <svg viewBox="0 0 24 24"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
            </div>
            <div class="stat-label">Total Pesanan</div>
            <div class="stat-value">{{ $totalOrders }}</div>
            <div class="stat-sub">Total seluruh pesanan</div>
        </div>

        <div class="stat-card green">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 100 7h5a3.5 3.5 0 110 7H6"/></svg>
            </div>
            <div class="stat-label">Total Produk</div>
            <div class="stat-value">{{ $totalProducts }}</div>
            <div class="stat-sub">Produk tersedia</div>
        </div>

        <div class="stat-card blue">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
            </div>
            <div class="stat-label">Total Pelanggan</div>
            <div class="stat-value">{{ $totalCustomers }}</div>
            <div class="stat-sub">Pelanggan terdaftar</div>
        </div>

        <div class="stat-card pink">
            <div class="stat-icon pink">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-label">Pesanan Pending</div>
            <div class="stat-value">{{ $pendingOrders }}</div>
            <div class="stat-sub down">Perlu ditindaklanjuti</div>
        </div>

    </div>

    {{-- BOTTOM GRID --}}
    <div class="bottom-grid">

        {{-- Pesanan Terbaru --}}
        <div class="db-card">
            <div class="db-card-header">
                <span class="db-card-title">Pesanan Terbaru</span>
                <a href="{{ route('admin.pesanan') }}" class="db-card-link">Lihat semua →</a>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                        <tr>
                            <td style="color:#c4a882;font-family:'Courier New',monospace;font-size:11px;">{{ $order->order_code }}</td>
                            <td>{{ $order->user->name ?? '-' }}</td>
                            <td style="font-weight:600;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                @if($order->status == 'completed')
                                    <span class="status-badge done">● Selesai</span>
                                @elseif($order->status == 'processing')
                                    <span class="status-badge process">● Diproses</span>
                                @elseif($order->status == 'pending')
                                    <span class="status-badge pending">● Pending</span>
                                @elseif($order->status == 'rejected')
                                    <span class="status-badge cancel">● Ditolak</span>
                                @else
                                    <span class="status-badge">{{ ucfirst($order->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center;padding:20px;color:#9a775f;">Belum ada pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Status Pesanan --}}
        <div class="db-card">
            <div class="db-card-header">
                <span class="db-card-title">Status Pesanan</span>
            </div>
            @php
                $maxOrders = max($pendingOrders, $processingOrders, $completedOrders, $rejectedOrders, 1);
            @endphp
            <div class="menu-list">
                <div class="menu-item">
                    <div class="menu-rank">⏳</div>
                    <div class="menu-info">
                        <div class="menu-name">Pending</div>
                        <div class="menu-bar-wrap">
                            <div class="menu-bar" style="width:{{ ($pendingOrders / $maxOrders) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="menu-count">{{ $pendingOrders }}</div>
                </div>
                <div class="menu-item">
                    <div class="menu-rank">⚙️</div>
                    <div class="menu-info">
                        <div class="menu-name">Diproses</div>
                        <div class="menu-bar-wrap">
                            <div class="menu-bar" style="width:{{ ($processingOrders / $maxOrders) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="menu-count">{{ $processingOrders }}</div>
                </div>
                <div class="menu-item">
                    <div class="menu-rank">✅</div>
                    <div class="menu-info">
                        <div class="menu-name">Selesai</div>
                        <div class="menu-bar-wrap">
                            <div class="menu-bar" style="width:{{ ($completedOrders / $maxOrders) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="menu-count">{{ $completedOrders }}</div>
                </div>
                <div class="menu-item">
                    <div class="menu-rank">❌</div>
                    <div class="menu-info">
                        <div class="menu-name">Ditolak</div>
                        <div class="menu-bar-wrap">
                            <div class="menu-bar" style="width:{{ ($rejectedOrders / $maxOrders) * 100 }}%"></div>
                        </div>
                    </div>
                    <div class="menu-count">{{ $rejectedOrders }}</div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection