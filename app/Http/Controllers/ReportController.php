<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceDetailsResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\ProductInvoice;
use App\Models\Customer;
use App\Models\Products;
use App\Models\Shops;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;
use PDF;
use Storage;
class ReportController extends Controller
{
    use ApiResponse;
    public  function calculateTotal( $invoiceItems)
    {
        

        $total = 0;

        foreach ($invoiceItems as $item) {
            $total += $item->unit_price * $item->quantity;
        }

        return $total;
    }
    public function generate_invoice($id) {
        //$shop=Auth::user()->with('shop')->first();
        // $user = Auth::user();
        // $shop= $user->load('shop');
        $shop=User::with('shop')->find(1);
        $invoice=InvoiceResource::make(Invoice::findOrfail($id));
        // print_r($invoice->items);
       $details= $invoice->items;
    //    $details->load('product');
    //    $productIds = $details->pluck('product_id')->unique()->toArray();
    // $products = Products::whereIn('id', $productIds)->get();
    //    print_r($products);
    //    return $details;
// return $invoice;
$customer=Customer::find($invoice->customer_id);
$content = DB::table('invoices')
        ->select('invoices.*', 'invoice_items.*', 'products.*')
        ->join('invoice_items', 'invoices.id', '=', 'invoice_items.invoice_id')
        ->join('products', 'invoice_items.product_id', '=', 'products.id')
        ->where('invoices.id', $id)
        ->get();
        // $customer=Customer::find($invoice->customer_id);
        // $shop=Shops::where('user_id','=',Auth::user()->id)->get();
        //$shop=Shops::where('user_id','=',1)->get();
        $total= $this->calculateTotal($details);
    // return $invoice;
    //return response()->json(compact('invoice','details','customer','total','shop'));
        // Get the current date and time.
        $dateTime = now();

        // Generate a unique filename.
        $fileName = $dateTime->format('YmdHis') . '_invoice.pdf';

        
      
        // Generate the PDF file.
      $pdf = PDF::loadView('pdf.invoicetemplate', compact('invoice','details','customer','total','shop','content'));

        // Save the PDF file in the public storage.
       $pdf->save(storage_path('app/public/pdf/' . $fileName));

        // // Get the file path.
        $filePath = storage_path('app/public/pdf/' . $fileName);

        // Return the file for download.
         return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
         //return response()->json($data);
        //  return view('pdf.invoice')->with('invoice',$data);
        //  return view('pdf.invoicetemplate', compact('invoice','details','customer','total','shop','content'));
        //dd($invoice);
        

    }

    public function generate_report(Request $request) {
        if (is_null($request->customer_id)) {
            return $this->failed_response(message:'NoDataSend');
        }
        if (!is_null($request->from) && is_null($request->to) ) {
            $invoice=Customer::with(["invoices"=> function ($query)use($request) {
                $query->where('created_at','like',$request->from.'%')->orderBy('created_at');
            }])->find($request->customer_id);
        }
        elseif(!is_null($request->from) && !is_null($request->to) ) {
            $invoice=Customer::with(["invoices"=> function ($query)use($request) {
                $query->whereBetween("created_at",[$request->from,$request->to])->orderBy('created_at');
            }])->find($request->customer_id);
        }
        else {
            $invoice=Customer::with("invoices")->find($request->customer_id);
        }
        if (is_null($invoice)) {
            return $this->failed_response(message:'NoDataSend');
        }

        return $this->success_response(data: $invoice);
    }

    
    
}
