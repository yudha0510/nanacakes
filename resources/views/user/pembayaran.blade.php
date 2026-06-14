@extends('layouts.user')

@section('title', 'Pembayaran')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,400&display=swap');

/* ── RESET & BASE ── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

/* ── PAGE ── */
.pmy-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background: #1a0a02;
    min-height: 100vh;
    padding: 28px 32px 60px;
    color: #fff8ee;
}

/* ── HEADER ── */
.pmy-header { margin-bottom: 28px; }

.pmy-header-eyebrow {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #c47a3a;
    display: block;
    margin-bottom: 6px;
}

.pmy-header h1 {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 3.5vw, 2.2rem);
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 4px;
    line-height: 1.15;
}

.pmy-header p {
    font-size: 13px;
    color: rgba(245,222,179,0.5);
    margin-bottom: 20px;
}

/* ── TABS ── */
.pmy-tabs { display: flex; gap: 8px; flex-wrap: wrap; }

.pmy-tab {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 18px;
    border-radius: 999px;
    border: 0.5px solid rgba(196,122,58,0.25);
    background: rgba(255,248,238,0.04);
    color: rgba(245,222,179,0.5);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: all 0.18s ease;
}

.pmy-tab:hover {
    background: rgba(196,122,58,0.12);
    color: rgba(245,222,179,0.85);
    border-color: rgba(196,122,58,0.4);
}

.pmy-tab.active {
    background: #c47a3a;
    color: #fff8ee;
    border-color: #c47a3a;
}

/* ── PANDUAN ── */
.pmy-guide {
    background: rgba(196,122,58,0.08);
    border: 0.5px solid rgba(196,122,58,0.25);
    border-radius: 14px;
    padding: 20px 24px;
    margin-bottom: 24px;
}

.pmy-guide-title {
    font-size: 13px;
    font-weight: 700;
    color: #c47a3a;
    margin-bottom: 14px;
    display: flex;
    align-items: center;
    gap: 7px;
}

.pmy-steps {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
}

.pmy-step {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 6px;
    position: relative;
}

.pmy-step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 14px;
    right: -6px;
    width: 12px;
    height: 1px;
    background: rgba(196,122,58,0.3);
}

.pmy-step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: rgba(196,122,58,0.2);
    border: 0.5px solid rgba(196,122,58,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 11px;
    font-weight: 700;
    color: #c47a3a;
    flex-shrink: 0;
}

.pmy-step-text {
    font-size: 11.5px;
    color: rgba(245,222,179,0.65);
    line-height: 1.45;
}

.pmy-step-text strong {
    display: block;
    color: #fff8ee;
    font-size: 12px;
    margin-bottom: 2px;
}

/* ── ORDER LIST ── */
.pmy-list { display: flex; flex-direction: column; gap: 14px; }

