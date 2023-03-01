<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestInvoice extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'invoice_number'=>'required|unique:invoices',
           // 'invoice_date'=>'required|date',
            //'due_date'=>'required|date',
          //  'file_name'=> 'mimes:jpg,pdf,jpeg,png'
        ];
    }
    public function messages(){
        return [
            'invoice_number.required'=>'لم يتم ادخال رقم الفاتورة من فضلك ادخله',
            'invoice_number.unique'=>'رقم الفاتورة موجود مسابقا',
            //'invoice_date.required'=>'يرجي ادخال التاريخ الفاتورة',
            // 'invoice_date.date' =>'هذا الحقل يقبل تاريخ فقط',
            //'due_date.required'=>'يرجي ادخال التاريخ استحقاق الفاتورة',
            //'due_date.date' =>'هذا الحقل يقبل تاريخ فقط',
            //'file_name.mimes'=>"only ext jpg,pdf,jpeg,png "
        ];

    }
}
