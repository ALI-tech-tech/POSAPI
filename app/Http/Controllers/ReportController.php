<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceDetailsResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\ProductInvoice;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponse;
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
        $shop=Auth::user()->shop;
        $invoice=InvoiceResource::make(Invoice::findOrfail($id));
       $details=InvoiceDetailsResource::collection( $invoice->items);
        $customer=Customer::findOrfail($invoice->customer_id);
        $total= $this->calculateTotal($details);
        $data = [
            'invoice' => $invoice,
            //'invoicedetails'=>$details,
            //'product'=>$invoice->items->product
        ];
    //return response()->json(compact('invoice','details','customer','total'));
        // Get the current date and time.
        $dateTime = now();

        // Generate a unique filename.
        $fileName = $dateTime->format('YmdHis') . '_invoice.pdf';

        // Generate the PDF file.
        //$pdf = PDF::loadView('pdf.invoice', $data);

        // Save the PDF file in the public storage.
        // $pdf->save(storage_path('app/public/' . $fileName));

        // // Get the file path.
        // $filePath = storage_path('app/public/' . $fileName);

        // Return the file for download.
        // return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
         //return response()->json($data);
        //  return view('pdf.invoice')->with('invoice',$data);
         return view('pdf.invoice', compact('invoice','details','customer','total'));
        //dd($invoice);
        

    }
    
}
