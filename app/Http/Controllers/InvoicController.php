<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\SoftDeletes;
use function PHPUnit\Framework\isNull;

class InvoicController extends Controller
{
    use ApiResponse,SoftDeletes;
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
    public function update(Request $request, int $id)
    {
        $invoice= Invoice::find($id)->update($request->all());
        return $this->success_response(data: $invoice,message:"UpdateSuccessful");
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
    public function salesToday()
    {
        $user=Auth::user();
        $invoice= $user->invoices; 
        if (is_null($invoice)) {
            return $this->failed_response(message:"ُEmpty" );
        }
        $today = Carbon::today()->toDateString();
        
        $sumSales = Invoice::where('created_at', 'LIKE', $today . '%')->sum('total_amount');

        // $sumSales=$invoice->where('created_at','=', $today)->sum("total_amount");
        return $this->success_response(data: $sumSales,message:"Successful");

        // $today = Carbon::today()->toDateString(); // Convert to a string in 'Y-m-d' format
    
    
    }


    public function search(Request $request) {
        if (is_null($request->customer_id)) {
            return $this->failed_response(message:'NoDataSend');
        }
        if (!is_null($request->from) && is_null($request->to) ) {
            $invoice=InvoiceResource::collection( 
                Invoice::where('customer_id','=',$request->customer_id)
                ->where('created_at','like',$request->from.'%')
                ->orderBy('created_at')->get());
        }
        elseif(!is_null($request->from) && !is_null($request->to) ) {
            // $invoice=Invoice::where('customer_id','=',$request->customer_id)->where(["created_at"=> function ($query)use($request) {
            //     $query->whereBetween("created_at",[$request->from,$request->to])->orderBy('created_at');
            // }])->get();

            $invoice=InvoiceResource::collection(
                Invoice::where('customer_id','=',$request->customer_id)
                ->whereBetween("created_at",[$request->from,$request->to])
                ->orderBy('created_at')->get());
        }
        else {
            $invoice=InvoiceResource::collection(Invoice::where('customer_id','=',$request->customer_id)->get());
        }
        if (is_null($invoice)) {
            return $this->failed_response(message:'NoDataSend');
        }

        return $this->success_response(data: $invoice);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice= Invoice::find($id);
        if (is_null($invoice->items())) {
            $invoice->items()->delete();
        }
        $invoice->delete();
        return $this->success_response(data: $invoice,message:"DeleteSuccessful");

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
