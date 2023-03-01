<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_detail $invoice_detail,$id)
    {
        $invoices=Invoice::where('id',$id)->first();
        $details=Invoice_detail::where('invoice_id',$id)->get();
        $attachments=Invoice_attachment::where('invoice_id',$id)->get();

        return view('invoices.invoices_details',compact('details','attachments','invoices'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_detail $invoice_detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_detail  $invoice_detail
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $invoices = Invoice_attachment::findOrFail($id);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($invoices->invoice_number.'/'.$invoices->file_name);
          return redirect()->back()-> with('delete', 'تم حذف المرفق بنجاح');

    }
    public function get_file($invoice_number,$file_name)

    {
        $contents= Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
        return response()->download( $contents);
    }



    public function open_file($invoice_number,$file_name)

    {
        $files = Storage::disk('public_uploads')->path($invoice_number.'/'.$file_name);
        return response()->file($files);
    }

}
