<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DETAIL PRODUCT - SECOND CHANCE</title>
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
            <a href="{{ route('admin') }}">ADMIN</a>
        </nav>
    </div>
</header>

<section class="detail-wrapper">
    @if(!$produk)
        <div class="panel" style="grid-column:1/-1;text-align:center;">
            <h3>Produk tidak ditemukan</h3>
            <p style="margin-top:10px;">
                Produk yang kamu cari tidak tersedia.
            </p>

            <div class="detail-actions" style="justify-content:center;">
                <a href="{{ route('katalog') }}" class="inventory-btn" style="text-decoration:none;">
                    KEMBALI KE KATALOG
                </a>
            </div>
        </div>
    @else
        <div class="detail-grid">
            <div>
                @if($produk->foto)
                    <img class="detail-image" src="{{ asset($produk->foto) }}" alt="{{ $produk->nama }}">
                @else
                    <div class="detail-no-photo">📷</div>
                @endif
            </div>

            <div class="detail-info">
                <div class="info-badge">{{ $produk->kategori }}</div>

                <h2>{{ strtoupper($produk->nama) }}</h2>

                <p>Kode Produk: {{ $produk->kode }}</p>
                <p>Tanggal Masuk: {{ $produk->tanggal_masuk }}</p>
                <p>Stok Tersedia: {{ $produk->stok }}</p>

                <p class="detail-price">
                    Rp{{ number_format($produk->harga, 0, ',', '.') }}
                </p>

                <p>
                    Produk ini merupakan bagian dari koleksi preloved luxury yang dikelola melalui dashboard admin
                    dan otomatis tampil untuk customer.
                </p>

                <div class="detail-actions">
                    <a href="{{ route('katalog') }}" class="inventory-btn" style="text-decoration:none;">
                        KEMBALI KE KATALOG
                    </a>

                    <a href="#" class="inventory-btn secondary" style="text-decoration:none;">
                        BELI SEKARANG
                    </a>
                </div>
            </div>
        </div>
    @endif
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
        <p>Gunakan tombol beli sekarang untuk masuk ke halaman transaksi produk.</p>
    </div>
</footer>

</body>
</html>