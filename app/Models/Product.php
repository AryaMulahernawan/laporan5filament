<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'kategori_id',
        'deskripsi',
        'harga',
        'stok',
        'foto_produk',
        'file_produk',
        'tipe_produk', // Tambahkan kolom ini
        'status', // Tambahkan kolom ini
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}