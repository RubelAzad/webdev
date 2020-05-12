@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
<style>
    thead input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
</style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/franchise.js'))}}"></script>
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
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_services" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Provider</th>
                    <th class="center">Per kg</th>
                    <th class="center">Commission</th>
                    <th class="center">Base Price</th>
                    <th class="center">Commission</th>
                    <th class="center">Weight Range</th>
                    <th class="center">Speed</th>
                    <th>Destination Country</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th>Destination Country</th>
                </tr>
                </tfoot>
                <tbody>
                @if($services->count() && $i=1)
                    @foreach($services as $service)
                        <tr>
                            <td>{{$service->name}}</td>
                            <td>
                                @can('view_service_provider', \Modules\Service\Entities\ServiceProvider::class)
                                    <a href="{{url('service/provider/' . $service->provider->id)}}">{{$service->provider->name}}</a>
                                @else
                                    {{$service->provider->name}}
                                @endcan
                            </td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format(get_service_price($service->price, $service->commission, $agent),2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format(get_service_price($service->price, $service->commission, $agent) - $service->price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format(get_service_price($service->base_price, $service->commission, $agent), 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format(get_service_price($service->base_price, $service->commission, $agent) - $service->base_price, 2)}}</td>
                            <td class="center">{{$service->minimum_weight}} - {{$service->maximum_weight}}</td>
                            <td class="center">{{$service->speed}}</td>
                            <td>{{get_country_name($service->dst_country)}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
