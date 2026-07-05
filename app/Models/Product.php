<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 
        'code', 
        'name', 
        'stock', 
        'storage_location', 
        'condition', 
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke data peminjaman barang
     */
    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}