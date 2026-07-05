<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'code', 'name', 'stock', 'description'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}