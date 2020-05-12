@extends('cargo::layouts.master')

@push('style')

@endpush

@push('scripts')
{{--<script type="application/javascript" src="{{url(Module::asset('event:js/calendar.js'))}}"></script>--}}
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Import
@endsection

@section('breadcrumb')
    <li><a href="{{url('cargo')}}"><i class="fa fa-archive"></i> Management Shipments</a></li>
    <li class="active">Import</li>
@endsection

@section('top_right_corner_button_group')
    {{--@can('create_shipment', Modules\Cargo\Entities\CargoPost::class)--}}
        {{--<a href="{{url('cargo/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Shipment"><i class="fa fa-plus"></i> Create New Shipment</a>--}}
    {{--@endcan--}}
@endsection

@section('content')

@stop
