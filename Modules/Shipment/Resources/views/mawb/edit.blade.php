@extends('shipment::layouts.master')

@section('page_header')
    <i class="fa fa-plane"></i> Edit House Air Way Bill
@endsection

@section('breadcrumb')
    <li>Edit House Air Way Bill</li>
@endsection

@section('top_right_corner_button_group')
    <a href="{{url('shipment/create-hawb')}}" class="btn btn-primary">New HAWB</a>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body">
            @include('shipment::hawb.form', ['hawb' => $hawb])
        </div>
    </div>

@stop
