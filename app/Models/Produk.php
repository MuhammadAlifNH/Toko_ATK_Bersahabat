<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    // Menentukan nama tabel jika tidak mengikuti konvensi Laravel (opsional)
    protected $table = 'produks';

    // Menentukan kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'nama_produk',
        'kategori_produk_id',
        'gambar_produk',
        'deskripsi_produk',
        'jumlah_produk',
        'harga_produk',
    ];

    /**
     * Relasi dengan model KategoriProduk
     * Satu produk belongs to satu kategori_produk
     */
    public function kategoriProduk()
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_produk_id');
    }
}
