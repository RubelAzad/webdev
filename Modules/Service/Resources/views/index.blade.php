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
<style>
        input[type=radio] + .details{
            display: none;
        }

        input[type=radio]:checked + .fordebit {
            display: block;
        }

        input[type=radio]:checked + .forcredit {
            display: inline-block;
        }
        input[type=radio]:checked + .forcard {
            display: block;
        }
        input[type=radio] {
            float:left;
            margin-top: 6px;
            margin-right: 10px;
        }
        .float-left {
            display: inline-block;
        }
    </style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/services.js'))}}"></script>


    <script type="text/javascript">

        var i = 0;

        $("#add").click(function(){

            ++i;

            $("#dynamicTable").append('<tr><td><input type="text" name="addmore['+i+'][name]" placeholder="Minimun Kg" class="form-control" /></td><td><input type="text" name="addmore['+i+'][qty]" placeholder="Maximun Kg" class="form-control" /></td><td><input type="text" name="addmore['+i+'][price]" placeholder="Charge" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){
            $(this).parents('tr').remove();
        });

    </script>
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
                    <th class="center">HO Base Price</th>
                    <th class="center">HO Price/kg</th>
                    <th class="center">Base Price</th>
                    <th class="center">Price/kg</th>
                    <th class="center">Commission on Base</th>
                    <th class="center">Commission/KG</th>
                    <th class="center">Weight Range</th>
                    <th class="center">Speed</th>
                    <th>Source Country</th>
                    <th>Destination Country</th>
                    <th class="center">Activated</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th class="center"></th>
                    <th>Source Country</th>
                    <th>Destination Country</th>
                    <th class="center"></th>
                    <th class="center"></th>
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
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format($service->base_price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format($service->price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . get_service_price($service->base_price, $service->commission, $agent)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . get_service_price($service->price, $service->commission, $agent)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format(get_agent_commission_on_weight($service->base_price, $service->commission), 2)}}</td>
                            <td class="center">{{get_currency_symbol($service->src_country) . number_format(get_agent_commission_on_weight($service->price, $service->commission), 2)}}</td>
                            <td class="center">{{$service->minimum_weight}} - {{$service->maximum_weight}}</td>
                            <td class="center">{{$service->speed}}</td>
                            <td>{{get_country_name($service->src_country)}}</td>
                            <td>{{get_country_name($service->dst_country)}}</td>
                            <td class="center">
                                @if($service->active)
                                    <span class="text-success">Yes</span>
                                @else
                                    <span class="text-danger">No</span>
                                @endif
                            </td>
                            <td class="center">
                                <div class="btn-group" role="group">
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
