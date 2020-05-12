@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/valuable/valuables.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Valuable Items
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-cog"></i> Manage Valuable Items</li>
@endsection

@section('top_right_corner_button_group')
    @can('add_new_valuable', \Modules\Service\Entities\ServiceValuable::class)
        <a href="{{url('service/create-valuable')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Service Valuable"><i class="fa fa-plus"></i> Add New Item</a>
    @endcan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-body">
                <table id="tbl_valuables" class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Source Country</th>
                        <th>Destination Country</th>
                        <th class="center">Ho Cost</th>
                        <th class="center">Commission</th>
                        <th class="center">Shipment Price</th>
                        <th class="center">Max Shipment Price</th>
                        <th class="center">Max Cover Amount</th>
                        <th class="center">Enabled</th>
                        <th class="center">Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Source Country</th>
                        <th>Destination Country</th>
                        <th colspan="7"></th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($valuables as $valuable)
                        @php
                        $commission = ($valuable->price * $valuable->commission) / 100;
                        $ho_price = $valuable->price - $commission;
                        @endphp
                        <tr>
                            <td>{{$valuable->name}}</td>
                            <td>{{get_country_name($valuable->src_country)}}</td>
                            <td>{{get_country_name($valuable->dst_country)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($ho_price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($commission, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($valuable->price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($valuable->max_price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($valuable->purchase_price, 2)}}</td>
                            <td class="center">
                                @if($valuable->active)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-times text-danger"></i>
                                @endif
                            </td>
                            <td class="center">
                                <div class="btn-group" role="group">
                                    @can('edit_valuable', \Modules\Service\Entities\ServiceValuable::class)
                                        <a href="{{url('service/edit-valuable/' . $valuable->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete_valuable', \Modules\Service\Entities\ServiceValuable::class)
                                        <a href="{{url('service/delete-valuable/' . $valuable->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
