@extends('service::layouts.master')

@push('style')
{{--<link rel="stylesheet" href="{{url(Module::asset('service:css/create.css'))}}">--}}
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('service:js/providers.js'))}}"></script>

@endpush

@section('page_header')
    <i class="fa fa-cogs"></i> Service Providers
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-cog"></i> Manage Service Provider</li>
@endsection

@section('top_right_corner_button_group')
    @can('add_new_service_provider', \Modules\Service\Entities\ServiceProvider::class)
        <a href="{{url('service/create-provider')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Service Provider"><i class="fa fa-plus"></i> Create New Service Provider</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_providers" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th class="center">SN</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th class="center">Activated</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($providers->count() && $i=1)
                    @foreach($providers as $provider)
                        <tr>
                            <td class="center">{{$i++}}</td>
                            <td>
                                @can('view_service_provider', \Modules\Service\Entities\ServiceProvider::class)
                                    <a href="{{url('service/provider/' . $provider->id)}}">{{$provider->name}}</a>
                                @else
                                    {{$provider->name}}
                                @endcan
                            </td>
                            <td>{{$provider->description}}</td>
                            <td class="center">
                                @if($provider->active)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-times text-danger"></i>
                                @endif
                            </td>
                            <td class="center">
                                <div class="btn-group" role="group">
                                    @can('edit_service_provider', \Modules\Service\Entities\ServiceProvider::class)
                                        <a href="{{url('service/edit-provider/' . $provider->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    @endcan
                                    @can('delete_service_provider', \Modules\Service\Entities\ServiceProvider::class)
                                        <a href="{{url('service/delete-provider/' . $provider->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i></a>
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
