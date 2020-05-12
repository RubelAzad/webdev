@extends('shipment::layouts.master')

@section('page_header')
    <i class="fa fa-ship"></i> Shipment
@endsection

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('shipment.name') !!}
    </p>
@stop
