@extends('layouts.user')

@section('title', 'Profil Saya')

@push('styles')
<style>
    body { background: #1a0a02 !important; }
    .main-content { background: #1a0a02; }
</style>
@endpush

@section('content')
<style>
*, *::before, *::after { box-sizing: border-box; }

.pf-page {
    padding: 32px 20px 60px;
    max-width: 860px;
    margin: auto;
}

/* ── CARD ── */
.pf-card {
    background: rgba(255,248,238,0.03);
    border: 0.5px solid rgba(196,122,58,0.22);
    border-radius: 16px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 240px 1fr;
}

/* ── LEFT PANEL ── */
.pf-left {
    background: rgba(44,18,6,0.5);
    border-right: 0.5px solid rgba(196,122,58,0.15);
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 32px 20px 28px;
    gap: 10px;
}

.pf-avatar-wrap {
    position: relative;
    width: 88px;
    height: 88px;
    margin-bottom: 4px;
}

.pf-avatar,
.pf-avatar-placeholder {
    width: 88px;
    height: 88px;
    border-radius: 50%;
    border: 2.5px solid #c47a3a;
}

.pf-avatar { object-fit: cover; display: block; }

.pf-avatar-placeholder {
    background: linear-gradient(135deg, #b5601a, #d4894a);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: 700;
    color: #fff8ee;
}

.pf-avatar-overlay {
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: rgba(26,10,2,0.55);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s;
}

.pf-avatar-wrap:hover .pf-avatar-overlay { opacity: 1; }
.pf-avatar-overlay svg { stroke: #fff8ee; }

.pf-avatar-hint {
    display: none;
    font-size: 11px;
    color: #c47a3a;
    font-weight: 600;
    margin-top: -4px;
    text-align: center;
}

.pf-name {
    font-family: 'Cormorant Garamond', serif;
    font-size: 17px;
    font-weight: 700;
    color: #fff8ee;
    text-align: center;
}

.pf-email {
    font-size: 12px;
    color: rgba(245,222,179,0.45);
    text-align: center;
    word-break: break-all;
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
    color: rgba(196,122,58,0.7);
}

.pf-info-val {
    font-size: 13px;
    font-weight: 500;
    color: #fff8ee;
}

/* ── RIGHT PANEL ── */
.pf-right { display: flex; flex-direction: column; }

.pf-right-header {
    padding: 18px 22px;
    border-bottom: 0.5px solid rgba(196,122,58,0.15);
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.pf-right-title {
    font-size: 13px;
    font-weight: 700;
    color: #fff8ee;
    letter-spacing: 0.2px;
}

.pf-right-body { padding: 22px; }

/* ── VIEW FIELDS ── */
.pf-fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.pf-field label {
    display: block;
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(196,122,58,0.7);
    margin-bottom: 5px;
}

.pf-field p {
    font-size: 13px;
    font-weight: 500;
    color: #fff8ee;
    padding: 9px 12px;
    background: rgba(44,18,6,0.5);
    border: 0.5px solid rgba(196,122,58,0.15);
    border-radius: 9px;
}

/* ── BADGE ── */
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
    margin-top: 6px;
}

.pf-badge-verified {
    background: rgba(46,125,50,0.15);
    color: #6fcf7a;
    border: 0.5px solid rgba(46,125,50,0.35);
}

.pf-badge-verified::before { content: '✓ '; }

.pf-badge-unverified {
    background: rgba(192,57,43,0.12);
    color: #e07070;
    border: 0.5px solid rgba(192,57,43,0.3);
}

.pf-badge-unverified::before { content: '✕ '; }

/* ── EDIT FORM ── */
.pf-form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

.pf-form-group { display: flex; flex-direction: column; gap: 5px; }

.pf-form-group label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: rgba(196,122,58,0.7);
}

.pf-form-group input[type="text"],
.pf-form-group input[type="email"] {
    width: 100%;
    padding: 9px 12px;
    border: 0.5px solid rgba(196,122,58,0.22);
    border-radius: 9px;
    font-size: 13px;
    font-family: 'DM Sans', sans-serif;
    color: #fff8ee;
    background: rgba(44,18,6,0.6);
    outline: none;
    transition: border-color 0.2s;
}

.pf-form-group input:focus { border-color: #c47a3a; }
.pf-form-group input[readonly] { opacity: 0.45; cursor: not-allowed; }

/* ── BUTTONS ── */
.pf-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 9px 18px;
    border-radius: 9px;
    font-size: 13px;
    font-weight: 600;
    font-family: 'DM Sans', sans-serif;
    cursor: pointer;
    border: none;
    transition: opacity 0.15s, transform 0.1s;
}

.pf-btn:active { transform: scale(0.97); }

.pf-btn-edit {
    background: rgba(196,122,58,0.15);
    color: #fff8ee;
    border: 0.5px solid rgba(196,122,58,0.35) !important;
}
.pf-btn-edit:hover { background: rgba(196,122,58,0.25); }

.pf-btn-save { background: #c47a3a; color: #fff8ee; }
.pf-btn-save:hover { background: #e09040; }

.pf-btn-cancel {
    background: transparent;
    color: rgba(245,222,179,0.55);
    border: 0.5px solid rgba(196,122,58,0.25) !important;
}
.pf-btn-cancel:hover { background: rgba(196,122,58,0.08); }

.pf-actions { display: flex; gap: 8px; margin-top: 16px; }

/* ── ALERT ── */
.pf-alert {
    background: rgba(46,125,50,0.1);
    border: 0.5px solid rgba(46,125,50,0.3);
    color: #6fcf7a;
    border-radius: 9px;
    padding: 10px 14px;
    font-size: 13px;
    margin-bottom: 16px;
}

/* ── RESPONSIVE ── */
@media (max-width: 680px) {
    .pf-page { padding: 20px 14px 48px; }
    .pf-card { grid-template-columns: 1fr; }
    .pf-left {
        border-right: none;
        border-bottom: 0.5px solid rgba(196,122,58,0.15);
        padding: 24px 20px;
    }
    .pf-fields,
    .pf-form-grid { grid-template-columns: 1fr; }
    .pf-right-header { flex-direction: column; align-items: flex-start; }
    .pf-actions { flex-direction: column; }
    .pf-btn { width: 100%; justify-content: center; }
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

            <p class="pf-avatar-hint" id="avatarHint">✏️ Klik foto untuk ubah</p>

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
                                    <span class="pf-badge pf-badge-unverified" style="margin-top:4px;">Unverified</span>
                                    <button type="submit" form="verificationForm"
                                            class="pf-btn pf-btn-save" style="font-size:11px;padding:6px 12px;margin-top:6px;">
                                        Kirim Verifikasi
                                    </button>
                                @endif
                            </div>
                            <div class="pf-form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" name="phone" value="{{ auth()->user()->phone }}">
                            </div>
                        </div>

                        <div class="pf-actions">
                            <button type="submit" class="pf-btn pf-btn-save">
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
    if (isEditMode) document.getElementById('avatarInput').click();
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