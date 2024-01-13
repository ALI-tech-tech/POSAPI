<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class PurchaseController extends Controller
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
        $product=Products::find($request->product_id);
        $product->addPurchase($request->quantity,$request->buy, $request->sell);
        return $this->success_response(data: $product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
