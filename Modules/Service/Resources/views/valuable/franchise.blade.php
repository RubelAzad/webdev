@extends('service::layouts.master')

@push('scripts')
    <script>
        $(function () {
            $('#tbl_valuables').dataTable({
                responsive:true,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'All' ]
                ],
                dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                buttons: [
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4,5,6,7 ]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4,5,6,7 ]
                        }
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4,5,6,7 ]
                        },
                        messageTop: 'Product List'
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4,5,6,7 ]
                        }
                    },
                    {
                        extend: 'colvis',
                        columns: ':not(.noVis)',
                        postfixButtons: ['colvisRestore'],
                    }
                ]
            });
        });
    </script>
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
                        <th>Destination Country</th>
                        <th class="center">Shipment Price</th>
                        <th class="center">Commission</th>
                        <th class="center">Max Shipment Price</th>
                        <th class="center">Max Cover Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($valuables as $valuable)
                        @php
                            $commission = ($valuable->price * $valuable->commission) / 100;
                            $ho_price = $valuable->price - $commission;
                        @endphp
                        <tr>
                            <td>{{$valuable->name}}</td>
                            <td>{{get_country_name($valuable->dst_country)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($valuable->price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($commission, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($valuable->max_price, 2)}}</td>
                            <td class="center">{{get_currency_symbol($valuable->src_country) . number_format($valuable->purchase_price, 2)}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
