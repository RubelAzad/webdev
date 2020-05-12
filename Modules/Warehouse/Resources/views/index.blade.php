@extends('warehouse::layouts.master')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('warehouse:js/index.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Warehouses
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-archive"></i> Management Warehouses</li>
@endsection

@section('top_right_corner_button_group')
    @can('create_warehouse', \Modules\Warehouse\Entities\Warehouse::class)
        <a href="{{url('warehouse/add')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Warehouse</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_warehouse" class="table table-hover table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th class="center">Name</th>
                    <th class="center">Address</th>
                    <th class="center">City</th>
                    <th class="center">County</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($houses->count())
                    @foreach($houses as $house)
                        <tr>
                            <td>
                                @can('view_warehouse', \Modules\Warehouse\Entities\Warehouse::class)
                                    <a href="{{url('warehouse/show/'. $house->id)}}">{{$house->name}}</a>
                                @else
                                    {{$house->name}}
                                @endcan
                            </td>
                            <td>{{$house->add_line_1}}</td>
                            <td class="center">{{$house->city}}</td>
                            <td class="center">{{get_country_name_iso_3166_2($house->country_code)}}</td>
                            <td class="center">
                                <div class="btn-group" role="group">
                                    @can('edit_warehouse', \Modules\Warehouse\Entities\Warehouse::class)
                                        <a href="{{url('warehouse/edit/' . $house->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    @endcan

                                    @can('delete_warehouse', \Modules\Warehouse\Entities\Warehouse::class)
                                            <a href="{{url('warehouse/delete/' . $house->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
                                    @endcan
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
