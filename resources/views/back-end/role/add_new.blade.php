@extends('back-end.layouts.app')

@section('breadcrumb')
    <li><a href="{{url('roles')}}">Roles</a></li>
    @if(isset($role))
        <li class="active">Edit role</li>
    @else
        <li class="active">Create New Role</li>
    @endif
@endsection

@section('page_header')
    @if(isset($role))
       Edit role
    @else
        Create New Role
    @endif
@endsection

@section('content')

    <div class="panel rounded shadow no-overflow">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">{{isset($role) ? 'Edit role' : 'Create New Role'}}</h3>
            </div>
            <div class="pull-right">
                {{--<button class="btn btn-sm" data-action="refresh" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Refresh"><i class="fa fa-refresh"></i></button>--}}
                {{--<button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse"><i class="fa fa-angle-up"></i></button>--}}
                {{--<button class="btn btn-sm" data-action="remove" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Remove"><i class="fa fa-times"></i></button>--}}
            </div>
            <div class="clearfix"></div>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Start repeater -->
            <form class="form-horizontal" role="form" method="post" action="{{url('role/edit')}}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="col-md-4 control-label" for="role_name">Role Name*</label>
                    <div class="col-md-6">
                        <input type="text" id="role_name" required="required" name="name" class="form-control" value="{{ isset($role) ? $role->name :''}}">
                    </div>
                </div>
                @if( ! isset($role))
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="based_on">Based On</label>
                        <div class="col-md-6">
                            <select id="based_on" name="based_on" class="form-control">
                                <option value=""></option>
                                @foreach($roles as $rol)
                                    @if($rol->id != 1)
                                        <option value="{{$rol->id}}">{{$rol->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <input type="hidden" name="id" value="{{isset($role) ? $role->id : 0}}">
                <div class="col-md-6 col-md-offset-4">
                    <button class="btn btn-inverse btn-lg pull-right">Save Change</button>
                </div>
            </form>
            <!--/ End repeater -->
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
    <!--/ End repeater -->

@endsection