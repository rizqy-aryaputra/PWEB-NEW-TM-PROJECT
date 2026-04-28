<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SECOND CHANCE</title>
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
            <a href="https://wa.me/6200000000000" target="_blank">CONTACT</a>
            <a href="{{ route('admin') }}">ADMIN</a>
        </nav>
    </div>
</header>

<section class="hero">
    <div>
        <h2>TIMELESS LUXURY</h2>
        <p>CURATED PRELOVED FASHION</p>
    </div>
</section>

<div class="container">
    <aside>
        <h3>STATISTICS</h3>
        <p>Total Produk: {{ $totalProduk }}</p>
        <p>Total Item: {{ $totalItem }}</p>
        <p>New Arrival: {{ $newArrival }}</p>
    </aside>

    <main>
        <h2>NEW ARRIVALS</h2>

        @forelse($produk->take(6) as $item)
            <a class="product-card-link" href="{{ route('detail', $item->id) }}">
                <div class="card">
                    @if($item->foto)
                        <img src="{{ asset($item->foto) }}" alt="{{ $item->nama }}">
                    @else
                        <div class="arrival-no-photo">📷</div>
                    @endif

                    <h3>{{ strtoupper($item->nama) }}</h3>
                    <p>Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                    <div class="product-meta">
                        {{ $item->kategori }} • {{ $item->tanggal_masuk }}
                    </div>
                </div>
            </a>
        @empty
            <p class="empty-state">Belum ada produk.</p>
        @endforelse

        <h2>KATALOG PREVIEW</h2>
        <table>
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>CATEGORY</th>
                    <th>PRICE</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produk->take(8) as $item)
                    <tr>
                        <td>
                            <a href="{{ route('detail', $item->id) }}" style="color:inherit;text-decoration:none;">
                                {{ $item->nama }}
                            </a>
                        </td>
                        <td>{{ $item->kategori }}</td>
                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</div>

<section class="inventory-section">
    <div class="inventory-wrapper">
        <div class="inventory-header">
            <h2>BELI SEKARANG</h2>
            <p>Pilih produk favoritmu dari katalog dan lanjutkan ke halaman detail.</p>
        </div>
        <div class="panel" style="text-align:center;">
            <a href="{{ route('katalog') }}" class="inventory-btn" style="text-decoration:none;">LIHAT KATALOG</a>
        </div>
    </div>
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
        <p>Beli Sekarang</p>
    </div>
    <div>
        <h4>CONTACT</h4>
        <p>Chat via WhatsApp</p>
    </div>
</footer>

</body>
</html>