<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Resources\InvoiceDetailsResource;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\ProductInvoice;
use App\Models\Customer;
use App\Models\Shops;
use App\Models\User;
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
        //$shop=Auth::user()->with('shop')->first();
        // $user = Auth::user();
        // $shop= $user->load('shop');
        $shop=User::with('shop')->find(1);
        $invoice=InvoiceResource::make(Invoice::findOrfail($id));
       $details=InvoiceDetailsResource::collection( $invoice->items);
        $customer=Customer::find($invoice->customer_id);
        // $shop=Shops::where('user_id','=',Auth::user()->id)->get();
        //$shop=Shops::where('user_id','=',1)->get();
        $total= $this->calculateTotal($details);
    
    //return response()->json(compact('invoice','details','customer','total','shop'));
        // Get the current date and time.
        $dateTime = now();

        // Generate a unique filename.
        $fileName = $dateTime->format('YmdHis') . '_invoice.pdf';

        
      
        // Generate the PDF file.
       $pdf = PDF::loadView('pdf.invoicetemplate', compact('invoice','details','customer','total','shop'));

        // Save the PDF file in the public storage.
       $pdf->save(storage_path('app/public/pdf/' . $fileName));

        // // Get the file path.
        $filePath = storage_path('app/public/pdf/' . $fileName);

        // Return the file for download.
         return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
         //return response()->json($data);
        //  return view('pdf.invoice')->with('invoice',$data);
        // return view('pdf.invoicetemplate', compact('invoice','details','customer','total','shop'));
        //dd($invoice);
        

    }
    public function  generate_pdf() {

        $data = [
            'translation'=>[
                'hello' => 'اهلا',
                'welcome' => 'مرحبا',
                'good' => 'جيد'
                ]
        ];
        // Get the current date and time.
        $dateTime = now();

        // Generate a unique filename.
        $fileName = $dateTime->format('YmdHis') . '_translation.pdf';

        //Generate the pdf file
        $pdf = PDF::loadView('pdf.translation', $data);


        //return $pdf->stream( $filename);

         //Save the pdf file in the public storage
        $pdf->save( storage_path('app/public/'.$fileName));
       

       //Get the file url
       
        $urlToDownload =  Storage::disk('public')->url($fileName);


        return response()->json([
            'success' => true,
            'url' => $urlToDownload,
        ]);
    }
    
}
