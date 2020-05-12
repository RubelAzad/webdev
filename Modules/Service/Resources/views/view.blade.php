@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/index.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Services
@endsection

@section('breadcrumb')
    @if($provider)
        <li><a href="{{url('service/provider/' . $provider->id)}}"><i class="fa fa-cogs"></i> {{$provider->name}}</a></li>
    @else
        <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Service Providers</a></li>
    @endif
    <li class="active"><i class="fa fa-cog"></i> Manage Services</li>
@endsection

@section('top_right_corner_button_group')
    @can('add_new_service', \Modules\Service\Entities\Service::class)
        <a href="{{url('service/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Service"><i class="fa fa-plus"></i> Create New Service</a>
    @endcan
@endsection

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('service.name') !!}
    </p>
@stop
