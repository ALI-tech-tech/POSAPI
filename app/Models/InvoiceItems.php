<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class InvoiceItems extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_price'
    ];
   
    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }

    public function product(){
        return $this->belongsTo(Products::class);
    }

}
