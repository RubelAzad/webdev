@extends('cargo::layouts.master')

@push('style')
<style>
    .not-completed {
        text-decoration: line-through;
    }
</style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('franchise:js/index.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Franchises
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-sitemap"></i> Manage Franchises</li>
@endsection

@section('top_right_corner_button_group')
    @can('create_franchise', Modules\Franchise\Entities\Franchise::class)
        <a href="{{url('franchise/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Franchise"><i class="fa fa-plus"></i> Create New Franchise</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_franchises" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th class="center">SN</th>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Area</th>
                    <th>Contact Number</th>
                    <th class="center">Email</th>
                    <th class="center">Agents</th>
                    <th class="center">Enabled</th>
                    <th class="center">Approved</th>
                    <th class="center">Actions</th>
                </tr>
                </thead>
                <tbody>
                @if($franchises->count() && $i=1)
                    @foreach($franchises as $franchise)
                        <tr class="{{$franchise->completed ? 'completed' : 'not-completed'}}">
                            <td class="center">{{$i++}}</td>
                            <td>
                                @can('view_franchise', \Modules\Franchise\Entities\Franchise::class)
                                    <a href="{{url('franchise/view/' . $franchise->id)}}">{{$franchise->name}}</a>
                                @else
                                    {{$franchise->name}}
                                @endcan
                            </td>
                            <td>{{$franchise->contact_person}}</td>
                            <td>{{$franchise->area}}</td>
                            <td class="center">{{$franchise->phone_number}}</td>
                            <td class="center">{{$franchise->email}}</td>
                            <td class="center"><a href="{{url('franchise/view/' . $franchise->id . '#tab-agents')}}">{{$franchise->agents->count()}}</a></td>
                            <td class="center">
                                <span class="hidden">{{$franchise->active}}</span>
                                @can('activate_franchise', \Modules\Franchise\Entities\Franchise::class)
                                    <span class="onoffswitch">
                                <input enable_franchise type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" {{($franchise->active ? 'checked' : '')}} id="user-{{$franchise->id}}">
                                <label class="onoffswitch-label" for="user-{{$franchise->id}}">
                                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </span>
                                @else
                                    <i class="fa fa-{{$franchise->active ? 'check' : 'times'}} text-{{$franchise->active ? 'success' : 'danger'}}"></i>
                                @endcan
                            </td>
                            <td class="center">
                                <span class="hidden">{{$franchise->approved}}</span>
                                <i class="fa fa-{{$franchise->approved ? 'check' : 'times'}} text-{{$franchise->approved ? 'success' : 'danger'}}"></i>
                            </td>
                            <td class="center">
                                <div class="btn-group btn-group-sm" role="group">
                                    @can('edit_franchise', \Modules\Franchise\Entities\Franchise::class)
                                        <a href="{{url('franchise/edit/' . $franchise->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> </a>
                                    @endcan
                                    @can('delete_franchise', \Modules\Franchise\Entities\Franchise::class)
                                        <a href="{{url('franchise/delete/' . $franchise->id)}}" class="btn btn-danger delete"><i class="fa fa-trash"></i> </a>
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
