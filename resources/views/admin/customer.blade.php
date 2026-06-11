@extends('layouts.admin')

@section('title', 'Data Pelanggan')
@section('page-title', 'Data Pelanggan')

@section('content')

<style>
    .customer-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 22px;
    }

    .customer-card {
        background: #fff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 18px rgba(59,26,10,0.09);
        border: 1px solid rgba(196,122,58,0.1);
        transition: transform 0.2s, box-shadow 0.2s;
        padding: 22px 20px 20px;
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .customer-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(59,26,10,0.14);
    }

    /* AVATAR */
    .customer-avatar {
        width: 60px; height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #c47a3a, #e09a5a);
        color: #fff8ee;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        font-weight: 700;
        flex-shrink: 0;
        letter-spacing: .5px;
    }

    .customer-avatar img {
        width: 60px; height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid rgba(196,122,58,0.25);
    }

    /* INFO */
    .customer-name {
        font-size: 15px;
        font-weight: 700;
        color: #3b1a0a;
        margin-bottom: 2px;
    }

    .customer-meta {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .customer-meta-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #7a5030;
    }

    .customer-meta-row svg {
        width: 14px; height: 14px;
        stroke: #c47a3a; fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
        flex-shrink: 0;
    }

    /* DIVIDER */
    .customer-divider {
        height: 0.5px;
        background: rgba(196,122,58,0.12);
    }

    /* FOOTER */
    .customer-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .customer-join {
        font-size: 11.5px;
        color: #b08060;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .customer-join svg {
        width: 12px; height: 12px;
        stroke: #c4a882; fill: none;
        stroke-width: 2;
        stroke-linecap: round; stroke-linejoin: round;
    }

    .customer-badge {
        font-size: 11px;
        font-weight: 600;
        background: #fff8ee;
        color: #c47a3a;
        border: 1px solid rgba(196,122,58,0.25);
        padding: 3px 10px;
        border-radius: 999px;
    }

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
        stroke: #d4b896; fill: none;
        stroke-width: 1.5;
        stroke-linecap: round; stroke-linejoin: round;
        margin-bottom: 12px;
    }

    .empty-state p { font-size: 14px; margin-top: 6px; }

    @media (max-width: 600px) {
        .customer-grid { grid-template-columns: 1fr 1fr; gap: 14px; }
        .customer-card { padding: 16px 14px; }
        .customer-avatar { width: 48px; height: 48px; font-size: 18px; }
        .customer-avatar img { width: 48px; height: 48px; }
        .customer-name { font-size: 14px; }
    }

    @media (max-width: 400px) {
        .customer-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="customer-grid">

    @forelse($customers as $customer)

    <div class="customer-card">

        {{-- AVATAR --}}
        @if($customer->profile_photo)
            <img src="{{ asset('storage/' . $customer->profile_photo) }}"
                 alt="{{ $customer->name }}"
                 class="customer-avatar"
                 style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:2px solid rgba(196,122,58,0.25);">
        @else
            <div class="customer-avatar">
                {{ strtoupper(substr($customer->name, 0, 1)) }}
            </div>
        @endif

        {{-- INFO --}}
        <div>
            <div class="customer-name">{{ $customer->name }}</div>
            <div class="customer-meta" style="margin-top:8px;">
                <div class="customer-meta-row">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <span>{{ $customer->email }}</span>
                </div>
                <div class="customer-meta-row">
                    <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.22 1.18 2 2 0 012.18 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.91 7.91a16 16 0 006.06 6.06l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/></svg>
                    <span>{{ $customer->phone ?? '-' }}</span>
                </div>
            </div>
        </div>

        {{-- DIVIDER --}}
        <div class="customer-divider"></div>

        {{-- FOOTER --}}
        <div class="customer-footer">
            <div class="customer-join">
                <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                {{ $customer->created_at->format('d M Y') }}
            </div>
            <div class="customer-badge">Pelanggan</div>
        </div>

    </div>

    @empty

    <div class="empty-state">
        <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
        <div style="font-size:16px;font-weight:600;color:#7a5030;">Belum Ada Pelanggan</div>
        <p>Pelanggan yang mendaftar akan muncul di sini.</p>
    </div>

    @endforelse

</div>

@endsection