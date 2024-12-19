<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara mass-assignment
    protected $fillable = [
        'name', // Nama kategori
        'slug',     // Keterangan (opsional)
    ];

    // Relasi dengan tabel products
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
