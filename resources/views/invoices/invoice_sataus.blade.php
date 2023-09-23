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
@section('title')
    Invoice status
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
             <div class="d-flex">
                <!-- <h4 class="content-title mb-0 my-auto">invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/add
                    invoice</span> -->
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('layouts.success')
    @include('layouts.error')
    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action='{{ url("invoice_status/$invoice->id") }}' method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}
                        @method('PUT')
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">invoices no</label>
                                <input type="hidden" name="id" value="{{ $invoice->id }}">
                                <input type="text" class="form-control" id="inputName" name="invoice_no"
                                    value="{{ $invoice->invoice_no }}" required readonly>
                            </div>

                            <div class="col">
                                <label>inv date</label>
                                <input class="form-control" name="invoice_date" type="text" value="{{ date('Y-m-d') }}"
                                    required readonly>
                            </div>

                            <div class="col">
                                <label>due_date</label>
                                <input class="form-control" name="due_date" type="text" required
                                    value="{{ $invoice->due_date }}" readonly>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">section</label>
                                <input type="hidden" name="section_id" value="{{ $invoice->section->id }}">
                                <input type="text" class="form-control" id="section_name" name="section_name"
                                    value="{{ $invoice->section->section_name }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">product</label>
                                <input type="hidden" name="product_id" value="{{ $invoice->product->id }}">
                                <input type="text" class="form-control" id="product_name" name="product_name"
                                    value="{{ $invoice->product->product_name }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">collection amount</label>
                                <input type="text" class="form-control" id="collection_amount" name="collection_amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->collection_amount }}" readonly>
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">Commission Amount</label>
                                <input type="text" class="form-control form-control-lg" id="commission_amount"
                                    name="commission_amount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required value="{{ $invoice->commission_amount }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Discount</label>
                                <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{ $invoice->discount }}" required readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Rate_VAT</label>
                                <input type="text" class="form-control" id="rate_vat" name="rate_vat"
                                    value="{{ $invoice->rate_vat }}" required readonly>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">Value_VAT</label>
                                <input type="text" class="form-control" id="value_vat" name="value_vat"
                                    value="{{ $invoice->value_vat }}" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">Total</label>
                                <input type="text" class="form-control" id="total" name="total"
                                    value="{{ $invoice->total }}" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">Notes</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{ $invoice->note }}</textarea>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">payment status</label>
                                <select class="form-control" id="value_status" name="value_status" required>
                                    <option selected="true" disabled="disabled">select payment status</option>
                                    <option value="3">paid</option>
                                    <option value="2">partial paid</option>
                                </select>
                            </div>

                            <div class="col">
                                <label>payment date</label>
                                <input class="form-control fc-datepicker" name="payment_date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>


                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">confirm</button>
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

    <script>
        $(document).ready(function() {
            $('select[name="section_id"]').on('change', function() {
                var Section_Id = $(this).val();
                console.log(Section_Id);
                if (Section_Id) {
                    $.ajax({
                        url: "{{ URL::to('getproduct') }}/" + Section_Id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('select[name="product_id"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product_id"]').append(
                                    '<option value="' +
                                    key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>

    <script>
        function myFunction() {
            var commission_amount = parseFloat(document.getElementById("commission_amount").value);
            var Discount = parseFloat(document.getElementById("discount").value);
            var Rate_VAT = parseFloat(document.getElementById("rate_vat").value);
            var Value_VAT = parseFloat(document.getElementById("value_vat").value);
            var Amount_Commission2 = commission_amount - Discount;
            if (typeof commission_amount === 'undefined' || !commission_amount) {
                alert('please inter commission_amount');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2); // decimal
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("value_vat").value = sumq;
                document.getElementById("total").value = sumt;
            }
        }
    </script>


@endsection
