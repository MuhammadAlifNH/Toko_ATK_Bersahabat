<!-- resources/views/produk/edit.blade.php -->

@extends('layouts.app_oprator')

@section('content')
    <div class="container">
    <h2>Edit Produk</h2>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nama_produk">Nama Produk:</label>
            <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}" required>
        </div>
        <div class="form-group">
            <label for="kategori_produk_id">Kategori Produk:</label>
            <select class="form-control" id="kategori_produk_id" name="kategori_produk_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($kategoriProduks as $kategoriProduk)
                    <option value="{{ $kategoriProduk->id }}" {{ $kategoriProduk->id == $produk->kategori_produk_id ? 'selected' : '' }}>{{ $kategoriProduk->nama_kategori }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="gambar_produk">Gambar Produk Saat Ini:</label>
            @if($produk->gambar_produk)
                <div>
                    <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" width="100">
                </div>
            @endif
            <label for="gambar_produk">Unggah Gambar Produk Baru:</label>
            <input type="file" class="form-control-file" id="gambar_produk" name="gambar_produk">
        </div>
        <div class="form-group">
            <label for="deskripsi_produk">Deskripsi Produk:</label>
            <textarea class="form-control" id="deskripsi_produk" name="deskripsi_produk" required>{{ $produk->deskripsi_produk }}</textarea>
        </div>
        <div class="form-group">
            <label for="jumlah_produk">Jumlah Produk:</label>
            <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" value="{{ $produk->jumlah_produk }}" required>
        </div>
        <div class="form-group">
            <label for="harga_produk">Harga Produk:</label>
            <input type="number" class="form-control" id="harga_produk" name="harga_produk" value="{{ $produk->harga_produk }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
    </div>

@endsection
