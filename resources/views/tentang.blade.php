<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>TENTANG - SECOND CHANCE</title>
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
            <a href="{{ route('tentang') }}">TENTANG</a>
        </nav>
    </div>
</header>

<section class="page-title">
    <h2>TENTANG SECOND CHANCE</h2>
    <p style="margin-top:10px;font-size:13px;color:#666;">
        Second Chance adalah sistem katalog produk preloved luxury yang membantu customer melihat produk dan membantu admin mengelola data barang.
    </p>
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
</footer>

</body>
</html>