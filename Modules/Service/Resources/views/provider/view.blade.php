@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
@endpush

@push('scripts')
{{--<script type="application/javascript" src="{{url(Module::asset('service:js/index.js'))}}"></script>--}}
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Service Provider - {{$provider->name}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('service/provider')}}"><i class="fa fa-cogs"></i> Service Providers</a></li>
    <li class="active"> {{$provider->name}}</li>
@endsection

@section('top_right_corner_button_group')
    @can('add_new_service', \Modules\Service\Entities\Service::class)
        <a href="{{url('service/create/' . $provider->id)}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Service"><i class="fa fa-plus"></i> Create New Service</a>
    @endcan
@endsection

@section('content')
    <table id="tbl_services" class="table table-bordered" style="width: 100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price/kg</th>
            <th>Base Price</th>
            <th>Minimum Weight</th>
            <th>Speed</th>
            <th>Source Country</th>
            <th>Destination Country</th>
            <th class="center">Activated</th>
            <th class="center">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($services = $provider->services)
            @foreach($services as $service)
                <tr>
                    <td>{{$service->name}}</td>
                    <td>{{get_service_price($service->price, $service->commission, $agent)}}</td>
                    <td>{{get_service_price($service->base_price, $service->commission, $agent)}}</td>
                    <td>{{$service->minimum_weight}}</td>
                    <td>{{$service->speed}}</td>
                    <td>{{get_country_name($service->src_country)}}</td>
                    <td>{{get_country_name($service->dst_country)}}</td>
                    <td class="center">
                        @if($service->active)
                            <i class="fa fa-check text-success"></i>
                        @else
                            <i class="fa fa-times text-danger"></i>
                        @endif
                    </td>
                    <td class="center">
                        <div class="btn-group" role="group">
                            @can('edit_service', \Modules\Service\Entities\Service::class)
                                <a href="{{url('service/edit/' . $service->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('delete_service', \Modules\Service\Entities\Service::class)
                                <a href="{{url('service/delete/' . $service->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                            @endcan
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
@stop
