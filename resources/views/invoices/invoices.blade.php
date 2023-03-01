@extends('layouts.master')
@section('css')
    <!-- Internal Data table css -->
    <link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection


@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span>
            </div>
        </div>
        <div class="d-flex my-xl-auto right-content">


        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    @if(\Illuminate\Support\Facades\Session::has('msg'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{session()->get('msg')}}</strong>
                        </div>
                    @endif
                        @if(\Illuminate\Support\Facades\Session::has('update'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{session()->get('update')}}</strong>
                            </div>
                        @endif
                        @if(\Illuminate\Support\Facades\Session::has('softdelete'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{session()->get('softdelete')}}</strong>
                            </div>
                        @endif

                        @if(\Illuminate\Support\Facades\Session::has('edit_status'))
                            <div class="alert alert-success" role="alert">
                                <strong>{{session()->get('edit_status')}}</strong>
                            </div>
                        @endif
                    <div class="d-flex justify-content-between">

                        <a class="btn btn-primary" href="{{route('invoices.create')}}" role="button">اضافة فاتورة</a>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                        <a class="btn btn-primary" href="{{route('export')}}" role="button">تصدير الفواتير </a>
                        <i class="mdi mdi-dots-horizontal text-gray"></i>
                    </div>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example1">
                            <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">رقم الفاتورة</th>
                                <th class="wd-20p border-bottom-0">تاريخ الفاتورة</th>
                                <th class="wd-15p border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="wd-10p border-bottom-0">المنتج</th>
                                <th class="wd-25p border-bottom-0">القسم</th>
                                <th class="wd-10p border-bottom-0">الخصم</th>
                                <th class="wd-25p border-bottom-0">نسبة الضريبة</th>
                                <th class="wd-10p border-bottom-0">قيمة الضريبة</th>
                                <th class="wd-25p border-bottom-0">الجمالي</th>
                                <th class="wd-10p border-bottom-0">حالة الفاتورة</th>
                                <th class="wd-10p border-bottom-0">ملاحظات</th>
                                <th class="wd-10p border-bottom-0">عمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            static $count=1
                            @endphp
                                @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{$count}} @php $count+=1 @endphp</td>
                                        <td>{{$invoice->invoice_number}}</td>
                                        <td>{{$invoice->invoice_data}}</td>
                                        <td>{{$invoice->due_data}}</td>
                                        <td>{{$invoice->product->name}}</td>

                                        <td><a href="{{route('detail.show',$invoice->id)}}"> {{$invoice->section->section_name}}</a></td>
                                        <td>{{$invoice->discount}}</td>
                                        <td>{{$invoice->rate_vat}}</td>
                                        <td>{{$invoice->value_vat}}</td>
                                        <td>{{$invoice->total}}</td>
                                        <td>
                                            @if($invoice->value_status==1)
                                                <span class="text-success">{{$invoice->status}}</span>
                                            @elseif ($invoice->value_status==2)
                                                <span class="text-danger">{{$invoice->status}}</span>
                                            @else
                                                <span class="text-warning">{{$invoice->status}}</span>
                                            @endif
                                        </td>
                                        <td>{{$invoice->note}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
                                                        data-toggle="dropdown" id="dropdownMenuButton" type="button">عمليات <i class="fas fa-caret-down ml-1"></i></button>
                                                <div  class="dropdown-menu tx-13">
                                                    <a  class="btn btn-outline-info btn-sm"href="{{route('invoices.edit',$invoice->id)}}">تعديل</a>
                                            <form action="{{route('invoices.destroy',$invoice->id)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input type="submit"  class="btn btn-outline-danger btn-sm" value="حذف">

                                            </form>

                                                        <a  class="btn btn-outline-info btn-sm"href="{{route('invoices.show',$invoice->id)}}">تغير الحالة</a>

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
        <!--/div-->



    </div>
    <!-- /row -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->



        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection


@section('js')
    <!-- Internal Data tables -->
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
    <!--Internal  Datatable js -->
    <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
