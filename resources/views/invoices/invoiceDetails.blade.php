@extends('layouts.master')
@section('css')
{{-- <!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet"> --}}
@endsection
@section('title')
invoiceDetails
@stop
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<!-- <h4 class="content-title mb-0 my-auto">Pages</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Empty</span> -->
						</div>
					</div>
					{{-- <div class="d-flex my-xl-auto right-content">
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
					</div> --}}
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
                   <div class="col-xl-12">
                     <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">.invoice info</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">payments</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">attachment</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">invoice no</th>
                                                            <td>{{ $invoice->invoice_no }}</td>
                                                            <th scope="row">invoice date</th>
                                                            <td>{{ $invoice->invoice_date }}</td>
                                                            <th scope="row">due date</th>
                                                            <td>{{ $invoice->due_date }}</td>
                                                            <th scope="row">Section</th>
                                                            <td>{{ $invoice->section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">product</th>
                                                            <td>{{ $invoice->product->product_name}}</td>
                                                            <th scope="row">collection_amount</th>
                                                            <td>{{ $invoice->collection_amount  }}</td>
                                                            <th scope="row">commission_amount</th>
                                                            <td>{{ $invoice->commission_amount }}</td>
                                                            <th scope="row">discount</th>
                                                            <td>{{ $invoice->discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row">rate_vat</th>
                                                            <td>{{ $invoice->rate_vat }}</td>
                                                            <th scope="row">value_vat</th>
                                                            <td>{{ $invoice->value_vat }}</td>
                                                            <th scope="row">total</th>
                                                            <td>{{ $invoice->total }}</td>
                                                            <th scope="row">value_status</th>

                                                            @if ($invoice->value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoice->status }}</span>
                                                                </td>
                                                            @elseif($invoice->value_status ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoice->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoice->status }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">notes</th>
                                                            <td>{{ $invoice->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>invoice_no</th>
                                                            <th>product</th>
                                                            <th>section</th>
                                                            <th>Status</th>
                                                            <th>payment date</th>
                                                            <th>notes</th>
                                                            <th>created_at</th>
                                                            <th>user</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($invoiceDetails as $detail)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $detail->invoice_no }}</td>
                                                                <td>{{ $invoice->product->product_name }}</td>
                                                                <td>{{ $invoice->Section->section_name }}</td>
                                                                @if ($detail->value_status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $detail->status }}</span>
                                                                    </td>
                                                                @elseif($detail->value_status ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $detail->status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $detail->status }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $detail->payment_date }}</td>
                                                                <td>{{ $detail->note }}</td>
                                                                <td>{{ $detail->created_at }}</td>
                                                                <td>{{ $detail->user }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">
                                            <!--attachment-->
                                            <div class="card card-statistics">
                                                {{-- @can('اضافة مرفق') --}}
                                                @include("layouts.error")
                                                @include("layouts.success")
                                                    <div class="card-body">
                                                        <p class="text-danger">attachment format  pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">add attachment</h5>
                                                        <form method="post" action="{{ url('add_attachment') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_no"
                                                                    value="{{ $invoice->invoice_no }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoice->id }}">
                                                                <label class="custom-file-label" for="customFile">select attachment</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm">confirm</button>
                                                        </form>
                                                    </div>
                                                {{-- @endcan --}}
                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">file name</th>
                                                                <th scope="col">created by</th>
                                                                <th scope="col">created at</th>
                                                                <th scope="col">actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($invoiceAttachment as $attachment)
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $attachment->file_name }}</td>
                                                                    <td>{{ $attachment->user }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('View_file') }}/{{ $attachment->file_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            show</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('download') }}/{{ $invoice->invoice_no}}/{{ $attachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            download</a>

                                                                        {{-- @can('حذف المرفق')
                                                                        @endcan --}}
                                                                            <button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $attachment->file_name }}"
                                                                                data-invoice_number="{{ $attachment->invoice_number }}"
                                                                                data-id_file="{{ $attachment->id }}"
                                                                                data-target="#delete_file">delete</button>

                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
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
                   </div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
{{-- <!--Internal  Datepicker js -->
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
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script> --}}
@endsection