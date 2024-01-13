<?php

namespace App\Http\Resources;

use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Traits\ApiResponse;
use App\Http\Resources\InvoiceDetailsResource;
use Carbon\Carbon;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        
            'id' => $this->id,
            'customer'=>  Customer::find($this->customer_id),
            'total_amount'=> $this->total_amount??0.0,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),
            'updated_at' => Carbon::parse($this->updated_at)->format('Y-m-d'),
            'issave'=>$this->isSave,
            'items'=>InvoiceDetailsResource::collection(Invoice::findOrfail($this->id)->items)
        ];
    }
}
