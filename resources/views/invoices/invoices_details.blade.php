

@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Elements</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Tabs</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
            </div>
            <div class="pr-1 mb-3 mb-xl-0">
                <button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
            </div>
            <div class="mb-3 mb-xl-0">
                <div class="btn-group dropdown">
                    <button type="button" class="btn btn-primary">14 Aug 2019</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">



        <!-- /div -->

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style3">
                <div class="card-body">

                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-3">
                                <div class="tab-menu-heading">
                                    <div class="tabs-menu ">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs">
                                            <li class=""><a href="#tab11" class="active" data-toggle="tab"><i class="fa fa-laptop"></i> معلومات الفاتورة</a></li>
                                            <li><a href="#tab12" data-toggle="tab"><i class="fa fa-cube"></i> حالات الفاتورة</a></li>
                                            <li><a href="#tab13" data-toggle="tab"><i class="fa fa-cogs"></i> مرفقات الفاتورة</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body">
                                    @if (session()->has('attach'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ session()->get('attach') }}</strong>

                                        </div>
                                    @endif
                                        @if (session()->has('delete'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>{{ session()->get('delete') }}</strong>

                                            </div>
                                        @endif
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab11">
                                            <table class="table text-md-nowrap" id="example1">

                                                <tr>
                                                    <td > رقم الفاتورة:</td>
                                                    <td>{{$invoices->invoice_number}}</td>
                                                    <td >تاريخ الاصدار:</td>
                                                    <td>{{$invoices->invoice_data}}</td>
                                                    <td >تاريخ الاستحقاق:</td>
                                                    <td>{{$invoices->due_data}}</td>
                                                    <td > القسم:</td>
                                                    <td>{{$invoices->section->section_name}}</td>
                                                </tr>
                                                  <tr>
                                                      <td > المنتج :</td>
                                                      <td>{{$invoices->product->name}}</td>
                                                    <td >مبلغ التحصيل :</td>
                                                    <td>{{$invoices->amount_collection}}</td>
                                                    <td >مبلغ العمولة :</td>
                                                    <td>{{$invoices->amount_commission}}</td>
                                                    <td >الخصم:</td>
                                                    <td>{{$invoices->discount}}</td>


                                                  </tr>

                                                <tr>
                                                    <td >نسبة الضريبة :</td>
                                                    <td>{{$invoices->rate_vat}}</td>
                                                    <td >قيمة الضريبة:</td>
                                                    <td>{{$invoices->value_vat}}</td>
                                                    <td >الجمالي:</td>
                                                    <td>{{$invoices->total}}</td>
                                                    <td >حالة الفاتورة:</td>
                                                    @if($invoices->value_status==1)
                                                       <td> <span class="text-success">{{$invoices->status}}</span></td>
                                                    @elseif ($invoices->value_status==2)
                                                        <td> <span class="text-danger">{{$invoices->status}}</span></td>

                                                    @else
                                                        <td>    <span class="text-warning">{{$invoices->status}}</span></td>

                                                    @endif
                                                </tr>




                                                <tr>


                                                    <td colspan="2"> متى إنشاؤها: </td>
                                                    <td colspan="2">{{$invoices->created_at}}</td>
                                                    <td colspan="2">اخر تعديل:</td>

                                                    <td colspan="2">{{$invoices->updated_at}}</td>
                                                    <td >ملاحظات:</td>
                                                  {{$invoices->notes}}

                                                    </tr>



                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab12">
                                            <table class="table text-md-nowrap" id="example1">
                                                <thead>
                                                <tr>
                                                    <th class="wd-10p border-bottom-0">رقم الفاتورة</th>
                                                    <th class="wd-25p border-bottom-0">نوع المنتج</th>
                                                    <th class="wd-25p border-bottom-0">القسم </th>
                                                    <th class="wd-25p border-bottom-0">الحالة</th>
                                                    <th class="wd-25p border-bottom-0">تاريخ الدفع</th>
                                                    <th class="wd-10p border-bottom-0" colspan="2">تم اصدارها</th>
                                                    <th class="wd-25p border-bottom-0">المستخدم</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                        @foreach($details as $detail)
                                                            <tr>

                                                                <td>{{$detail->invoice_number}}</td>
                                                                <td>{{$detail->product}}</td>
                                                                <td>{{$detail->section}}</td>
                                                                @if($detail->value_status==1)
                                                                    <td><span class="text-success">{{$detail->status}}</span></td>
                                                                @elseif($detail->value_status==2)
                                                                    <td><span class="text-danger">{{$detail->status}}</span></td>
                                                                @else
                                                                    <td><span class="text-warning">{{$detail->status}}</span></td>
                                                                @endif



                                                                <td>{{$detail->payment_data}}</td>
                                                                <td colspan="2">{{$detail->created_at}}</td>
                                                                <td>{{\Illuminate\Support\Facades\Auth::user()->name}}</td>
                                                            </tr>
                                                        @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane" id="tab13">
<form action="{{route('attach.store')}}"method="post" enctype="multipart/form-data">
    @csrf
    <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
    <h5 class="card-title">المرفقات</h5>

    <div class="col-sm-12 col-md-12">
        <input type="hidden" name="created_by" value="{{\Illuminate\Support\Facades\Auth::user()->name}}">
        <input type="hidden" name="invoice_number" value="{{$invoices->invoice_number}}">
        <input type="hidden" name="invoice_id" value="{{$invoices->id}}">
        <input type="file" name="file_name" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
               data-height="70" />
        @error('file_name')
        <small class="form-text text-muted" style="color:red !important">{{$message}}</small>
        @enderror
    </div>
    <div class="col-sm-12 col-md-12">
        <input type="submit" value="اضاقة مرفق" name="add" >
    </div>

</form>
                                            <table class="table text-md-nowrap" id="example1">
                                                <thead>
                                                <tr>
                                                    <th class="wd-10p border-bottom-0">اسم الملف</th>
                                                    <th class="wd-25p border-bottom-0">قام بالاضافة</th>
                                                    <th class="wd-10p border-bottom-0" colspan="2">تم اصدارها</th>
                                                    <th class="wd-10p border-bottom-0" colspan="2">اخر تحديث</th>
                                                    <th class="wd-10p border-bottom-0" colspan="2">عمليات</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($attachments as $attachment)
                                                    <tr>
                                                        <td>{{$attachment->file_name}}</td>
                                                        <td>{{$attachment->created_by}}</td>
                                                        <td colspan="2">{{$attachment->created_at}}</td>
                                                        <td colspan="2">{{$attachment->updated_at}}</td>
<td colspan="2">
    <div class="btn-group dropup">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            action
        </button>
        <div class="dropdown-menu">
            <a class="btn btn-outline-success btn-sm"
               href="{{ url('View_file') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
               role="button"><i class="fas fa-eye"></i>&nbsp;
                عرض</a><br>

            <a class="btn btn-outline-info btn-sm"
               href="{{ url('download') }}/{{ $invoices->invoice_number }}/{{ $attachment->file_name }}"
               role="button"><i
                    class="fas fa-download"></i>&nbsp;
                تحميل</a><br>

            <form action="{{route('detail.destroy',$attachment->id)}}" method="post">
                @method('delete')
                @csrf
                <button type="submit" name="delete" class="btn btn-outline-danger btn-sm" > <i
                        class="fa fa-trash"></i>حذف</button>

            </form>
        </div>
    </div>


</td>
                                                    </tr>
                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
        <!-- /div -->



    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
    <!-- Internal Select2 js-->
    <script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- Internal Input tags js-->
    <script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
    <!--- Tabs JS-->
    <script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
    <script src="{{URL::asset('assets/js/tabs.js')}}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
    <!-- Internal Prism js-->
    <script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
@endsection
