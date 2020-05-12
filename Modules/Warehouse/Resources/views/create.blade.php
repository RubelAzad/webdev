@extends('warehouse::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('warehouse:js/form.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Create Warehouses
@endsection

@section('breadcrumb')
    <li><a href="{{url('warehouse')}}"> <i class="fa fa-archive"></i> Management Warehouses</a> </li>
    <li class="active"> Create Warehouses</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('warehouse::form',['house' => ''])
        </div>
        <div class="panel-footer center">
            <button id="btn_save_warehouse" class="btn btn-primary"><i class="fa fa-save"></i> Save Changes</button>
        </div>
    </div>
@stop
