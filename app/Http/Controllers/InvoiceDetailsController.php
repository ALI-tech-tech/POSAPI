<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Http\Resources\InvoiceDetailsResource;
use App\Models\Products;

class InvoiceDetailsController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
               
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $invoice=Auth::user()->invoices()->findOrFail($request->invoice_id);
        $product=Products::find($request->product_id);
        if ( $product->quantity < $request->quantity) {
            return $this->failed_response(message:"NotEnough");
        }
        $product->addseels($request->quantity);
        $invoicedetails=$invoice->items()->create($request->all());
        $total=$invoice->total_amount+($request->unit_price * $request->quantity);
        $invoice->total_amount=$total;
        $invoice->save();
        return $this->success_response(data: $invoicedetails,message:"AddSuccessful");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $invoice=Invoice::findOrfail($id);
        $details=InvoiceDetailsResource::collection( $invoice->items);
        return $this->success_response(data: $details); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
