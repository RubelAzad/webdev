@extends('shipment::layouts.master')

@push('style')
    <link rel="stylesheet" href="{{url(Module::asset('shipment:css/form-mawb.css'))}}">
@endpush

@push('scripts')
    <script src="{{url(Module::asset('shipment:js/form-mawb.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-plane"></i> Create Master Air Way Bill
@endsection

@section('breadcrumb')
    <li>Create Master Air Way Bill</li>
@endsection

@section('top_right_corner_button_group')
    <a href="{{url('shipment/create-mawb')}}" class="btn btn-primary">New MAWB</a>
@endsection

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Create New Master Air Way Bill</h3></div>
            <div class="panel-body">
                @include('shipment::mawb.form', ['mawb' => ''])
            </div>
            <div class="panel-footer center">
                <button id="btn_save_mawb" class="btn btn-primary"><i class="fa fa-save" aria-hidden="true"></i> Save Change</button>
            </div>
        </div>
    </div>

@stop
