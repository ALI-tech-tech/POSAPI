<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Purchase;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
class PurchaseController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     
         $user = Auth::user();
         $purchases = $user->purchases();
         return $this->success_response(data: $purchases);

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
    public function destroy(int $id)
    {
        $purchase= Purchase::find($id);
        $purchase->delete();
        return $this->success_response(data: $purchase,message:"DeleteSuccessful");

    }
}
