<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CATALOG - SECOND CHANCE</title>
<link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>

<header>
    <div class="nav-container">
        <div class="logo">
            <img src="{{ asset('logo.jpg') }}" alt="Second Chance Logo">
            <h1>SECOND CHANCE</h1>
        </div>
        <nav>
            <a href="{{ route('dashboard') }}">HOME</a>
            <a href="{{ route('katalog') }}">CATALOG</a>
            <a href="{{ route('admin') }}" class="admin-link-badge">ADMIN</a>
        </nav>
    </div>
</header>

<section class="page-title">
    <h2>ALL PRODUCTS</h2>
    <p style="margin-top:10px;font-size:12px;letter-spacing:2px;color:#666;">
        SEMUA BARANG YANG TERSEDIA DI KATALOG
    </p>
</section>

<div class="catalog-toolbar">
    <input type="text" id="catalogSearchInput" placeholder="Cari nama / kode produk">
    <select id="catalogCategoryFilter">
        <option value="SEMUA">Semua Kategori</option>
        <option value="JACKET">JACKET</option>
        <option value="BAG">BAG</option>
        <option value="SHOES">SHOES</option>
        <option value="ACCESSORIES">ACCESSORIES</option>
    </select>
</div>

<section class="catalog-grid-page" id="catalogContainer">
    @forelse($produk as $item)
        <a class="product-card-link catalog-item"
           href="{{ route('detail', $item->id) }}"
           data-name="{{ strtolower($item->nama) }}"
           data-code="{{ strtolower($item->kode) }}"
           data-category="{{ $item->kategori }}">

            <div class="card">
                @if($item->foto)
                    <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}">
                @else
                    <div class="arrival-no-photo">📷</div>
                @endif

                <h3>{{ strtoupper($item->nama) }}</h3>
                <p>Rp{{ number_format($item->harga, 0, ',', '.') }}</p>

                <div class="product-meta">
                    {{ $item->kategori }} • Kode {{ $item->kode }}
                </div>

                <div style="margin-top:10px;">
                    <span class="inventory-btn" style="display:inline-block;text-decoration:none;">
                        BELI SEKARANG
                    </span>
                </div>
            </div>
        </a>
    @empty
        <p class="empty-state">Produk tidak ditemukan.</p>
    @endforelse
</section>

<footer>
    <div>
        <h4>ABOUT</h4>
        <p>PreLoved Luxury System</p>
    </div>
    <div>
        <h4>MENU</h4>
        <p>Home</p>
        <p>Catalog</p>
    </div>
    <div>
        <h4>BELI SEKARANG</h4>
        <p>Klik produk untuk membuka detail dan lanjut pembelian.</p>
    </div>
</footer>

<script>
const searchInput = document.getElementById('catalogSearchInput');
const categoryFilter = document.getElementById('catalogCategoryFilter');
const items = document.querySelectorAll('.catalog-item');

function filterCatalog() {
    const keyword = searchInput.value.toLowerCase().trim();
    const category = categoryFilter.value;

    items.forEach(item => {
        const name = item.dataset.name;
        const code = item.dataset.code;
        const itemCategory = item.dataset.category;

        const matchKeyword = name.includes(keyword) || code.includes(keyword);
        const matchCategory = category === 'SEMUA' || itemCategory === category;

        item.style.display = matchKeyword && matchCategory ? 'block' : 'none';
    });
}

searchInput.addEventListener('input', filterCatalog);
categoryFilter.addEventListener('change', filterCatalog);
</script>

</body>
</html>