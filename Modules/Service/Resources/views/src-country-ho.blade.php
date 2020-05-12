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
<script type="application/javascript" src="{{url(Module::asset('service:js/src-country-ho-services.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Price list for {{$country->name}}
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
        <a href="{{url('service/create-src-country/'. $country->iso_3166_3)}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Service"><i class="fa fa-plus"></i> Create New Service</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_services" class="table table-bordered" style="width: 100%">
                <thead>
                {{--<tr>--}}
                    {{--<td>Name</td>--}}
                    {{--<td>Destination Country</td>--}}
                    {{--<td>Provider</td>--}}
                    {{--<td>HO Base Price</td>--}}
                    {{--<td>HO Price/kg</td>--}}
                    {{--<td>Base Price</td>--}}
                    {{--<td>Price/kg</td>--}}
                    {{--<td>Weight Range</td>--}}
                    {{--<td>Speed</td>--}}
                    {{--<td class="center">Activated</td>--}}
                    {{--<td>Actions</td>--}}
                {{--</tr>--}}
                <tr>
                    <th>Name</th>
                    <th>Destination Country</th>
                    <th>Provider</th>
                    <th class="center">HO Base Price</th>
                    <th class="center">HO Price/kg</th>
                    <th class="center">Base Price</th>
                    <th class="center">Price/kg</th>
                    <th class="center">Weight Range</th>
                    <th class="center">Speed</th>
                    <th class="center">Activated</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($services->count() && $i=1)
                    @foreach($services as $service)
                        <tr>
                            <td>{{$service->name}}</td>
                            <td>{{get_country_name($service->dst_country)}}</td>
                            <td>
                                @can('view_service_provider', \Modules\Service\Entities\ServiceProvider::class)
                                    <a href="{{url('service/provider/' . $service->provider->id)}}">{{$service->provider->name}}</a>
                                @else
                                    {{$service->provider->name}}
                                @endcan
                            </td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format($service->base_price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format($service->price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . get_service_price($service->base_price, $service->commission, $agent)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . get_service_price($service->price, $service->commission, $agent)}}</td>
                            <td class="center">{{$service->minimum_weight}} - {{$service->maximum_weight}}</td>
                            <td class="center">{{$service->speed}}</td>
                            <td class="center">
                                @if($service->active)
                                    <span class="text-success">Yes</span>
                                @else
                                    <span class="text-danger">No</span>
                                @endif
                            </td>
                            <td class="center">
                                <button type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-cog"></i> <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    @can('edit_service', \Modules\Service\Entities\Service::class)
                                        <li><a href="{{url('service/edit/' . $service->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a></li>
                                    @endcan
                                    @can('delete_service', \Modules\Service\Entities\Service::class)
                                        <li><a href="{{url('service/delete/' . $service->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i> Delete</a></li>
                                    @endcan
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
