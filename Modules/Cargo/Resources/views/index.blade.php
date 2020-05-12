@extends('cargo::layouts.master')

@push('style')

@endpush


@push('scripts')

<script>
    $(function () {
        $('#tbl_post').dataTable({
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
    <i class="fa fa-archive"></i> Shipments
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-archive"></i> Management Shipments</li>
@endsection

@section('top_right_corner_button_group')
    @can('create_shipment', Modules\Cargo\Entities\CargoPost::class)
        <a href="{{url('cargo/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Shipment"><i class="fa fa-plus"></i> Create New Shipment</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_post" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th class="center">Select</th>
                    <th class="center">Tracking No</th>
                    <th class="center">Date</th>
                    <th class="center">Status</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th class="center">Pieces</th>
                    <th class="center">Weight</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($posts->count() && $i = 1)
                    @foreach($posts->sortByDesc('id') as $post)
                        <tr>
                            <td class="center" width="50px"></td>
                            <td class="center">{{strtoupper($post->tracking_no)}}</td>
                            <td class="center">{{$post->created_at->format('d/m/Y')}}</td>
                            <td class="center">{{$post->status_id ? $post->current_status->name : ''}}</td>
                            <td>{{$post->sender->name}}</td>
                            <td>{{$post->receiver ? $post->receiver->name : ''}}</td>
                            <td class="center">{{$post->packages->count()}}</td>
                            <td class="center">{{number_format(get_total_weight($post->packages), 2)}} kg</td>
                            <th class="center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{url('post/view/' . $post->tracking_no)}}" class="btn btn-info"><i class="fa fa-search"></i></a>
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
