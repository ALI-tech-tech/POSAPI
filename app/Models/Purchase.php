<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable=[
        'product_id',
        'buy',
        'quantity',
        'sell'
    ];

    public function product() {
        return $this->belongsTo(Products::class);
    }
}
