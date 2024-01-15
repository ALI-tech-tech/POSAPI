<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Customer extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
        'name',
        'address',
        'phone',
        'note'
    ];

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
    public function invoiceitems()
    {
        return $this->hasManyThrough( InvoiceItems::class, Invoice::class, 'customer_id','invoice_id','id','id');     
    }
}
