<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabel di databasemu
    protected $table = 'categories'; 
    public $timestamps = false;
    protected $fillable = ['nama'];

    // Relasi ke produk (1 Kategori punya banyak Produk)
    public function products()
    {
        return $this->hasMany(Product::class, 'categories_id');
    }
}