<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Borrowing extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'borrow_date',
        'return_date',
        'status',
    ];

    /**
     * Relasi untuk mengambil data Nama Peminjam
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi untuk mengambil data Barang yang dipinjam
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}