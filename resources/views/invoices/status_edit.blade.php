
@extends('layouts.master')
@section('css')
<!--- Internal Select2 css-->
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
<!---Internal Fancy uploader css-->
<link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
<!--Internal Sumoselect css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
<!--Internal  TelephoneInput css-->
<link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection


@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    اضافة فاتورة</span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')


<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('update_status',$invoice->id) }}" method="post" enctype="multipart/form-data"

                      autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">رقم الفاتورة</label>
                            <input type="text" class="form-control" id="inputName" name="invoice_number"
                                  readonly required value="{{$invoice->invoice_number}}">
                            @error('invoice_number')
                            <small class="form-text text-muted" style="color:red !important">{{$message}}</small>
                            @enderror

                            <input type="hidden" class="form-control" id="inputName" name="invoice_id"
                                   readonly required value="{{$invoice->id}}">
                        </div>

                        <div class="col">
                            <label>تاريخ الفاتورة</label>
                            <input class="form-control" name="invoice_Date"
                                  type="text" value="{{$invoice->invoice_data}}" readonly  required>
                            @error('invoice_date')
                            <small class="form-text text-muted" style="color:red !important">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="col">
                            <label>تاريخ الاستحقاق</label>
                            <input class="form-control" name="Due_date"
                                  type="text" required value="{{$invoice->due_data}}"  readonly>
                            @error('due_date')
                            <small class="form-text text-muted" style="color:red !important">{{$message}}</small>
                            @enderror
                        </div>

                    </div>

                    {{-- 2 --}}
                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">القسم</label>
                            <input type="text" class="form-control" id="inputName" name="section"
                                   readonly required value="{{$invoice->section->section_name}}">




                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">المنتج</label>
                            <input type="text" class="form-control" id="inputName" name="product"
                                   readonly required value="{{$invoice-> product->name}}">



                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">مبلغ التحصيل</label>
                            <input type="text" class="form-control" id="inputName" value="{{$invoice->amount_collection}}" name="Amount_collection"
                          readonly         oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        </div>
                    </div>


                    {{-- 3 --}}

                    <div class="row">

                        <div class="col">
                            <label for="inputName" class="control-label">مبلغ العمولة</label>
                            <input type="text" class="form-control form-control-lg" id="Amount_Commission"
                                   name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                              readonly     required value="{{$invoice->amount_commission}}">
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الخصم</label>
                            <input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                   title="يرجي ادخال مبلغ الخصم "
                                readonly   oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                   value={{$invoice->discount}} required>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                            <select name="Rate_VAT" id="Rate_VAT" class="form-control" onchange="myFunction()">
                                <!--placeholder-->
                                <option readonly value="{{$invoice->rate_vat}}" selected>{{$invoice->rate_vat}}</option>

                            </select>
                        </div>

                    </div>

                    {{-- 4 --}}

                    <div class="row">
                        <div class="col">
                            <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                            <input type="text"  class="form-control" id="Value_VAT" name="Value_VAT"  value="{{$invoice->value_vat}}" readonly>
                        </div>

                        <div class="col">
                            <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                            <input type="text" class="form-control" id="Total" name="Total" value="{{$invoice->total}}"  readonly>
                        </div>
                    </div>

                    {{-- 5 --}}
                    <div class="row">
                        <div class="col">
                            <label for="exampleTextarea">ملاحظات</label>
                            <input type="text" class="form-control" id="exampleTextarea" name="note" readonly rows="3" value="{{$invoice->note}}" >
                        </div>
                    </div><br>
<div class="row">
    <div class="col">
        <label for="inputName" class="control-label">حالة الدفع</label>
        <select id="product" name="status" class="form-control">
            <option  value="1"   >مدفوعة</option>
            <option  value="3"   >مدفوعة جزنيا</option>
        </select>
    </div>
    <div class="col">
        <label>تاريخ الدفع</label>
        <input class="form-control fc-datepicker" name="payment_data" placeholder="YYYY-MM-DD"
               type="text" required>
        @error('due_date')
        <small class="form-text text-muted" style="color:red !important">{{$message}}</small>
        @enderror
    </div>
</div>


                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary">تعديل الحالة</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

</div>

<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
<!--Internal Fancy uploader js-->
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
<!--Internal  Form-elements js-->
<script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
<script src="{{ URL::asset('assets/js/select2.js') }}"></script>
<!--Internal Sumoselect js-->
<script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!--Internal  jquery.maskedinput js -->
<script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
<!-- Internal form-elements js -->
<script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

<script>
    var date = $('.fc-datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    }).val();
</script>






@endsection


