@extends('service::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url(Module::asset('service:css/form.css'))}}">
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/service-form.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Create New Service {{$country ? 'for '.$country->name : ''}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('service')}}"><i class="fa fa-cogs"></i> Services</a></li>
    <li class="active"><i class="fa fa-cog"></i> Create New Service</li>
@endsection


@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            @include('service::form', ['service' => '', 'provider' => $provider])
        </div>
    </div>
@stop`
