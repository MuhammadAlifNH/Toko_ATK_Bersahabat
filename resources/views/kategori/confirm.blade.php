@extends('layouts.app_oprator')

@section('content')
    <div class="container mt-5">
        <h1>Konfirmasi Hapus Kategori</h1>

        <div class="card">
            <div class="card-body">
                <p>Anda yakin ingin menghapus kategori ini?</p>

                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Hapus</button>
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection
