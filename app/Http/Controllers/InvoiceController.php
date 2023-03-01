<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Http\Requests\RequestInvoice;

use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Invoice_detail;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use App\Notifications\AddInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $invoices= Invoice::all();
        return  view('invoices.invoices',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

         $sections=Section::all();

        return  view('invoices.add_invoice',compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestInvoice $request)
    {


            Invoice::create([
                'invoice_number'=>$request->invoice_number,
                'invoice_data'=>$request->invoice_Date,
                'due_data'=>$request->Due_date,
                'section_id'=>$request->Section,
                'product_id'=>$request->product,
                'amount_collection'=>$request->Amount_collection,
                'amount_commission'=>$request->Amount_Commission,
                'discount'=>$request->Discount,
                'rate_vat'=>$request->Rate_VAT,
                'value_vat'=>$request->Value_VAT,
                'total'=>$request->Total,
                'status'=>'غير مدفوعة',
                'value_status'=>2,
                'note'=>$request->note,
                'user'=>Auth::user()->name

            ]);
            $invoice=Invoice::latest()->first();
            $invoice_id=$invoice->id;
           $invoice_number=$invoice->invoice_number;
            $product_id=$invoice->product_id;
            $section_id=$invoice->section_id;
            $product=Product::where('id',$product_id)->first();
            $section=Section::where('id',$section_id)->first();
            Invoice_detail::create(
                [
                    'invoice_id'=>$invoice_id,
                    'invoice_number'=>$invoice_number,
                    'product'=>$product->name,
                    'section'=>$section->section_name,
                    'status'=>'غير مدفوعة',
                    'value_status'=>2,
                    'notes'=>$request->note,
                    'created_by'=>Auth::user()->name
                ]
            );

            $attachment=$request->file('file_name');
            $attachment_ext=$attachment->getClientOriginalExtension();
            $name=$attachment->getClientOriginalName();
            $name=explode('.',$name);
           array_pop($name);
           $name=join($name);
            $attachment_name="$name".$invoice_id.".$attachment_ext";
            $attachment->move(public_path('attachments/'.$invoice_number),$attachment_name);
            Invoice_attachment::create([
               'file_name'=>$attachment_name,
                'invoice_id'=>$invoice_id,
                'invoice_number'=>$invoice_number,
                'created_by'=>Auth::user()->name
            ]);

          return redirect()->route('invoices.index')->with('msg',"تم اضافة الفاتورة بنجاح");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice=Invoice::findorfail($id);
        $sections=Section::all();
        return view('invoices.status_edit',compact('sections','invoice'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice=Invoice::findorfail($id);
        $sections=Section::all();
        return view('invoices.edit',compact('sections','invoice'));

    }

    /**,
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoice=Invoice::findorfail($id);
        $invoice->update([
            'invoice_number'=>$request->invoice_number,
            'invoice_data'=>$request->invoice_Date,
            'due_data'=>$request->Due_date,
            'section_id'=>$request->Section,
            'product_id'=>$request->product,
            'amount_collection'=>$request->Amount_collection,
            'amount_commission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'rate_vat'=>$request->Rate_VAT,
            'total'=>$request->Total,
            'value_vat'=>$request->Value_VAT,
            'note'=>$request->note
        ]);
        return redirect()->route('invoices.index')->with('update',"تم التعديل بنجاح");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $invoice=Invoice::findorfail($id);
        $invoice->delete();
        return redirect()->back()->with('softdelete',"تم حذف الفاتورة وتم اضافتها فى الارشيف ");
    }
    public function get_product($id){

        $products = DB::table("products")->where("section_id", $id)->pluck("name", "id");
        return json_encode($products);
    }
    public function update_status($id,Request $request){
       $invoice=Invoice::findorfail($id);
        if($request->status==1){
           $invoice->update([
               'value_status'=>$request->status,
               'status'=>"مدفوع"
           ]);
           Invoice_detail::create(
               [
                   'invoice_number'=>$request->invoice_number,
                 'invoice_id'=>$request->invoice_id,

                   'section'=>$request->section,
                   'product'=>$request->product,
                   'notes'=>$request->note,
                   'created_by'=>Auth::user()->name,
                   'value_status'=>$request->status,
                   'status'=>"مدفوع",
                   'payment_data'=>$request->payment_data


               ]
           );
       }
        if($request->status==3)  {
            $invoice->update([
                'value_status'=>$request->status,
                'status'=>" مدفوع جزئيا"
            ]);
            Invoice_detail::create(
                [
                    'invoice_number'=>$request->invoice_number,
                    'invoice_id'=>$request->invoice_id,

                    'section'=>$request->section,
                    'product'=>$request->product,
                    'notes'=>$request->note,
                    'created_by'=>Auth::user()->name,
                    'value_status'=>$request->status,
                    'status'=>" مدفوع جزئيا",
                    'payment_data'=>$request->payment_data


                ]
            );

        }
        return redirect()->route('invoices.index')->with('edit_status','تم تعديل الحالة بنجاح');
    }
    public function export()
    {
        return Excel::download(new InvoicesExport, 'Invoices.xlsx');
    }
}
