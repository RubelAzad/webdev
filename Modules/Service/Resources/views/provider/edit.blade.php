@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/provider-form.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Edit Service Provider - {{$provider->name}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Service Providers</a></li>
    <li class="active"> Edit Service Provider - {{$provider->name}}</li>
@endsection


@section('content')
    @include('service::provider.form', ['provider' => $provider])
@stop
