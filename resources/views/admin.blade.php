<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ADMIN - SECOND CHANCE</title>
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
            <a href="{{ route('admin') }}">DASHBOARD</a>
            <a href="{{ route('dashboard') }}" class="admin-home-link">CUSTOMER VIEW</a>
        </nav>
    </div>
</header>

<section class="admin-shell">
    <div class="admin-title">
        <h2>ADMIN DASHBOARD</h2>
        <p style="font-size:13px;color:#666;letter-spacing:1px;">
            Kelola semua produk katalog dari halaman admin
        </p>
    </div>

    <div class="inventory-grid">
        <div class="panel">
            <h3>FORM BARANG</h3>

            <form class="inventory-form"
                  method="POST"
                  action="{{ $editProduk ? route('admin.update', $editProduk->id) : route('admin.store') }}"
                  enctype="multipart/form-data">

                @csrf

                <div class="photo-upload-area">
                    @if($editProduk && $editProduk->foto)
                        <div id="photoPreviewWrap" style="display:block;">
                            <img id="photoPreview" src="{{ asset($editProduk->foto) }}" alt="Preview foto">
                        </div>
                    @else
                        <div class="upload-placeholder">
                            <div class="upload-icon">📷</div>
                            <span>UPLOAD FOTO BARANG</span>
                            <small>JPG, PNG, WEBP · Maks. 5 MB</small>
                        </div>
                    @endif
                </div>

                <input type="file" name="foto" accept="image/*">

                <input type="text" name="kode" placeholder="Kode Barang"
                       value="{{ $editProduk->kode ?? '' }}" required>

                <input type="text" name="nama" placeholder="Nama Barang"
                       value="{{ $editProduk->nama ?? '' }}" required>

                <select name="kategori" required>
                    <option value="">Pilih Kategori</option>
                    <option value="JACKET" {{ ($editProduk->kategori ?? '') == 'JACKET' ? 'selected' : '' }}>JACKET</option>
                    <option value="BAG" {{ ($editProduk->kategori ?? '') == 'BAG' ? 'selected' : '' }}>BAG</option>
                    <option value="SHOES" {{ ($editProduk->kategori ?? '') == 'SHOES' ? 'selected' : '' }}>SHOES</option>
                    <option value="ACCESSORIES" {{ ($editProduk->kategori ?? '') == 'ACCESSORIES' ? 'selected' : '' }}>ACCESSORIES</option>
                </select>

                <input type="number" name="stok" placeholder="Stok"
                       value="{{ $editProduk->stok ?? '' }}" required>

                <input type="number" name="harga" placeholder="Harga"
                       value="{{ $editProduk->harga ?? '' }}" required>

                <input type="date" name="tanggal_masuk"
                       value="{{ $editProduk->tanggal_masuk ?? '' }}" required>

                <div class="form-actions">
                    <button type="submit" class="inventory-btn">
                        {{ $editProduk ? 'UPDATE BARANG' : 'SIMPAN BARANG' }}
                    </button>

                    @if($editProduk)
                        <a href="{{ route('admin') }}" class="inventory-btn secondary" style="text-decoration:none;">
                            BATAL
                        </a>
                    @endif
                </div>

                @if($editProduk)
                    <div class="error-box">Mode edit aktif.</div>
                @endif
            </form>
        </div>

        <div class="panel">
            <h3>DAFTAR INVENTARIS</h3>

            <div class="stats-grid">
                <div class="stat-card">
                    <h4>TOTAL ITEM</h4>
                    <p>{{ $totalItem }}</p>
                </div>
                <div class="stat-card">
                    <h4>TOTAL NILAI INVENTARIS</h4>
                    <p>Rp{{ number_format($totalNilai, 0, ',', '.') }}</p>
                </div>
                <div class="stat-card">
                    <h4>STOK MENIPIS (&lt;5)</h4>
                    <p>{{ $stokMenipis }}</p>
                </div>
            </div>

            <div class="inventory-table-wrap">
                <table class="inventory-table">
                    <thead>
                        <tr>
                            <th>FOTO</th>
                            <th>KODE</th>
                            <th>NAMA</th>
                            <th>KATEGORI</th>
                            <th>STOK</th>
                            <th>HARGA</th>
                            <th>TANGGAL</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($produk as $item)
                            <tr>
                                <td>
                                    @if($item->foto)
                                        <img class="tbl-thumb" src="{{ asset($item->foto) }}" alt="{{ $item->nama }}">
                                    @else
                                        <div class="tbl-no-photo">📷</div>
                                    @endif
                                </td>

                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->kategori }}</td>
                                <td>{{ $item->stok }}</td>
                                <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td>{{ $item->tanggal_masuk }}</td>

                                <td>
                                    <div style="display:flex;justify-content:center;gap:6px;">
                                        <a href="{{ route('admin.edit', $item->id) }}" class="action-btn" style="text-decoration:none;">
                                            EDIT
                                        </a>

                                        <form method="POST"
                                              action="{{ route('admin.delete', $item->id) }}"
                                              onsubmit="return confirm('Yakin hapus {{ $item->nama }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="action-btn delete">
                                                HAPUS
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="empty-state">
                                    Data belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

</body>
</html>