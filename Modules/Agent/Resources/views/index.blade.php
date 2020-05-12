@extends('agent::layouts.master')

@push('style')
<style>
    .not-completed {
        text-decoration: line-through;
    }
</style>
@endpush

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('agent:js/index.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Agents {!! $franchise ? 'in <i><strong>'. $franchise->name .'</strong></i>' : '' !!}
@endsection

@section('breadcrumb')
    @if($franchise)
        @can('view_franchise', $franchise)
            <li><a href="{{url('franchise/view/' . $franchise->id)}}"><i class="fa fa-sitemap"></i> Franchise - {{$franchise->name}}</a></li>
        @else
            <li><i class="fa fa-sitemap"></i> Franchise - {{$franchise->name}}</li>
        @endif
    @endif
    <li class="active"><i class="fa fa-sitemap"></i> Manage Agents</li>
@endsection

@section('top_right_corner_button_group')
    @can('create_agent', Modules\Agent\Entities\Agent::class)
        <a href="{{url('agent/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Agent"><i class="fa fa-plus"></i> Create New Agent</a>
    @endcan
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <table id="tbl_agents" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Country</th>
                    <th>Zone</th>
                    <th>Contact Number</th>
                    <th class="center">Email</th>
                    <th class="center">Enabled</th>
                    <th class="center">Approved</th>
                    <th class="center"></th>
                </tr>
                </thead>
                <tbody>
                @if($agents->count() && $i=1)
                    @foreach($agents as $agent)
                        <tr class="{{$agent->completed ? 'completed' : 'not-completed'}}">
                            <td>
                                @can('view_agent', $agent)
                                    <a href="{{url('agent/view/' . $agent->id)}}">{{$agent->name}}</a>
                                @else
                                    {{$agent->name}}
                                @endcan
                            </td>
                            <td>{{$agent->contact_person}}</td>
                            <td>{{$agent->main_country->name}}</td>
                            <td>{{$agent->zone ? $agent->zone->name : ''}}</td>
                            <td class="center">{{$agent->phone_number}}</td>
                            <td class="center">{{$agent->email}}</td>
                            <td class="center">
                                <span class="hidden">{{$agent->active}}</span>
                                @can('activate_agent', \Modules\Agent\Entities\Agent::class)
                                    <span class="onoffswitch">
                                <input enable_agent type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" {{($agent->active ? 'checked' : '')}} id="user-{{$agent->id}}">
                                <label class="onoffswitch-label" for="user-{{$agent->id}}">
                                    <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                    <span class="onoffswitch-switch"></span>
                                </label>
                            </span>
                                @else
                                    <i class="fa fa-{{$agent->active ? 'check' : 'times'}} text-{{$agent->active ? 'success' : 'danger'}}"></i>
                                @endcan
                            </td>
                            <td class="center">
                                <span class="hidden">{{$agent->approved}}</span>
                                <i class="fa fa-{{$agent->approved ? 'check' : 'times'}} text-{{$agent->approved ? 'success' : 'danger'}}"></i>
                            </td>
                            <td class="center">
                                <div class="btn-group btn-group-sm" role="group">
                                    @can('edit_agent', \Modules\Agent\Entities\Agent::class)
                                        <a href="{{url('agent/edit/' . $agent->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> </a>
                                    @endcan
                                    @can('delete_agent', \Modules\Agent\Entities\Agent::class)
                                        <a href="{{url('agent/delete/' . $agent->id)}}" class="btn btn-danger delete_agent"><i class="fa fa-trash"></i> </a>
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
