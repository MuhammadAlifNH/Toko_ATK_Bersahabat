<!-- resources/views/produk/index.blade.php -->

@extends('layouts.app_oprator')

@section('content')
    <div class="container">
        <h2>Daftar Produk</h2>
        <a href="{{ route('produk.create') }}" class="btn btn-success mb-3">Tambah Produk Baru</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produks as $produk)
                    <tr>
                        <td>{{ $produk->id }}</td>
                        <td>{{ $produk->nama_produk }}</td>
                        <td>{{ $produk->kategori_produk->kategori }}</td>
                        <td>
                            @if($produk->gambar_produk)
                                <img src="{{ asset('storage/' . $produk->gambar_produk) }}" alt="{{ $produk->nama_produk }}" width="100">
                            @else
                                Tidak ada gambar
                            @endif
                        </td>
                        <td>{{ $produk->deskripsi_produk }}</td>
                        <td>{{ $produk->jumlah_produk }}</td>
                        <td>Rp{{ $produk->harga_produk }}</td>
                        <td>
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
