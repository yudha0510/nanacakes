@extends('layouts.admin')

@section('title', 'Laporan Penjualan')

@section('content')

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
    background: #c47a3a;
}

.stat-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #9a775f;
    margin-bottom: 8px;
}

.stat-value {
    font-size: 22px;
    font-weight: 700;
    color: #2c1206;
    font-family: 'Playfair Display', serif;
    line-height: 1;
    margin-bottom: 5px;
}

.stat-sub { font-size: 12px; color: #9a775f; }

.db-card {
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    padding: 20px 22px;
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

.status-badge.done { background: #e1f5ee; color: #0f6e56; }
</style>

<div class="db-page">

    {{-- HEADER --}}
    <div class="db-header">
        <div class="db-eyebrow">Admin · NanaCakes</div>
        <h1>Laporan Penjualan</h1>
        <p>Rekap seluruh transaksi dan pendapatan NanaCakes.</p>
    </div>

    {{-- STAT CARDS --}}
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Pendapatan</div>
            <div class="stat-value">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</div>
            <div class="stat-sub">Dari semua pesanan selesai</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pesanan Selesai</div>
            <div class="stat-value">{{ $completedOrders }}</div>
            <div class="stat-sub">Total penjualan berhasil</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Pendapatan Bulan Ini</div>
            <div class="stat-value">Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
            <div class="stat-sub">Bulan berjalan</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Total Pelanggan</div>
            <div class="stat-value">{{ $totalCustomers }}</div>
            <div class="stat-sub">Pelanggan terdaftar</div>
        </div>

    </div>

    {{-- TABEL PENJUALAN --}}
    <div class="db-card">
        <div class="db-card-header">
            <span class="db-card-title">Data Penjualan</span>
        </div>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Kode Order</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr>
                        <td style="color:#c4a882;font-family:'Courier New',monospace;font-size:11px;">{{ $sale->order_code }}</td>
                        <td>{{ $sale->user->name ?? '-' }}</td>
                        <td style="color:#9a775f;">{{ $sale->created_at->format('d M Y') }}</td>
                        <td style="font-weight:600;">Rp {{ number_format($sale->total_price, 0, ',', '.') }}</td>
                        <td><span class="status-badge done">● Selesai</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:24px;color:#9a775f;">
                            Belum ada data penjualan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection