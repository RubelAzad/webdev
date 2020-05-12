@extends('location::layouts.master')

@push('scripts')
<script src="{{url(Module::asset('location:js/zone/index.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Zones {!! $country ? 'in <i><strong>'. $country->name .'</strong></i>' : '' !!}
@endsection

@section('breadcrumb')
    {{--@if($franchise)--}}
        {{--<li><a href="{{url('franchise/view/' . $franchise->id)}}"><i class="fa fa-sitemap"></i> {{$franchise->name}}</a></li>--}}
    {{--@endif--}}
    {{--<li class="active"><i class="fa fa-sitemap"></i> Manage Agents</li>--}}
@endsection

@section('top_right_corner_button_group')
    @can('add_new_zone', \Modules\Location\Entities\Zone::class)
        <a href="{{url('zone/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Agent"><i class="fa fa-plus"></i> Create New Zone</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_zones" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Country</th>
                    <th>Drop off</th>
                    <th>Pickup</th>
                    <th>Collection</th>
                    <th>Delivery</th>
                    <th class="center">Number of Agent</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($zones as $zone)
                    <tr>
                        <td>
                            @can('view_zone', \Modules\Location\Entities\Zone::class)
                                <a href="{{url('zone/' . $zone->id)}}">{{$zone->name}}</a>
                            @else
                                {{$zone->name}}
                            @endcan
                        </td>
                        <td>{{$zone->country->name}}</td>
                        <td>{{number_format($zone->receive, 2)}}</td>
                        <td>{{number_format($zone->pickup, 2)}}</td>
                        <td>{{number_format($zone->collection, 2)}}</td>
                        <td>{{number_format($zone->delivery, 2)}}</td>
                        <td class="center">{{$zone->agents ? $zone->agents->count() : 0}}</td>
                        <td class="center">
                            <div class="btn-group" role="group">
                                @can('edit_zone', \Modules\Location\Entities\Zone::class)
                                    <a href="{{url('zone/edit/' . $zone->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> </a>
                                @endcan
                                @can('delete_zone', \Modules\Location\Entities\Zone::class)
                                    <a href="{{url('zone/delete/' . $zone->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i> </a>
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