<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        $kategoriProduks = KategoriProduk::all();
        return view('kategori.index', compact('kategoriProduks'));
    }

    // Menampilkan form untuk membuat kategori baru
    public function create()
    {
        return view('kategori.create');
    }

    // Menyimpan kategori baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        KategoriProduk::create([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dibuat!');
    }

    // Menampilkan form untuk mengedit kategori
    public function edit(KategoriProduk $kategori)
    {
        return view('kategori.edit', compact('kategori'));
    }

    // Mengupdate kategori di database
    public function update(Request $request, KategoriProduk $kategori)
    {
        $request->validate([
            'kategori' => 'required|string|max:255',
        ]);

        $kategori->update([
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate!');
    }

    // Menghapus kategori dari database
    public function destroy(KategoriProduk $kategori)
    {
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }

    public function confirm($id)
    {
        $kategori = KategoriProduk::findOrFail($id); // Adjust with your model name and logic
        return view('kategori.confirm', compact('kategori'));
    }
}
