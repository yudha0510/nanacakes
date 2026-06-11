@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@push('styles')
<style>
    .page-header {
        margin-bottom: 24px;
    }
    .page-header h2 {
        font-size: 20px;
        font-weight: 600;
        color: #3b1a0a;
        margin: 0 0 4px;
    }
    .page-header p {
        font-size: 13px;
        color: #b08060;
        margin: 0;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-section {
        background: #fff;
        border-radius: 14px;
        border: 1px solid rgba(196,122,58,0.12);
        padding: 24px;
    }

    .form-section-title {
        font-size: 13px;
        font-weight: 600;
        color: #c47a3a;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid rgba(196,122,58,0.1);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .form-section-title svg {
        width: 16px; height: 16px;
        stroke: #c47a3a;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .field {
        margin-bottom: 18px;
    }

    .field:last-child { margin-bottom: 0; }

    .field label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.8px;
        text-transform: uppercase;
        color: #7a5030;
        margin-bottom: 8px;
    }

    .field label .req {
        color: #c44a4a;
        margin-left: 2px;
    }

    .field input[type="text"],
    .field input[type="number"],
    .field select,
    .field textarea {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid rgba(196,122,58,0.22);
        border-radius: 10px;
        font-size: 14px;
        font-family: 'Lato', sans-serif;
        color: #3b1a0a;
        background: #fdf9f5;
        outline: none;
        transition: border-color 0.2s, background 0.2s;
        appearance: none;
        -webkit-appearance: none;
    }

    .field input:focus,
    .field select:focus,
    .field textarea:focus {
        border-color: #c47a3a;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(196,122,58,0.08);
    }

    .field textarea { resize: vertical; min-height: 110px; line-height: 1.6; }

    /* Select arrow */
    .select-wrap { position: relative; }
    .select-wrap::after {
        content: '';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 0; height: 0;
        border-left: 5px solid transparent;
        border-right: 5px solid transparent;
        border-top: 5px solid #c47a3a;
        pointer-events: none;
    }

    /* Price input */
    .price-wrap { position: relative; }

    /* Image upload */
    .upload-area {
        border: 2px dashed rgba(196,122,58,0.3);
        border-radius: 12px;
        padding: 28px 20px;
        text-align: center;
        background: rgba(196,122,58,0.03);
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        position: relative;
    }

    .upload-area:hover {
        border-color: #c47a3a;
        background: rgba(196,122,58,0.06);
    }

    .upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .upload-icon {
        width: 44px; height: 44px;
        border-radius: 50%;
        background: rgba(196,122,58,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
    }

    .upload-icon svg {
        width: 22px; height: 22px;
        stroke: #c47a3a;
        fill: none;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .upload-text {
        font-size: 14px;
        font-weight: 600;
        color: #3b1a0a;
        margin-bottom: 4px;
    }

    .upload-sub {
        font-size: 12px;
        color: #b08060;
    }

    /* Preview grid */
    #previewContainer {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
        margin-top: 16px;
    }

    .preview-item {
        position: relative;
        border-radius: 10px;
        overflow: visible;
    }

    .preview-item img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid rgba(196,122,58,0.2);
        display: block;
    }

    .preview-remove {
        position: absolute;
        top: -7px; right: -7px;
        width: 22px; height: 22px;
        border: none;
        border-radius: 50%;
        background: #dc3545;
        color: white;
        font-weight: bold;
        cursor: pointer;
        font-size: 13px;
        display: flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
        transition: background 0.2s, transform 0.1s;
        z-index: 10;
    }

    .preview-remove:hover { background: #a02030; transform: scale(1.1); }

    /* Action buttons */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 20px 24px;
        background: #fff;
        border-radius: 14px;
        border: 1px solid rgba(196,122,58,0.12);
        margin-top: 20px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #c47a3a, #e09040);
        color: #fff8ee;
        border: none;
        padding: 12px 28px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Lato', sans-serif;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        box-shadow: 0 3px 16px rgba(196,122,58,0.3);
        letter-spacing: 0.3px;
    }

    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(196,122,58,0.4); }
    .btn-save:active { transform: scale(0.98); }

    .btn-save svg, .btn-back svg {
        width: 16px; height: 16px;
        stroke: currentColor;
        fill: none;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        color: #7a5030;
        border: 1px solid rgba(196,122,58,0.25);
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        font-family: 'Lato', sans-serif;
        text-decoration: none;
        transition: background 0.2s, border-color 0.2s;
    }

    .btn-back:hover {
        background: rgba(196,122,58,0.06);
        border-color: rgba(196,122,58,0.4);
    }

    .char-count {
        font-size: 11px;
        color: #b08060;
        text-align: right;
        margin-top: 5px;
    }

    /* Validation error */
    .field-error {
        font-size: 12px;
        color: #c44a4a;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    @media (max-width: 768px) {
        .form-grid { grid-template-columns: 1fr; }
        #previewContainer { grid-template-columns: repeat(3, 1fr); }
    }
