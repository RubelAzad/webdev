@extends('cargo::layouts.master')

@push('style')

@endpush

@push('scripts')
{{--<script type="application/javascript" src="{{url(Module::asset('event:js/calendar.js'))}}"></script>--}}
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
    <i class="fa fa-archive"></i> Drafts
@endsection

@section('breadcrumb')
    <li><a href="{{url('cargo')}}"><i class="fa fa-archive"></i> Management Shipments</a></li>
    <li class="active">Drafts</li>
@endsection

@section('top_right_corner_button_group')
    @can('create_shipment', Modules\Cargo\Entities\CargoPost::class)
        <a href="{{url('cargo/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Shipment"><i class="fa fa-plus"></i> Create New Shipment</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_valuables" class="table table-bordered">
                <thead>
                <tr>
                    <th class="center">SN</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th class="center">Created At</th>
                    <th class="center"></th>
                </tr>
                </thead>
                <tbody>
                @if($drafts->count() && $i = 1)
                    @foreach($drafts as $draft)
                        <tr>
                            <td class="center">{{$i++}}</td>
                            <td>{{$draft->sender->name}}</td>
                            <td>{{$draft->receiver ? $draft->receiver->name : ''}}</td>
                            <td class="center">{{$draft->created_at->format('d/m/Y')}}</td>
                            <th class="center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{url('cargo/create/' . $draft->id)}}" class="btn btn-info"><i class="fa fa-search"></i></a>
                                    <a href="{{url('cargo/delete-draft/' . $draft->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </div>
                            </th>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
