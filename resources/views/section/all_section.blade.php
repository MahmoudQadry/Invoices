@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
<link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('title')
sections
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">setup</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                sections</span>
        </div>
    </div>
    <!-- <div class="d-flex my-xl-auto right-content">
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
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                        id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate"
                        data-x-placement="bottom-end">
                        <a class="dropdown-item" href="#">2015</a>
                        <a class="dropdown-item" href="#">2016</a>
                        <a class="dropdown-item" href="#">2017</a>
                        <a class="dropdown-item" href="#">2018</a>
                    </div>
                </div>
            </div>
        </div> -->
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    @can("add_section")
                    <a class="modal-effect btn btn-outline-primary" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">add section</a>
                    @endcan
                    <i class="mdi mdi-dots-horizontal text-gray"></i>
                </div>
            </div>
            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @include('layouts.error')
            @include('layouts.success')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">section name</th>
                                <th class="wd-20p border-bottom-0">description</th>
                                <th class="wd-15p border-bottom-0">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($sections) --}}
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($sections as $section)
                            @php
                            $i += 1;
                            @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $section->section_name }}</td>
                                <td>{{ $section->desc }}</td>
                                <td>
                                    <a class="modal-effect btn btn-sm  btn-info" data-section_name="{{ $section->section_name }}" data-id="{{ $section->id }}" data-desc="{{ $section->desc }}" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo9">update</a>
                                    <a class="modal-effect btn btn-sm  btn-danger" data-section_name="{{ $section->section_name }}" data-id="{{ $section->id }}" data-effect="effect-slide-in-right" data-toggle="modal" href="#modaldemo10">remove</a>
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
<!-- row closed -->
<!-- Modal effects -->
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modal Header</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">Section name</label>
                        <input type="text" name="section_name" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    {{-- @error('section_name')
                            {{ $message }}
                    @enderror --}}
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <input type="text" name="desc" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    {{-- @error('desc')
                            {{ $message }}
                    @enderror --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary" type="button">submit</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal effects-->
{{-- edit modal --}}
<div class="modal" id="modaldemo9">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modal Header</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('section.update','test') }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="" class="form-label">Section name</label>
                        <input type="text" name="section_name" id="section_name" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    {{-- @error('section_name')
                            {{ $message }}
                    @enderror --}}
                    <div class="mb-3">
                        <label for="" class="form-label">Description</label>
                        <input type="text" name="desc" id="desc" class="form-control" placeholder="" aria-describedby="helpId" required>
                    </div>
                    {{-- @error('desc')
                            {{ $message }}
                    @enderror --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary" type="button">submit</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="modaldemo10">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">Modal Header</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('section.destroy','test') }}" method="post" autocomplete="off">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="" class="form-label">are you sure for delete</label>
                        <label for="" id="section_name" class="form-label"></label>
                    </div>
                    {{-- @error('section_name')
                            {{ $message }}
                    @enderror --}}
                    {{-- <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <input type="text" name="desc" id="desc" class="form-control" placeholder=""
                                aria-describedby="helpId" required>
                        </div> --}}
                    {{-- @error('desc')
                            {{ $message }}
                    @enderror --}}
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn ripple btn-primary" type="button">submit</button>
                    <button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>
<script>
    $("#modaldemo9").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var section_name = button.data('section_name');
        var desc = button.data('desc');
        var modal = $(this);
        modal.find(".modal-body #section_name").val(section_name);
        modal.find(".modal-body #desc").val(desc);
        modal.find(".modal-body #id").val(id);
    });
    $("#modaldemo10").on("show.bs.modal", function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var section_name = button.data('section_name');
        // var desc = button.data('desc');
        var modal = $(this);
        modal.find(".modal-body #section_name")[0].innerHTML = section_name;
        // modal.find(".modal-body #desc").val(desc);
        modal.find(".modal-body #id").val(id);
    })
</script>
@endsection