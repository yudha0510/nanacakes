<!-- ORDER MODAL -->
<div id="orderModal"
     style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.6);z-index:9999;overflow:auto;">

    <div style="
        background:#1a0a02;
        width:90%;
        max-width:500px;
        margin:24px auto;
        border-radius:16px;
        overflow:hidden;
        border:0.5px solid rgba(196,122,58,0.25);">

        {{-- HEADER --}}
        <div style="
            background:rgba(255,248,238,0.04);
            border-bottom:0.5px solid rgba(196,122,58,0.18);
            padding:18px 20px;
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:12px;">
            <div>
                <div style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:#c47a3a;margin-bottom:3px;font-weight:600;">Detail Pesanan</div>
                <h2 id="cakeName" style="margin:0;color:#fff8ee;font-size:17px;font-family:'Playfair Display',serif;font-weight:700;"></h2>
            </div>
            <button onclick="closeOrderModal()"
                style="width:30px;height:30px;border-radius:50%;background:rgba(196,122,58,0.15);border:0.5px solid rgba(196,122,58,0.3);color:#fff8ee;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;line-height:1;flex-shrink:0;">×</button>
        </div>

        {{-- FOTO SLIDER --}}
        <div style="position:relative;background:#2c1206;overflow:hidden;height:190px;" id="sliderWrap">
            <div id="sliderTrack" style="display:flex;height:100%;transition:transform 0.35s ease;"></div>
            <button onclick="slidePrev()" id="slidePrev" style="display:none;position:absolute;left:10px;top:50%;transform:translateY(-50%);background:rgba(26,10,2,0.7);border:0.5px solid rgba(196,122,58,0.3);width:30px;height:30px;border-radius:50%;cursor:pointer;font-size:17px;z-index:10;color:#fff8ee;display:flex;align-items:center;justify-content:center;">‹</button>
            <button onclick="slideNext()" id="slideNext" style="display:none;position:absolute;right:10px;top:50%;transform:translateY(-50%);background:rgba(26,10,2,0.7);border:0.5px solid rgba(196,122,58,0.3);width:30px;height:30px;border-radius:50%;cursor:pointer;font-size:17px;z-index:10;color:#fff8ee;display:flex;align-items:center;justify-content:center;">›</button>
            <div id="sliderDots" style="position:absolute;bottom:9px;left:50%;transform:translateX(-50%);display:flex;gap:5px;"></div>
            <div id="noImage" style="display:flex;align-items:center;justify-content:center;height:100%;color:rgba(245,222,179,0.4);font-size:13px;">Tidak ada gambar</div>
        </div>

        {{-- BODY --}}
        <div style="padding:20px;display:flex;flex-direction:column;gap:14px;">

            {{-- Harga --}}
            <div style="display:flex;align-items:baseline;gap:6px;">
                <span id="cakePriceDisplay" style="font-size:21px;font-weight:700;color:#c47a3a;font-family:'Playfair Display',serif;">Rp 0</span>
                <span style="font-size:12px;color:rgba(245,222,179,0.45);">/ kue</span>
            </div>

            <div id="cakeDesc" style="font-size:13px;color:rgba(245,222,179,0.6);line-height:1.65;"></div>

            <hr style="border:none;border-top:0.5px solid rgba(196,122,58,0.18);margin:0;">

            {{-- JUMLAH --}}
            <div>
                <div style="font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#c47a3a;margin-bottom:8px;">Jumlah Kue</div>
                <div style="display:flex;align-items:center;background:rgba(255,248,238,0.04);border:0.5px solid rgba(196,122,58,0.2);border-radius:8px;overflow:hidden;width:fit-content;">
                    <button type="button" onclick="decreaseQty()"
                        style="width:38px;height:38px;background:transparent;border:none;font-size:19px;color:#c47a3a;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;">−</button>
                    <input type="number" id="cakeQty" value="1" min="1" readonly
                        style="width:48px;height:38px;text-align:center;border:none;border-left:0.5px solid rgba(196,122,58,0.18);border-right:0.5px solid rgba(196,122,58,0.18);background:rgba(44,18,6,0.5);font-size:14px;font-weight:600;color:#fff8ee;outline:none;">
                    <button type="button" onclick="increaseQty()"
                        style="width:38px;height:38px;background:transparent;border:none;font-size:19px;color:#c47a3a;cursor:pointer;font-weight:700;display:flex;align-items:center;justify-content:center;">+</button>
                </div>
            </div>

            <hr style="border:none;border-top:0.5px solid rgba(196,122,58,0.18);margin:0;">

            {{-- LILIN --}}
            <div>
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" id="toggleLilin" onchange="toggleLilin()"
                        style="width:15px;height:15px;accent-color:#c47a3a;cursor:pointer;flex-shrink:0;">
                    <span style="font-size:14px;font-weight:600;color:#fff8ee;">Tambah Lilin</span>
                </label>
                <div id="lilinSection" style="display:none;gap:12px;margin-top:10px;">
                    <div style="flex:1;">
                        <label style="display:block;font-size:10px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:rgba(245,222,179,0.45);margin-bottom:5px;">Angka Pertama</label>
                        <select id="lilinAngka1" style="width:100%;padding:8px 10px;border:0.5px solid rgba(196,122,58,0.2);border-radius:8px;font-size:13px;background:rgba(44,18,6,0.5);color:#fff8ee;outline:none;appearance:none;">
                            @for($i = 0; $i <= 9; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div style="flex:1;">
                        <label style="display:block;font-size:10px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:rgba(245,222,179,0.45);margin-bottom:5px;">Angka Kedua</label>
                        <select id="lilinAngka2" style="width:100%;padding:8px 10px;border:0.5px solid rgba(196,122,58,0.2);border-radius:8px;font-size:13px;background:rgba(44,18,6,0.5);color:#fff8ee;outline:none;appearance:none;">
                            @for($i = 0; $i <= 9; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <hr style="border:none;border-top:0.5px solid rgba(196,122,58,0.18);margin:0;">

            {{-- PAPER BAG --}}
            <div>
                <label style="display:flex;align-items:center;justify-content:space-between;cursor:pointer;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <input type="checkbox" id="togglePaperbag" onchange="togglePaperbag()"
                            style="width:15px;height:15px;accent-color:#c47a3a;cursor:pointer;flex-shrink:0;">
                        <span style="font-size:14px;font-weight:600;color:#fff8ee;">Paper Bag Premium</span>
                    </div>
                    <span style="font-size:13px;color:#c47a3a;font-weight:700;">+ Rp 3.500</span>
                </label>
            </div>

            <hr style="border:none;border-top:0.5px solid rgba(196,122,58,0.18);margin:0;">

            {{-- REQUEST TAMBAHAN --}}
            <div>
                <div style="font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#c47a3a;margin-bottom:6px;">
                    Request Tambahan <span style="font-weight:400;text-transform:none;letter-spacing:0;font-size:11px;color:rgba(245,222,179,0.4);">(Opsional)</span>
                </div>
                <textarea id="cakeNote" rows="3"
                    placeholder="Tulis permintaan khusus di sini..."
                    style="width:100%;padding:10px 12px;border:0.5px solid rgba(196,122,58,0.2);border-radius:8px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;color:#fff8ee;background:rgba(44,18,6,0.5);resize:vertical;outline:none;line-height:1.6;box-sizing:border-box;transition:border-color 0.2s;"
                    onfocus="this.style.borderColor='#c47a3a'" onblur="this.style.borderColor='rgba(196,122,58,0.2)'"></textarea>
            </div>

            {{-- RINGKASAN --}}
            <div style="background:rgba(44,18,6,0.5);border:0.5px solid rgba(196,122,58,0.22);border-radius:12px;padding:14px 16px;">
                <div style="font-size:12px;font-weight:700;color:#fff8ee;margin-bottom:10px;letter-spacing:0.3px;">Ringkasan Pesanan</div>
                <div style="display:flex;justify-content:space-between;font-size:12px;color:rgba(245,222,179,0.5);margin-bottom:6px;">
                    <span>Harga kue</span>
                    <span id="summaryPrice">Rp 0</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:12px;color:rgba(245,222,179,0.5);margin-bottom:6px;">
                    <span>Jumlah</span>
                    <span id="cakeQtyDisplay">1</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:12px;color:rgba(245,222,179,0.5);margin-bottom:4px;">
                    <span>Paper Bag</span>
                    <span id="summaryPaperbag">—</span>
                </div>
                <div style="border-top:0.5px solid rgba(196,122,58,0.18);padding-top:10px;margin-top:4px;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13px;font-weight:600;color:#fff8ee;">Total</span>
                    <span id="cakeTotalDisplay" style="font-size:17px;font-weight:700;color:#c47a3a;font-family:'Playfair Display',serif;">Rp 0</span>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div style="display:flex;gap:10px;">
                <button type="button" onclick="closeOrderModal()"
                    style="flex:1;background:transparent;color:rgba(245,222,179,0.6);border:0.5px solid rgba(196,122,58,0.3);padding:11px;border-radius:8px;font-size:13px;font-weight:600;font-family:'Plus Jakarta Sans',sans-serif;cursor:pointer;transition:background 0.15s;"
                    onmouseover="this.style.background='rgba(196,122,58,0.08)'" onmouseout="this.style.background='transparent'">
                    Batal
                </button>
                <button type="button" onclick="addToCart()"
                    style="flex:2;background:#c47a3a;color:#fff8ee;border:none;padding:11px;border-radius:8px;font-size:13px;font-weight:700;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;display:flex;align-items:center;justify-content:center;gap:7px;transition:background 0.15s;"
                    onmouseover="this.style.background='#e09040'" onmouseout="this.style.background='#c47a3a'">
                    🛒 Tambah ke Keranjang
                </button>
            </div>

        </div>
    </div>
</div>

<style>
@media (max-width: 480px) {
    #orderModal > div { width: 94%; margin: 16px auto; border-radius: 14px; }
    #orderModal h2 { font-size: 15px; }
    #sliderWrap, #sliderWrap #sliderTrack img { height: 160px !important; }
}
</style>

<script>
let currentProductId = 0;
let currentPrice = 0;
let currentImages = [];
let currentSlide = 0;
const PAPERBAG_PRICE = 3500;

function fmt(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

function openOrderModal(id, name, price, images, description) {
    document.getElementById('orderModal').style.display = 'block';
    document.getElementById('cakeName').innerText = name;
    document.getElementById('cakeDesc').innerText = description || '';
    currentPrice = parseInt(price);
    currentSlide = 0;
    currentProductId = id;

    document.getElementById('cakeQty').value = 1;
    document.getElementById('toggleLilin').checked = false;
    document.getElementById('togglePaperbag').checked = false;
    document.getElementById('cakeNote').value = '';
    document.getElementById('lilinSection').style.display = 'none';

    buildSlider(images || []);
    updateSummary();
}

function closeOrderModal() {
    document.getElementById('orderModal').style.display = 'none';
}

function buildSlider(images) {
    const track   = document.getElementById('sliderTrack');
    const dots    = document.getElementById('sliderDots');
    const noImg   = document.getElementById('noImage');
    const btnPrev = document.getElementById('slidePrev');
    const btnNext = document.getElementById('slideNext');

    track.innerHTML = '';
    dots.innerHTML  = '';
    currentImages   = images;

    if (!images || images.length === 0) {
        noImg.style.display = 'flex';
        btnPrev.style.display = 'none';
        btnNext.style.display = 'none';
        return;
    }

    noImg.style.display = 'none';
    images.forEach((src, i) => {
        const img = document.createElement('img');
        img.src = src;
        img.style.cssText = 'min-width:100%;height:190px;object-fit:cover;flex-shrink:0;';
        track.appendChild(img);

        const dot = document.createElement('div');
        dot.style.cssText = 'width:6px;height:6px;border-radius:50%;cursor:pointer;transition:background 0.2s;';
        dot.style.background = i === 0 ? '#fff8ee' : 'rgba(255,248,238,0.4)';
        dot.onclick = () => goSlide(i);
        dots.appendChild(dot);
    });

    btnPrev.style.display = images.length > 1 ? 'flex' : 'none';
    btnNext.style.display = images.length > 1 ? 'flex' : 'none';
    goSlide(0);
}

function goSlide(index) {
    const track = document.getElementById('sliderTrack');
    const dots  = document.getElementById('sliderDots');
    currentSlide = Math.max(0, Math.min(index, currentImages.length - 1));
    track.style.transform = `translateX(-${currentSlide * 100}%)`;
    Array.from(dots.children).forEach((d, i) => {
        d.style.background = i === currentSlide ? '#fff8ee' : 'rgba(255,248,238,0.4)';
    });
}

function slidePrev() { goSlide(currentSlide - 1); }
function slideNext() { goSlide(currentSlide + 1); }

function increaseQty() {
    const qty = document.getElementById('cakeQty');
    qty.value = parseInt(qty.value) + 1;
    updateSummary();
}

function decreaseQty() {
    const qty = document.getElementById('cakeQty');
    if (qty.value > 1) qty.value = parseInt(qty.value) - 1;
    updateSummary();
}

function toggleLilin() {
    const section  = document.getElementById('lilinSection');
    const checked  = document.getElementById('toggleLilin').checked;
    section.style.display = checked ? 'flex' : 'none';
}

function togglePaperbag() {
    updateSummary();
}

function updateSummary() {
    const qty     = parseInt(document.getElementById('cakeQty').value);
    const paperbag = document.getElementById('togglePaperbag').checked ? PAPERBAG_PRICE : 0;
    const total   = (qty * currentPrice) + paperbag;

    document.getElementById('cakePriceDisplay').innerText = fmt(currentPrice);
    document.getElementById('summaryPrice').innerText     = fmt(currentPrice);
    document.getElementById('cakeQtyDisplay').innerText   = qty;
    document.getElementById('summaryPaperbag').innerText  = paperbag > 0 ? fmt(paperbag) : '—';
    document.getElementById('cakeTotalDisplay').innerText = fmt(total);
}

function addToCart() {
    const qty      = document.getElementById('cakeQty').value;
    const useCandle = document.getElementById('toggleLilin').checked ? 1 : 0;
    const candle1  = document.getElementById('lilinAngka1').value;
    const candle2  = document.getElementById('lilinAngka2').value;
    const paperBag = document.getElementById('togglePaperbag').checked ? 1 : 0;
    const note     = document.getElementById('cakeNote').value;

    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/cart/store';
    form.innerHTML = `
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="product_id" value="${currentProductId}">
        <input type="hidden" name="qty" value="${qty}">
        <input type="hidden" name="use_candle" value="${useCandle}">
        <input type="hidden" name="candle_1" value="${candle1}">
        <input type="hidden" name="candle_2" value="${candle2}">
        <input type="hidden" name="paper_bag" value="${paperBag}">
        <input type="hidden" name="request_tambahan" value="${note}">
    `;
    document.body.appendChild(form);
    form.submit();
}
</script>