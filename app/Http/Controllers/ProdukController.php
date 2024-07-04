<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\KategoriProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    
    public function index()
    {
        $produks = Produk::with('kategoriProduk')->get();
        return view('produk.index', compact('produks'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_produk_id' => 'required|exists:kategori_produk,id',
            'gambar_produk' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi_produk' => 'required|string',
            'jumlah_produk' => 'required|integer',
            'harga_produk' => 'required|numeric',
        ]);

        // Menyimpan file gambar
        $gambarProduk = $request->file('gambar_produk');
        $gambarPath = $gambarProduk->store('images', 'public');

        Produk::create([
            'nama_produk' => $request->nama_produk,
            'kategori_produk_id' => $request->kategori_produk_id,
            'gambar_produk' => $gambarPath,
            'deskripsi_produk' => $request->deskripsi_produk,
            'jumlah_produk' => $request->jumlah_produk,
            'harga_produk' => $request->harga_produk,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dibuat.');
    }


    public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'kategori_produk_id' => 'required|exists:kategori_produk,id',
        'gambar_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'deskripsi_produk' => 'required|string',
        'jumlah_produk' => 'required|integer',
        'harga_produk' => 'required|numeric',
    ]);

    $produk = Produk::findOrFail($id);

    // Mengupdate gambar jika ada upload gambar baru
    if ($request->hasFile('gambar_produk')) {
        // Menghapus gambar lama jika ada
        if ($produk->gambar_produk) {
            Storage::delete('public/' . $produk->gambar_produk);
        }

        $gambarProduk = $request->file('gambar_produk');
        $gambarPath = $gambarProduk->store('images', 'public');
        $produk->gambar_produk = $gambarPath;
    }

    $produk->update([
        'nama_produk' => $request->nama_produk,
        'kategori_produk_id' => $request->kategori_produk_id,
        'deskripsi_produk' => $request->deskripsi_produk,
        'jumlah_produk' => $request->jumlah_produk,
        'harga_produk' => $request->harga_produk,
    ]);

    return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
}


    /**
     * Menghapus produk.
     */
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return view('detail_produk', compact('produk'));
    }
}
