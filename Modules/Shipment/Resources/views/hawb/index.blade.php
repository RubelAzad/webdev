@extends('shipment::layouts.master')

@push('scripts')
    <script>
        $(function () {
            $('#tbl_hawb').dataTable({
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
    </script>
@endpush

@section('page_header')
    <i class="fa fa-plane"></i> House Air Way Bill
@endsection

@section('breadcrumb')
    <li>House Air Way Bill</li>
@endsection

@section('top_right_corner_button_group')
    <button id="btn_create_new_hawb" class="btn btn-primary">Create New HAWB</button>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_hawb" class="table table-bordered table-hover" style="width: 100%">
                <thead>
                <tr>
                    <th class="center">HAWB No</th>
                    <th class="center">MAWB No</th>
                    <th class="center">Allowed Weight</th>
                    <th class="center">Given Weight</th>
                    <th class="center">Number of Packages</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($hawbs->sortByDesc('id') as $hawb)
                    <tr>
                        <td class="center">{{$hawb->id}}</td>
                        <td class="center">{{$hawb->mawb_id}}</td>
                        <td class="center">{{$hawb->max_weight}}</td>
                        <td class="center">{{get_total_weight_in_hawb($hawb->id)}}</td>
                        <td class="center">{{get_number_of_packages_in_hawb($hawb->id)}}</td>
                        <td class="center">
                            <div class="btn-group" role="group">
                                @can('view_hawb', $hawb)
                                    <a href="{{url('shipment/hawb/' . $hawb->id)}}" class="btn btn-info"><i class="fa fa-search"></i></a>
                                @endcan
                                @can('edit_hawb', $hawb)
                                    <button data-id="{{$hawb->id}}" class="btn btn-warning edit"><i class="fa fa-edit"></i></button>
                                @endcan
                                @can('delete_hawb', $hawb)
                                    <a href="{{url('shipment/delete-hawb/' . $hawb->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
