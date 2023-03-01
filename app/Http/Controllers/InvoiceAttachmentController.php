<?php

namespace App\Http\Controllers;

use App\Models\Invoice_attachment;
use Dotenv\Validator as ValidatorAlias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InvoiceAttachmentController extends Controller
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
        $this->validate($request,[
            'file_name'=>'required|mimes:pdf,jpg,png,jpeg'
        ]);
        $attachment=$request->file('file_name');

        $ext=$attachment->getClientOriginalExtension();
        $name=$attachment->getClientOriginalName();
        $name=explode('.',$name);
        array_pop($name);
        $name=join($name);
        $attachment_name="$name".$request->invoice_id.".$ext";
        $attachment->move("attachments/".$request->invoice_number,$attachment_name);
        $attach=new Invoice_attachment();
        $attach->file_name=$attachment_name;
        $attach->created_by=$request->created_by;
        $attach->invoice_number=$request->invoice_number;
        $attach->invoice_id=$request->invoice_id;
        $attach->save();
        return redirect()->back()->with('attach',"تم اضفة مرفق بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice_attachment  $invoice_attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_attachment $invoice_attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_attachment  $invoice_attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_attachment $invoice_attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_attachment  $invoice_attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_attachment $invoice_attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_attachment  $invoice_attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_attachment $invoice_attachment)
    {
        //
    }

}
