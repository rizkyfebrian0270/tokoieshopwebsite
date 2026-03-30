<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; 
    public $timestamps = false; 

    protected $primaryKey = 'id';

    // Bagian ini sudah dipastikan tanda bacanya lengkap
    protected $fillable = [
        'categories_id', 
        'nama', 
        'harga', 
        'ukuran', 
        'warna', 
        'foto',
        'detail', 
        'ketersediaan_stok'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}