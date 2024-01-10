<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use Illuminate\Validation\Rule;

use function PHPUnit\Framework\isNull;

class InvoicController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $invoices=  InvoiceResource::collection(Auth::user()->invoices);
       
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

    public function save(string $id)
    {
        $invoice= Invoice::find($id); 
        if (is_null($invoice)) {
            return $this->failed_response(message:"Not_found" );
        }
        $invoice->isSave=true;  
        $invoice->save();
        return $this->success_response(data: $invoice,message:"UpdateSuccessful");
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
                
               
            ]
        );
    }
}