/* ── ORDER CARD ── */
.pmy-card {
    background: rgba(255,248,238,0.04);
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 16px;
    overflow: hidden;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.pmy-card:hover {
    border-color: rgba(196,122,58,0.35);
    box-shadow: 0 4px 24px rgba(0,0,0,0.3);
}

/* ── CARD HEADER ── */
.pmy-card-header {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 18px 22px;
}

.pmy-thumb {
    width: 54px;
    height: 54px;
    border-radius: 10px;
    object-fit: cover;
    border: 0.5px solid rgba(196,122,58,0.2);
    flex-shrink: 0;
    background: rgba(44,18,6,0.5);
}

.pmy-meta { flex: 1; min-width: 0; }

.pmy-product-name {
    font-size: 14px;
    font-weight: 700;
    color: #fff8ee;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 3px;
}

.pmy-product-name span {
    font-size: 11px;
    font-weight: 500;
    color: rgba(245,222,179,0.4);
}

.pmy-product-date {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: rgba(245,222,179,0.45);
    margin-bottom: 4px;
}

.pmy-product-price {
    font-size: 13px;
    font-weight: 700;
    color: #c47a3a;
}

/* ── STATUS BADGE ── */
.pmy-badge {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    flex-shrink: 0;
    white-space: nowrap;
}

.pmy-badge-pending    { background: rgba(196,122,58,0.15); color: #e09040; border: 0.5px solid rgba(196,122,58,0.3); }
.pmy-badge-waiting    { background: rgba(59,130,246,0.12); color: #60a5fa; border: 0.5px solid rgba(59,130,246,0.25); }
.pmy-badge-processing { background: rgba(34,197,94,0.1);   color: #4ade80; border: 0.5px solid rgba(34,197,94,0.25); }
.pmy-badge-completed  { background: rgba(16,185,129,0.1);  color: #34d399; border: 0.5px solid rgba(16,185,129,0.25); }
.pmy-badge-rejected   { background: rgba(239,68,68,0.1);   color: #f87171; border: 0.5px solid rgba(239,68,68,0.25); }
.pmy-badge-cancelled  { background: rgba(255,248,238,0.05); color: rgba(245,222,179,0.45); border: 0.5px solid rgba(245,222,179,0.1); }

/* ── TOGGLE ── */
.pmy-toggle {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 22px;
    background: rgba(44,18,6,0.4);
    border: none;
    border-top: 0.5px solid rgba(196,122,58,0.12);
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 12px;
    color: rgba(245,222,179,0.5);
    font-weight: 500;
    transition: background 0.15s;
}

.pmy-toggle:hover {
    background: rgba(196,122,58,0.08);
    color: rgba(245,222,179,0.8);
}

.pmy-toggle svg { transition: transform 0.22s ease; flex-shrink: 0; }
.pmy-toggle[aria-expanded="true"] svg { transform: rotate(180deg); }

/* ── CARD BODY ── */
.pmy-body { display: none; border-top: 0.5px solid rgba(196,122,58,0.12); }
.pmy-body.open { display: block; }

/* ── ITEMS ── */
.pmy-items { padding: 18px 22px; }

.pmy-section-label {
    font-size: 10px;
    font-weight: 700;
    color: #c47a3a;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
}

.pmy-item-row {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 10px 0;
    border-bottom: 0.5px solid rgba(196,122,58,0.1);
}

.pmy-item-row:last-child { border-bottom: none; }

.pmy-item-thumb {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    object-fit: cover;
    border: 0.5px solid rgba(196,122,58,0.2);
    flex-shrink: 0;
    background: rgba(44,18,6,0.5);
}

.pmy-item-info { flex: 1; min-width: 0; }

.pmy-item-name {
    font-size: 13px;
    font-weight: 600;
    color: #fff8ee;
    margin-bottom: 5px;
}

.pmy-tags { display: flex; gap: 5px; flex-wrap: wrap; margin-bottom: 4px; }

.pmy-tag {
    font-size: 11px;
    padding: 2px 9px;
    background: rgba(196,122,58,0.1);
    border: 0.5px solid rgba(196,122,58,0.2);
    border-radius: 999px;
    color: rgba(245,222,179,0.6);
    font-weight: 500;
}

.pmy-item-note {
    display: flex;
    align-items: flex-start;
    gap: 4px;
    font-size: 12px;
    color: rgba(245,222,179,0.45);
    margin-top: 4px;
    line-height: 1.4;
}

/* ── DIVIDER ── */
.pmy-divider { height: 0.5px; background: rgba(196,122,58,0.12); }

/* ── PAYMENT ── */
.pmy-payment { padding: 18px 22px; }

.pmy-bank-card {
    background: rgba(44,18,6,0.5);
    border: 0.5px solid rgba(196,122,58,0.22);
    border-radius: 12px;
    padding: 16px 18px;
    margin-bottom: 16px;
}

.pmy-bank-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
    padding-bottom: 10px;
    border-bottom: 0.5px solid rgba(196,122,58,0.12);
}

.pmy-bank-title {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #c47a3a;
}

.pmy-bank-logo {
    font-size: 11px;
    font-weight: 700;
    color: rgba(245,222,179,0.4);
    letter-spacing: 1px;
}

.pmy-bank-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 5px 0;
    font-size: 13px;
}

.pmy-bank-label { color: rgba(245,222,179,0.45); font-size: 12px; }
.pmy-bank-val   { font-weight: 700; color: #fff8ee; }

.pmy-bank-acct-wrap { display: flex; align-items: center; gap: 8px; }

.pmy-bank-acct {
    font-family: 'Courier New', monospace;
    font-size: 15px;
    letter-spacing: 2px;
    color: #e09040;
}

.pmy-copy-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    background: rgba(196,122,58,0.15);
    border: 0.5px solid rgba(196,122,58,0.3);
    border-radius: 6px;
    font-size: 11px;
    font-weight: 600;
    color: #c47a3a;
    cursor: pointer;
    font-family: 'Plus Jakarta Sans', sans-serif;
    transition: background 0.15s;
}

.pmy-copy-btn:hover { background: rgba(196,122,58,0.25); }

.pmy-total-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0 0;
    margin-top: 6px;
    border-top: 0.5px solid rgba(196,122,58,0.15);
}

.pmy-total-label {
    font-size: 12px;
    font-weight: 600;
    color: rgba(245,222,179,0.5);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.pmy-total-val {
    font-size: 16px;
    font-weight: 700;
    color: #c47a3a;
}

/* ── NOTICE ── */
.pmy-notice {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 14px 16px;
    border-radius: 12px;
    border: 0.5px solid;
    margin-bottom: 14px;
    font-size: 13px;
}

.pmy-notice svg       { flex-shrink: 0; margin-top: 1px; }
.pmy-notice-title     { font-weight: 700; margin-bottom: 3px; font-size: 13px; }
.pmy-notice-desc      { font-size: 12px; opacity: 0.8; line-height: 1.55; }
.pmy-notice-danger    { background: rgba(239,68,68,0.08);  border-color: rgba(239,68,68,0.25); color: #f87171; }
.pmy-notice-success   { background: rgba(34,197,94,0.08);  border-color: rgba(34,197,94,0.2);  color: #4ade80; }
.pmy-notice-info      { background: rgba(59,130,246,0.08); border-color: rgba(59,130,246,0.2); color: #60a5fa; }

.pmy-notice-link {
    color: #60a5fa;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 6px;
}

/* ── COUNTDOWN ── */
.pmy-countdown-wrap {
    background: rgba(44,18,6,0.6);
    border: 0.5px solid rgba(196,122,58,0.25);
    border-radius: 12px;
    padding: 16px 20px;
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}

.pmy-countdown-left { flex: 1; }

.pmy-countdown-label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(245,222,179,0.45);
    margin-bottom: 6px;
}

.pmy-countdown-timer {
    font-family: 'Courier New', monospace;
    font-size: 28px;
    font-weight: 700;
    color: #e09040;
    letter-spacing: 2px;
    line-height: 1;
}

.pmy-countdown-timer.urgent { color: #f87171; animation: pmyPulse 1s ease infinite; }
.pmy-countdown-desc { font-size: 11.5px; color: rgba(245,222,179,0.4); margin-top: 5px; }

.pmy-countdown-icon {
    width: 42px;
    height: 42px;
    background: rgba(196,122,58,0.15);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* ── UPLOAD ── */
.pmy-upload-area {
    border: 1.5px dashed rgba(196,122,58,0.35);
    border-radius: 12px;
    padding: 22px;
    text-align: center;
    margin-bottom: 12px;
    cursor: pointer;
    transition: background 0.15s, border-color 0.15s;
    position: relative;
    background: rgba(44,18,6,0.3);
}

.pmy-upload-area:hover {
    background: rgba(196,122,58,0.07);
    border-color: rgba(196,122,58,0.5);
}

.pmy-upload-icon  { margin-bottom: 8px; color: rgba(196,122,58,0.6); }
.pmy-upload-text  { font-size: 13px; color: rgba(245,222,179,0.7); font-weight: 600; }
.pmy-upload-sub   { font-size: 11px; color: rgba(245,222,179,0.35); margin-top: 3px; }

.pmy-file-input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
}

.pmy-img-preview {
    max-width: 100%;
    max-height: 180px;
    border-radius: 8px;
    margin-top: 12px;
    object-fit: cover;
    display: none;
    border: 0.5px solid rgba(196,122,58,0.2);
}

/* ── BUTTONS ── */
.pmy-btn-primary {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    padding: 12px 16px;
    background: #c47a3a;
    color: #fff8ee;
    border: none;
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    margin-bottom: 8px;
    text-decoration: none;
    transition: background 0.15s, transform 0.1s;
}

.pmy-btn-primary:hover  { background: #e09040; }
.pmy-btn-primary:active { transform: scale(0.98); }

.pmy-btn-danger {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 7px;
    width: 100%;
    padding: 12px 16px;
    background: transparent;
    color: #f87171;
    border: 0.5px solid rgba(239,68,68,0.35);
    border-radius: 10px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    transition: background 0.15s;
}

.pmy-btn-danger:hover { background: rgba(239,68,68,0.08); }

/* ── TIMELINE ── */
.pmy-timeline {
    display: flex;
    align-items: center;
    margin-bottom: 16px;
    padding: 14px 18px;
    background: rgba(44,18,6,0.4);
    border: 0.5px solid rgba(196,122,58,0.12);
    border-radius: 12px;
    overflow-x: auto;
}

.pmy-tl-step {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
    flex: 1;
    min-width: 64px;
    position: relative;
}

.pmy-tl-step:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 13px;
    left: 50%;
    width: 100%;
    height: 1px;
    background: rgba(196,122,58,0.15);
}

.pmy-tl-step.done:not(:last-child)::after { background: rgba(196,122,58,0.5); }

.pmy-tl-dot {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 0.5px solid rgba(196,122,58,0.2);
    background: rgba(44,18,6,0.6);
    font-size: 10px;
    color: rgba(245,222,179,0.3);
    z-index: 1;
    flex-shrink: 0;
}

.pmy-tl-step.done .pmy-tl-dot {
    background: #c47a3a;
    border-color: #c47a3a;
    color: #fff8ee;
}

.pmy-tl-step.current .pmy-tl-dot {
    background: rgba(196,122,58,0.2);
    border-color: #c47a3a;
    color: #c47a3a;
    box-shadow: 0 0 0 3px rgba(196,122,58,0.15);
}

.pmy-tl-label {
    font-size: 10px;
    font-weight: 600;
    color: rgba(245,222,179,0.35);
    text-align: center;
    white-space: nowrap;
}

.pmy-tl-step.done .pmy-tl-label,
.pmy-tl-step.current .pmy-tl-label { color: rgba(245,222,179,0.75); }

/* ── EMPTY ── */
.pmy-empty {
    text-align: center;
    padding: 5rem 1rem;
    color: rgba(245,222,179,0.4);
}

.pmy-empty-icon { font-size: 48px; margin-bottom: 16px; }

.pmy-empty h3 {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: #fff8ee;
    margin-bottom: 8px;
}

.pmy-empty p { font-size: 13px; }

/* ── ANIMATIONS ── */
@keyframes pmyFadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to   { opacity: 1; transform: translateY(0); }
}

@keyframes pmyPulse {
    0%, 100% { opacity: 1; }
    50%       { opacity: 0.6; }
}

/* ── RESPONSIVE ── */

/* Tablet */
@media (max-width: 900px) {
    .pmy-page  { padding: 24px 20px 48px; }
    .pmy-steps { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    .pmy-step:nth-child(2)::after { display: none; }
    .pmy-step:nth-child(odd)::after { display: none; }
}

/* Large mobile */
@media (max-width: 640px) {
    .pmy-page    { padding: 18px 14px 44px; }
    .pmy-guide   { padding: 16px 18px; }
    .pmy-steps   { grid-template-columns: 1fr; gap: 12px; }
    .pmy-step::after { display: none; }

    .pmy-card-header { flex-wrap: wrap; gap: 10px; }
    .pmy-thumb { width: 48px; height: 48px; }

    .pmy-countdown-wrap { flex-direction: column; align-items: flex-start; gap: 12px; }
    .pmy-countdown-icon { align-self: flex-end; }
    .pmy-countdown-timer { font-size: 24px; }

    .pmy-bank-acct { font-size: 13px; letter-spacing: 1px; }
    .pmy-bank-row { flex-wrap: wrap; gap: 6px; }
}

/* Small mobile */
@media (max-width: 480px) {
    .pmy-header h1 { font-size: 1.5rem; }
    .pmy-header p  { font-size: 12px; }
    .pmy-tabs      { gap: 6px; }
    .pmy-tab       { padding: 7px 14px; font-size: 12px; }

    .pmy-card-header { padding: 14px 16px; }
    .pmy-thumb  { width: 44px; height: 44px; }
    .pmy-badge  { font-size: 10.5px; padding: 4px 10px; }
    .pmy-product-name { font-size: 13px; }

    .pmy-items, .pmy-payment { padding: 14px 16px; }
    .pmy-toggle { padding: 10px 16px; font-size: 11.5px; }

    .pmy-bank-card { padding: 14px; }
    .pmy-total-val { font-size: 15px; }

    .pmy-tl-label { font-size: 9px; }
    .pmy-tl-dot   { width: 22px; height: 22px; }

    .pmy-upload-area { padding: 18px 12px; }
    .pmy-upload-text { font-size: 12px; }
}

/* Extra small mobile */
@media (max-width: 360px) {
    .pmy-page { padding: 14px 10px 40px; }
    .pmy-header-eyebrow { letter-spacing: 2px; }
    .pmy-tab span, .pmy-tab { font-size: 11.5px; }
    .pmy-countdown-timer { font-size: 20px; letter-spacing: 1px; }
}

/* Large desktop */
@media (min-width: 1440px) {
    .pmy-page { padding: 36px 64px 72px; }
    .pmy-list { max-width: 900px; margin: 0 auto; }
    .pmy-guide, .pmy-header { max-width: 900px; margin-left: auto; margin-right: auto; }
}
</style>

<div class="pmy-page">

    {{-- ── HEADER + TABS ── --}}
    <div class="pmy-header">
        <span class="pmy-header-eyebrow">NanaCakes · Pre-Order</span>
        <h1>Pesanan Saya</h1>
        <p>Pantau pembayaran &amp; progres pesanan Anda</p>

        <div class="pmy-tabs">
            <a href="{{ route('pembayaran') }}"
               class="pmy-tab {{ request()->routeIs('pembayaran') ? 'active' : '' }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Pembayaran
            </a>
            <a href="{{ route('tracking') }}"
               class="pmy-tab {{ request()->routeIs('tracking') ? 'active' : '' }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="3" width="15" height="13" rx="1"/><path d="M16 8h4l3 3v5h-7V8z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
                Tracking
            </a>
            <a href="{{ route('riwayat') }}"
               class="pmy-tab {{ request()->routeIs('riwayat') ? 'active' : '' }}">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="12 8 12 12 14 14"/><path d="M3.05 11a9 9 0 1 1 .5 4"/><polyline points="3 16 3 11 8 11"/></svg>
                Riwayat
            </a>
        </div>
    </div>

    {{-- ── PANDUAN PEMBAYARAN ── --}}
    <div class="pmy-guide">
        <div class="pmy-guide-title">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Cara Melakukan Pembayaran
        </div>
        <div class="pmy-steps">
            <div class="pmy-step">
                <div class="pmy-step-num">1</div>
                <div class="pmy-step-text">
                    <strong>Salin Nomor Rekening</strong>
                    Gunakan tombol salin di bawah ini
                </div>
            </div>
            <div class="pmy-step">
                <div class="pmy-step-num">2</div>
                <div class="pmy-step-text">
                    <strong>Transfer Sesuai Total</strong>
                    Transfer tepat sesuai nominal pesanan
                </div>
            </div>
            <div class="pmy-step">
                <div class="pmy-step-num">3</div>
                <div class="pmy-step-text">
                    <strong>Upload Bukti Transfer</strong>
                    Foto struk / screenshot konfirmasi
                </div>
            </div>
            <div class="pmy-step">
                <div class="pmy-step-num">4</div>
                <div class="pmy-step-text">
                    <strong>Tunggu Verifikasi</strong>
                    Admin memverifikasi dalam 1×24 jam
                </div>
            </div>
        </div>
    </div>

    {{-- ── ORDER LIST ── --}}
    <div class="pmy-list">

        @forelse ($orders as $order)

            @php
                $statusSteps  = ['pending', 'waiting_verification', 'processing', 'completed'];
                $statusLabels = ['Pending', 'Verifikasi', 'Diproses', 'Selesai'];
                $currentStep  = array_search($order->status, $statusSteps);

                $badgeMap = [
                    'pending'              => ['class' => 'pmy-badge-pending',    'label' => 'Menunggu Bayar'],
                    'waiting_verification' => ['class' => 'pmy-badge-waiting',    'label' => 'Verifikasi'],
                    'processing'           => ['class' => 'pmy-badge-processing', 'label' => 'Diproses'],
                    'completed'            => ['class' => 'pmy-badge-completed',  'label' => 'Selesai'],
                    'rejected'             => ['class' => 'pmy-badge-rejected',   'label' => 'Ditolak'],
                    'cancelled'            => ['class' => 'pmy-badge-cancelled',  'label' => 'Dibatalkan'],
                ];
                $badge = $badgeMap[$order->status] ?? ['class' => 'pmy-badge-cancelled', 'label' => $order->status];
            @endphp

            <div class="pmy-card"
                 style="animation: pmyFadeUp 0.35s ease both; animation-delay: {{ $loop->index * 0.07 }}s">

                {{-- CARD HEADER --}}
                <div class="pmy-card-header">
                    @if ($order->items->count())
                        <img src="{{ asset('storage/' . $order->items->first()->product_image) }}"
                             class="pmy-thumb"
                             alt="{{ $order->items->first()->product_name }}">
                        <div class="pmy-meta">
                            <div class="pmy-product-name">
                                {{ $order->items->first()->product_name }}
                                @if ($order->items->count() > 1)
                                    <span>+{{ $order->items->count() - 1 }} item lainnya</span>
                                @endif
                            </div>
                            <div class="pmy-product-date">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                {{ $order->created_at->format('d M Y, H:i') }}
                            </div>
                            <div class="pmy-product-price">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                    @endif
                    <span class="pmy-badge {{ $badge['class'] }}">{{ $badge['label'] }}</span>
                </div>

                {{-- TOGGLE --}}
                <button class="pmy-toggle" aria-expanded="false" onclick="pmyToggle(this)">
                    <span>Klik di sini untuk melakukan pembayaran</span>
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>

                {{-- CARD BODY --}}
                <div class="pmy-body">

                    {{-- STATUS TIMELINE (hanya untuk processing) --}}
                    @if ($order->status === 'processing')
                        <div style="padding: 16px 22px 0;">
                            <div class="pmy-timeline">
                                @foreach ($statusSteps as $i => $step)
                                    <div class="pmy-tl-step {{ $currentStep !== false && $i < $currentStep ? 'done' : ($i === $currentStep ? 'current' : '') }}">
                                        <div class="pmy-tl-dot">
                                            @if ($currentStep !== false && $i < $currentStep)
                                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                            @else
                                                {{ $i + 1 }}
                                            @endif
                                        </div>
                                        <span class="pmy-tl-label">{{ $statusLabels[$i] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- ITEMS --}}
                    <div class="pmy-items">
                        <div class="pmy-section-label">Item Pesanan</div>
                        @foreach ($order->items as $item)
                            <div class="pmy-item-row">
                                <img src="{{ asset('storage/' . $item->product_image) }}"
                                     class="pmy-item-thumb"
                                     alt="{{ $item->product_name }}">
                                <div class="pmy-item-info">
                                    <div class="pmy-item-name">{{ $item->product_name }}</div>
                                    <div class="pmy-tags">
                                        <span class="pmy-tag">Qty: {{ $item->qty }}</span>
                                        <span class="pmy-tag">Paper Bag: {{ $item->paper_bag ? 'Ya' : 'Tidak' }}</span>
                                        <span class="pmy-tag">Lilin: {{ $item->use_candle ? 'Ya' : 'Tidak' }}</span>
                                    </div>
                                    @if ($item->request_tambahan)
                                        <div class="pmy-item-note">
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="flex-shrink:0;margin-top:1px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                            {{ $item->request_tambahan }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pmy-divider"></div>

                    {{-- PAYMENT INFO --}}
                    <div class="pmy-payment">
                        <div class="pmy-section-label">Informasi Pembayaran</div>

                        <div class="pmy-bank-card">
                            <div class="pmy-bank-header">
                                <span class="pmy-bank-title">Transfer ke Rekening</span>
                                <span class="pmy-bank-logo">BCA</span>
                            </div>
                            <div class="pmy-bank-row">
                                <span class="pmy-bank-label">Atas Nama</span>
                                <span class="pmy-bank-val">NanaCakes</span>
                            </div>
                            <div class="pmy-bank-row">
                                <span class="pmy-bank-label">No. Rekening</span>
                                <div class="pmy-bank-acct-wrap">
                                    <span class="pmy-bank-acct" id="rekening-{{ $order->id }}">1234567890</span>
                                    <button class="pmy-copy-btn" onclick="pmyCopy('rekening-{{ $order->id }}', this)">
                                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg>
                                        Salin
                                    </button>
                                </div>
                            </div>
                            <div class="pmy-total-row">
                                <span class="pmy-total-label">Total Transfer</span>
                                <span class="pmy-total-val">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- STATUS ACTIONS --}}
                        @if ($order->status === 'pending')

                            <div class="pmy-countdown-wrap">
                                <div class="pmy-countdown-left">
                                    <div class="pmy-countdown-label">Batas Waktu Pembayaran</div>
                                    <div class="pmy-countdown-timer"
                                         id="countdown-{{ $order->id }}"
                                         data-expired="{{ \Carbon\Carbon::parse($order->expired_at)->timestamp }}">
                                        01:00:00
                                    </div>
                                    <div class="pmy-countdown-desc">Pesanan otomatis dibatalkan jika melewati batas waktu</div>
                                </div>
                                <div class="pmy-countdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#c47a3a" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                            </div>

                            <div class="pmy-notice pmy-notice-info">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                <div>
                                    <div class="pmy-notice-title">Cara Upload Bukti</div>
                                    <div class="pmy-notice-desc">
                                        Ambil screenshot atau foto struk transfer, lalu upload di bawah. Pastikan nominal dan nama tujuan terlihat jelas.
                                        <br>
                                        Hubungi admin jika status tidak berubah lebih dari 1×24 jam.
                                        <a href="{{ route('help') }}" class="pmy-notice-link">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                            Buka FAQ untuk nomor admin
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <form action="{{ route('pesanan.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="pmy-upload-area">
                                    <input type="file" name="payment_image" accept="image/*"
                                           class="pmy-file-input" required
                                           onchange="pmyPreview(this, {{ $order->id }})">
                                    <div class="pmy-upload-icon">
                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                    </div>
                                    <div class="pmy-upload-text">Klik untuk pilih bukti pembayaran</div>
                                    <div class="pmy-upload-sub">JPG, PNG, atau WEBP · Maks 2MB</div>
                                    <img id="pmy-preview-{{ $order->id }}" class="pmy-img-preview" alt="Preview">
                                </div>
                                <button type="submit" class="pmy-btn-primary">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                    Upload Bukti Pembayaran
                                </button>
                            </form>

                        @elseif ($order->status === 'waiting_verification')

                            <div class="pmy-notice pmy-notice-info">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                <div>
                                    <div class="pmy-notice-title">Sedang Diverifikasi Admin</div>
                                    <div class="pmy-notice-desc">
                                        Bukti pembayaran sudah diterima dan sedang ditinjau. Proses verifikasi membutuhkan waktu hingga 1×24 jam.
                                        <br>
                                        Hubungi admin jika status tidak berubah lebih dari 1×24 jam.
                                        <a href="{{ route('help') }}" class="pmy-notice-link">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
                                            Buka FAQ untuk nomor admin
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @elseif ($order->status === 'rejected')

                            <div class="pmy-notice pmy-notice-danger">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                                <div>
                                    <div class="pmy-notice-title">Bukti Pembayaran Ditolak</div>
                                    <div class="pmy-notice-desc" style="margin-top:4px;"><strong>Alasan:</strong> {{ $order->reject_reason }}</div>
                                    <div class="pmy-notice-desc" style="margin-top:6px;">Silakan upload ulang bukti yang valid dalam waktu 30 menit.</div>
                                </div>
                            </div>

                            <div class="pmy-countdown-wrap">
                                <div class="pmy-countdown-left">
                                    <div class="pmy-countdown-label">Sisa Waktu Upload Ulang</div>
                                    <div class="pmy-countdown-timer"
                                         id="reject-countdown-{{ $order->id }}"
                                         data-rejected="{{ optional($order->rejected_at)->timestamp }}">
                                        00:30:00
                                    </div>
                                    <div class="pmy-countdown-desc">Pesanan dibatalkan otomatis jika melewati batas</div>
                                </div>
                                <div class="pmy-countdown-icon">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#f87171" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                </div>
                            </div>

                            <form action="{{ route('pesanan.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="pmy-upload-area">
                                    <input type="file" name="payment_image" accept="image/*"
                                           class="pmy-file-input" required
                                           onchange="pmyPreview(this, {{ $order->id }})">
                                    <div class="pmy-upload-icon">
                                        <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0 0 18 9h-1.26A8 8 0 1 0 3 16.3"/></svg>
                                    </div>
                                    <div class="pmy-upload-text">Pilih bukti baru</div>
                                    <div class="pmy-upload-sub">JPG, PNG, atau WEBP · Maks 2MB</div>
                                    <img id="pmy-preview-{{ $order->id }}" class="pmy-img-preview" alt="Preview">
                                </div>
                                <button type="submit" class="pmy-btn-primary">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.5"/></svg>
                                    Upload Ulang Bukti
                                </button>
                            </form>

                            <form method="POST" action="{{ route('pesanan.cancel', $order->id) }}"
                                  onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?')">
                                @csrf
                                <button type="submit" class="pmy-btn-danger">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                                    Batalkan Pesanan
                                </button>
                            </form>

                        @elseif ($order->status === 'processing')

                            <div class="pmy-notice pmy-notice-success">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                                <div style="width:100%;">
                                    <div class="pmy-notice-title">Pembayaran Berhasil 🎉</div>
                                    <div class="pmy-notice-desc">Pembayaran telah disetujui admin. Pesanan sedang diproses oleh tim NanaCakes.</div>
                                    <a href="{{ route('tracking') }}" class="pmy-btn-primary"
                                       style="margin-top:12px;width:fit-content;padding:10px 18px;">
                                        Lihat Tracking Pesanan
                                    </a>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>

            </div>

        @empty

            <div class="pmy-empty">
                <div class="pmy-empty-icon">🛒</div>
                <h3>Belum Ada Pesanan</h3>
                <p>Silakan lakukan checkout terlebih dahulu.</p>
            </div>

        @endforelse

    </div>

</div>

@push('scripts')
<script>
function pmyToggle(btn) {
    const body = btn.nextElementSibling;
    const isOpen = body.classList.contains('open');
    body.classList.toggle('open', !isOpen);
    btn.setAttribute('aria-expanded', String(!isOpen));
    btn.querySelector('span').textContent = isOpen
        ? 'Klik di sini untuk melakukan pembayaran'
        : 'Sembunyikan detail';
}

function pmyPreview(input, id) {
    const file = input.files[0];
    if (!file) return;
    const img = document.getElementById('pmy-preview-' + id);
    img.src = URL.createObjectURL(file);
    img.style.display = 'block';
    img.onload = () => URL.revokeObjectURL(img.src);
}

function pmyCopy(elId, btn) {
    const text = document.getElementById(elId).textContent.trim();
    navigator.clipboard.writeText(text).then(() => {
        btn.innerHTML = '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg> Tersalin!';
        btn.style.color = '#4ade80';
        btn.style.borderColor = 'rgba(34,197,94,0.4)';
        setTimeout(() => {
            btn.innerHTML = '<svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Salin';
            btn.style.color = '';
            btn.style.borderColor = '';
        }, 2000);
    });
}

document.querySelectorAll('[id^="countdown-"]').forEach(function(el) {
    const expired = parseInt(el.dataset.expired) * 1000;
    function update() {
        const dist = expired - Date.now();
        if (dist <= 0) { el.textContent = 'Kadaluarsa'; el.classList.add('urgent'); return; }
        const h = Math.floor(dist / 3600000);
        const m = Math.floor((dist % 3600000) / 60000);
        const s = Math.floor((dist % 60000) / 1000);
        el.textContent = String(h).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
        if (dist < 600000) el.classList.add('urgent');
    }
    update();
    setInterval(update, 1000);
});

document.querySelectorAll('[id^="reject-countdown-"]').forEach(function(el) {
    const rejected = parseInt(el.dataset.rejected) * 1000;
    const expired  = rejected + (30 * 60 * 1000);
    function update() {
        const dist = expired - Date.now();
        if (dist <= 0) { el.textContent = 'Waktu Habis'; el.classList.add('urgent'); return; }
        const m = Math.floor(dist / 60000);
        const s = Math.floor((dist % 60000) / 1000);
        el.textContent = String(m).padStart(2,'0') + ':' + String(s).padStart(2,'0');
        if (dist < 300000) el.classList.add('urgent');
    }
    update();
    setInterval(update, 1000);
});
</script>
@endpush

@endsection