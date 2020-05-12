@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/provider-form.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Create Service Provider
@endsection

@section('breadcrumb')
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Service Providers</a></li>
    <li class="active"> Create New Service Provider</li>
@endsection


@section('content')
    @include('service::provider.form', ['provider' => ''])
@stop
