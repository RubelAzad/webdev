@extends('warehouse::layouts.master')

@push('style')
@endpush

@push('scripts')
    {{--<script type="application/javascript" src="{{url(Module::asset('warehouse:js/show.js'))}}"></script>--}}
    <script>
        $(function () {
            $('#tbl_warehouse').dataTable({
                responsive:true,
                lengthMenu: [
                    [ 10, 25, 50, -1 ],
                    [ '10', '25', '50', 'All' ]
                ],
                dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
            });
        });

        $('.datepicker').datepicker();
    </script>

@endpush

@section('page_header')
    Pickup List
@endsection

@section('breadcrumb')
    <li>Pickup </li>
@endsection

@section('content')
<div class="">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Pending Pickup List</h3>
        </div>
        <div class="panel-body table-responsive">
            <table id="tbl_warehouse" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th class="center">SN</th>
                    <th class="center">Create Date</th>
                    <th>Warehouse</th>
                    <th>Driver</th>
                    <th>Agent</th>
                    <th class="center">Posts</th>
                    <th class="center">Estimated Pickup Date</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pickups as $pickup)
                    <tr>
                        <td class="center">{{$pickup->id}}</td>
                        <td class="center">{{$pickup->date->format('d/m/Y')}}</td>
                        <td>{{$pickup->warehouse->name}}</td>
                        <td>
                            @if($pickup->external_driver)
                                {{$pickup->ext_driver->name}}
                            @else
                                {{$pickup->driver->name}}
                            @endif
                        </td>
                        <td>{{$pickup->agent->name}}</td>
                        <td class="center">{{$pickup->posts->count()}}</td>
                        <td class="center">{{$pickup->est_pickup_date ? $pickup->est_pickup_date->format('d/m/Y') : ''}}</td>
                        <td class="center">
                            <a href="{{url('warehouse/pickup-list/' . $pickup->id)}}" class="btn btn-info">View Details</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
