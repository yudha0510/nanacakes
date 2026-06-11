@extends('layouts.user')

@section('title', 'Profil Saya')

@section('content')

<style>
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap');

*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.pf-page {
    font-family: 'Plus Jakarta Sans', sans-serif;
    padding: 24px 28px 60px;
    color: #1a0a02;
}

.pf-card {
    background: #fff;
    border: 0.5px solid rgba(196,122,58,0.18);
    border-radius: 14px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 260px 1fr;
}

.pf-left {
    background: #fdf0e4;
    border-right: 0.5px solid rgba(196,122,58,0.15);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 32px 20px 28px;
    gap: 10px;
}

.pf-avatar-wrap {
    position: relative;
    width: 96px;
    height: 96px;
    margin-bottom: 4px;
}

.pf-avatar,
.pf-avatar-placeholder {
    width: 96px;
    height: 96px;
    border-radius: 50%;
    border: 3px solid #c47a3a;
}

.pf-avatar { object-fit: cover; display: block; }

.pf-avatar-placeholder {
    background: #c47a3a;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    font-weight: 700;
    color: #fff;
    border-color: #b36a2e;
}

.pf-avatar-overlay {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(44,18,6,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s;
}

.pf-avatar-wrap:hover .pf-avatar-overlay { opacity: 1; }
.pf-avatar-overlay svg { stroke: #fff; }

.pf-name {
    font-family: 'Playfair Display', serif;
    font-size: 16px;
    font-weight: 700;
    color: #2c1206;
    text-align: center;
}

.pf-email {
    font-size: 12px;
    color: #9a775f;
    text-align: center;
}

.pf-divider {
    width: 100%;
    height: 0.5px;
    background: rgba(196,122,58,0.2);
    margin: 4px 0;
}

.pf-info-row {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.pf-info-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #9a775f;
}

.pf-info-val {
    font-size: 13px;
    font-weight: 500;
    color: #2c1206;
}

.pf-right { display: flex; flex-direction: column; }

.pf-right-header {
    padding: 20px 24px;
    border-bottom: 0.5px solid rgba(196,122,58,0.15);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.pf-right-title {
    font-size: 13px;
    font-weight: 700;
    color: #2c1206;
}

.pf-right-body { padding: 22px 24px; }

.pf-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

.pf-field label {
    display: block;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #9a775f;
    margin-bottom: 5px;
}

.pf-field p {
    font-size: 14px;
    font-weight: 500;
    color: #2c1206;
    padding: 10px 12px;
    background: #fdf8f3;
    border: 0.5px solid rgba(196,122,58,0.15);
    border-radius: 9px;
}

.pf-form-group { margin-bottom: 14px; }

.pf-form-group label {
    display: block;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: #9a775f;
    margin-bottom: 6px;
}

.pf-form-group input[type="text"],
.pf-form-group input[type="email"] {
    width: 100%;
    padding: 10px 12px;
    border: 0.5px solid rgba(196,122,58,0.22);
    border-radius: 9px;
    font-size: 13px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #2c1206;
    background: #fdf8f3;
    outline: none;
    transition: border-color 0.2s;
}

.pf-form-group input:focus { border-color: #c47a3a; }
.pf-form-group input[readonly] { opacity: 0.5; cursor: not-allowed; }

.pf-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.pf-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 18px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    border: none;
    transition: opacity 0.15s, transform 0.1s;
}

.pf-btn:active { transform: scale(0.97); }
.pf-btn-edit { background: #2c1206; color: #fff; }
.pf-btn-edit:hover { opacity: 0.85; }
.pf-btn-save { background: #c47a3a; color: #fff8ee; }
.pf-btn-save:hover { opacity: 0.88; }
.pf-btn-cancel {
    background: transparent;
    color: #9a775f;
    border: 0.5px solid rgba(196,122,58,0.3) !important;
}
.pf-btn-cancel:hover { background: #fdf8f3; }
.pf-actions { display: flex; gap: 8px; margin-top: 4px; }

.pf-alert {
    background: #eaf3de;
    border: 0.5px solid #b7dfbf;
    color: #3b6d11;
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    margin-bottom: 16px;
}

.pf-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.8px;
    text-transform: uppercase;
    padding: 3px 8px;
    border-radius: 20px;
}

.pf-badge-verified {
    background: #eaf3de;
    color: #3b6d11;
    border: 0.5px solid #b7dfbf;
}

.pf-badge-verified::before { content: '✓ '; }

.pf-badge-unverified {
    background: #fdecea;
    color: #c0392b;
    border: 0.5px solid #f5b7b1;
}

.pf-badge-unverified::before { content: '✕ '; }

@media (max-width: 768px) {
    .pf-card { grid-template-columns: 1fr; }
    .pf-left { border-right: none; border-bottom: 0.5px solid rgba(196,122,58,0.15); }
    .pf-fields, .pf-form-grid { grid-template-columns: 1fr; }
}
</style>

<div class="pf-page">

    <div class="pf-card">

        {{-- ── KIRI ── --}}
        <div class="pf-left">

            <div class="pf-avatar-wrap" id="avatarWrap" style="cursor:default;" onclick="avatarClick()">
                @if(auth()->user()->profile_photo)
                    <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                         class="pf-avatar" id="avatarImg" alt="Foto Profil">
                @else
                    <div class="pf-avatar-placeholder" id="avatarPlaceholder">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <img src="" class="pf-avatar" id="avatarImg" alt="" style="display:none;">
                @endif
                <div class="pf-avatar-overlay" id="avatarOverlay" style="display:none;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/>
                        <circle cx="12" cy="13" r="4"/>
                    </svg>
                </div>
            </div>

            <p id="avatarHint" style="display:none;font-size:11px;color:#c47a3a;font-weight:600;margin-top:-4px;text-align:center;">
                ✏️ Klik foto untuk ubah
            </p>

            <div class="pf-name">{{ auth()->user()->name }}</div>
            <div class="pf-email">{{ auth()->user()->email }}</div>

            <div class="pf-divider"></div>

            <div class="pf-info-row">
                <span class="pf-info-label">Nama</span>
                <span class="pf-info-val">{{ auth()->user()->name }}</span>
            </div>
            <div class="pf-info-row">
                <span class="pf-info-label">Telepon</span>
                <span class="pf-info-val">{{ auth()->user()->phone ?? '-' }}</span>
            </div>

        </div>

        {{-- ── KANAN ── --}}
        <div class="pf-right">

            {{-- VIEW MODE --}}
            <div id="viewProfile">
                <div class="pf-right-header">
                    <span class="pf-right-title">Informasi Akun</span>
                    <button type="button" onclick="showEditForm()" class="pf-btn pf-btn-edit">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        Edit Profil
                    </button>
                </div>
                <div class="pf-right-body">
                    <div class="pf-fields">
                        <div class="pf-field">
                            <label>Nama Lengkap</label>
                            <p>{{ auth()->user()->name }}</p>
                        </div>
                        <div class="pf-field">
                            <label>Email</label>
                            <p>{{ auth()->user()->email }}</p>
                            @if(Auth::user()->email_verified_at)
                                <span class="pf-badge pf-badge-verified">Verified</span>
                            @else
                                <span class="pf-badge pf-badge-unverified">Unverified</span>
                            @endif
                        </div>
                        <div class="pf-field">
                            <label>Nomor Telepon</label>
                            <p>{{ auth()->user()->phone ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- EDIT MODE --}}
            <div id="editProfile" style="display:none;">
                <div class="pf-right-header">
                    <span class="pf-right-title">Edit Profil</span>
                </div>
                <div class="pf-right-body">
                    {{-- Form verifikasi diletakkan di luar form utama --}}
                    @if(!Auth::user()->email_verified_at)
                        <form id="verificationForm" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                        </form>
                    @endif

                    <form id="profileForm" action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile_photo" id="avatarInput"
                               accept="image/*" style="display:none;"
                               onchange="previewAvatar(this)">

                        <div class="pf-form-grid">
                            <div class="pf-form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}" required>
                            </div>
                            <div class="pf-form-group">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}">
                                @if(Auth::user()->email_verified_at)
                                    <span class="pf-badge pf-badge-verified" style="margin-top:6px;">Verified</span>
                                @else
                                    <span class="pf-badge pf-badge-unverified" style="margin-top:6px;">Unverified</span>
                                    <button type="submit" form="verificationForm"
                                            class="pf-btn pf-btn-save" style="font-size:11px;padding:6px 12px;margin-top:6px;">
                                        Kirim Verifikasi Email
                                    </button>
                                @endif
                            </div>
                            <div class="pf-form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="phone" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>

                        <div class="pf-actions">
                            <button type="submit" form="profileForm" class="pf-btn pf-btn-save">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                Simpan Perubahan
                            </button>
                            <button type="button" onclick="hideEditForm()" class="pf-btn pf-btn-cancel">
                                Batal
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
let isEditMode = false;

function avatarClick() {
    if (isEditMode) {
        document.getElementById('avatarInput').click();
    }
}

function showEditForm() {
    isEditMode = true;
    document.getElementById('viewProfile').style.display = 'none';
    document.getElementById('editProfile').style.display = 'block';
    document.getElementById('avatarOverlay').style.display = 'flex';
    document.getElementById('avatarHint').style.display = 'block';
    document.getElementById('avatarWrap').style.cursor = 'pointer';
}

function hideEditForm() {
    isEditMode = false;
    document.getElementById('editProfile').style.display = 'none';
    document.getElementById('viewProfile').style.display = 'block';
    document.getElementById('avatarOverlay').style.display = 'none';
    document.getElementById('avatarHint').style.display = 'none';
    document.getElementById('avatarWrap').style.cursor = 'default';
}

function previewAvatar(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('avatarImg');
        const placeholder = document.getElementById('avatarPlaceholder');
        img.src = e.target.result;
        img.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(file);
}
</script>

@endsection