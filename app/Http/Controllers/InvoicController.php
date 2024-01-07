<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class InvoicController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices= Auth::user()->invoices;
       
        return $this->success_response(data: $invoices);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $this->rules($request);
        if ($validate->fails()) {
            return $this->failed_response(data: $validate->errors());
        }

        $invoice=Auth::user()->invoices()->create($request->all());
        
        return $this->success_response(data: $invoice,message:"AddSuccessful");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

    function rules(Request $request)
    {
        return Validator::make(
            $request->all(),
            [           
                'customer_id' =>  ['required'],
                'invoice_date'=>['required']
               
            ]
        );
    }
}
