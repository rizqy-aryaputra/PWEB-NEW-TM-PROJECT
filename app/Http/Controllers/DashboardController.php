<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalProduk = $produk->count();
        $totalItem = $produk->sum('stok');
        $newArrival = $produk->take(6)->count();

        return view('dashboard', compact('produk', 'totalProduk', 'totalItem', 'newArrival'));
    }

    public function katalog()
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        return view('katalog', compact('produk'));
    }

    public function detail($id)
    {
        $produk = DB::table('products')
            ->where('id', $id)
            ->first();

        return view('detail', compact('produk'));
    }

    public function admin()
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalItem = $produk->sum('stok');
        $totalNilai = $produk->sum(function ($item) {
            return $item->stok * $item->harga;
        });
        $stokMenipis = $produk->where('stok', '<', 5)->count();

        $editProduk = null;

        return view('admin', compact('produk', 'totalItem', 'totalNilai', 'stokMenipis', 'editProduk'));
    }

    public function adminEdit($id)
    {
        $produk = DB::table('products')
            ->orderBy('tanggal_masuk', 'desc')
            ->get();

        $totalItem = $produk->sum('stok');
        $totalNilai = $produk->sum(function ($item) {
            return $item->stok * $item->harga;
        });
        $stokMenipis = $produk->where('stok', '<', 5)->count();

        $editProduk = DB::table('products')->where('id', $id)->first();

        return view('admin', compact('produk', 'totalItem', 'totalNilai', 'stokMenipis', 'editProduk'));
    }

    public function store(Request $request)
    {
        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $namaFoto);
            $fotoPath = 'uploads/' . $namaFoto;
        }

        DB::table('products')->insert([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => $fotoPath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin');
    }

    public function update(Request $request, $id)
    {
        $produkLama = DB::table('products')->where('id', $id)->first();
        $fotoPath = $produkLama->foto;

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namaFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('uploads'), $namaFoto);
            $fotoPath = 'uploads/' . $namaFoto;
        }

        DB::table('products')->where('id', $id)->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'kategori' => $request->kategori,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => $fotoPath,
            'updated_at' => now(),
        ]);

        return redirect()->route('admin');
    }

    public function delete($id)
    {
        DB::table('products')->where('id', $id)->delete();

        return redirect()->route('admin');
    }
}