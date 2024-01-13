<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Products extends Model
{
    use HasFactory,SoftDeletes;


    protected $fillable = [
        "category_id",
        'provider_id',
        'barcode',
        "name",
        "buy",
        "sell",
        "description",
        "quantity"
    ];

    public function addPurchase($quantity, $buy, $sell)
    {
        $this->quantity += $quantity;
        $this->buy=$buy;
        $this->sell=$sell;
        $this->save();
        
        Purchase::create([
            'product_id' => $this->id,
            'quantity' => $quantity,
            'buy' => $buy,
            'sell'=>$sell
        ]);

        
    }
    public function addseels($quantity)  {
        $this->quantity -= $quantity;
        $this->save();
    }
   
    public function purchases() {
        return $this->hasMany(Purchase::class);
    }
}