</style>
@endpush

@section('content')

<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-grid">

        {{-- KOLOM KIRI --}}
        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- Info Produk --}}
            <div class="form-section">
                <div class="form-section-title">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                    Info Produk
                </div>

                <div class="field">
                    <label for="name">Nama Produk <span class="req">*</span></label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Contoh: Black Forest Premium"
                        required
                    >
                    @error('name')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="category">Kategori <span class="req">*</span></label>
                    <div class="select-wrap">
                        <select name="category" required>
                        <option value="">Pilih Kategori</option>
                        <option value="Birthday Cake">Birthday Cake</option>
                        <option value="Cupcakes">Cupcakes</option>
                        <option value="Sweet Cakes">Sweet Cakes</option>
                        <option value="Others">Others</option>
                    </select>
                    </div>
                    @error('category')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label for="price">Harga <span class="req">*</span></label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        value="{{ old('price') }}"
                        placeholder="Contoh: 150000"
                        min="0"
                        required
                    >
                    @error('price')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="form-section">
                <div class="form-section-title">
                    <svg viewBox="0 0 24 24"><line x1="17" y1="10" x2="3" y2="10"/><line x1="21" y1="6" x2="3" y2="6"/><line x1="21" y1="14" x2="3" y2="14"/><line x1="17" y1="18" x2="3" y2="18"/></svg>
                    Deskripsi
                </div>

                <div class="field">
                    <label for="description">Deskripsi Produk</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Tuliskan deskripsi produk, bahan, ukuran, dll..."
                        maxlength="500"
                        oninput="document.getElementById('charCount').textContent = this.value.length"
                    >{{ old('description') }}</textarea>
                    <p class="char-count"><span id="charCount">0</span> / 500</p>
                    @error('description')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

        </div>

        {{-- KOLOM KANAN --}}
        <div class="form-section" style="align-self:start;">
            <div class="form-section-title">
                <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                Gambar Produk
            </div>

            <div class="upload-area" id="uploadArea">
                <input
                    type="file"
                    id="imageInput"
                    name="images[]"
                    multiple
                    accept="image/*"
                >
                <div class="upload-icon">
                    <svg viewBox="0 0 24 24"><polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/><path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/></svg>
                </div>
                <p class="upload-text">Klik atau seret gambar ke sini</p>
                <p class="upload-sub">PNG, JPG, WEBP • Maksimal 5 gambar</p>
            </div>

            <div id="previewContainer"></div>

            @error('images')
                <p class="field-error" style="margin-top:10px;">{{ $message }}</p>
            @enderror
        </div>

    </div>

    {{-- ACTION BAR --}}
    <div class="form-actions">
        <button type="submit" class="btn-save">
            <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Simpan Produk
        </button>
        <a href="{{ route('product.index') }}" class="btn-back">
            <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
    </div>

</form>

@endsection

@push('scripts')
<script>
    let selectedFiles = [];

    document.getElementById('imageInput').addEventListener('change', function(e) {
        let newFiles = Array.from(e.target.files);
        selectedFiles = selectedFiles.concat(newFiles);
        if (selectedFiles.length > 5) {
            alert('Maksimal 5 gambar produk');
            selectedFiles = selectedFiles.slice(0, 5);
        }
        renderPreview();
    });

    function renderPreview() {
        let container = document.getElementById('previewContainer');
        container.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            let reader = new FileReader();
            reader.onload = function(e) {
                let box = document.createElement('div');
                box.className = 'preview-item';
                box.innerHTML = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}">
                    <button type="button" class="preview-remove" onclick="removeImage(${index})" title="Hapus gambar">×</button>
                `;
                container.appendChild(box);
            };
            reader.readAsDataURL(file);
        });
        updateInputFiles();
    }

    function removeImage(index) {
        selectedFiles.splice(index, 1);
        renderPreview();
    }

    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        selectedFiles.forEach(file => dataTransfer.items.add(file));
        document.getElementById('imageInput').files = dataTransfer.files;
    }

    // Init char count if old value exists
    const desc = document.getElementById('description');
    if (desc) document.getElementById('charCount').textContent = desc.value.length;
</script>
@endpush