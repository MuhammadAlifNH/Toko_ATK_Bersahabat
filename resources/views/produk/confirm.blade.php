<!-- resources/views/produk/confirm.blade.php -->

@extends('layouts.app_oprator')

@section('content')
<div class="container">
    <h2>Konfirmasi Hapus Produk</h2>
    <p>Apakah Anda yakin ingin menghapus produk ini?</p>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $produk->nama_produk }}</h5>
            <p class="card-text">Kategori: {{ $produk->kategoriProduk->nama_kategori }}</p>
            <p class="card-text">Deskripsi: {{ $produk->deskripsi_produk }}</p>
            <p class="card-text">Jumlah: {{ $produk->jumlah_produk }}</p>
            <p class="card-text">Harga: Rp{{ number_format($produk->harga_produk, 2) }}</p>
            @if($produk->gambar_produk)
                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" width="100">
            @else
                <p>Tidak ada gambar</p>
            @endif
        </div>
    </div>

    <form action="{{ route('produk.destroy', $produk->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batalkan</a>
    </form>
    </div>

@endsection
