@extends('layouts.app_user')

@section('content')
<!DOCTYPE html>
<html>

<body>
    <div class="jumbotron">
        <h1 class="display-4">Selamat datang di Dashboard Toko ATK Bersahabat</h1>
    </div>

    <div class="row">
            @foreach($produks as $produk)
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <img src="{{ asset($produk->gambar_produk) }}" class="card-img-top" alt="Gambar Produk">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($produk->harga_produk, 0, ',', '.') }}</p>
                            <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    
</body>
</html>

@endsection