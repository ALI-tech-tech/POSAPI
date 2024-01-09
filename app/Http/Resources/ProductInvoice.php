<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductInvoice extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "invoice_id"=>$this->invoice_id,
            'quantity'=>$this->quantity,
            'price'=>$this->unit_price, 
            'product'=>$this->product->name,          
            "created_at"=>$this->created_at,
            "updated_at"=>$this->updated_at,
           
        ];
    }
}
