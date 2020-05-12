@extends('back-end.layouts.app')

@section('page_header')
    <i class="fa fa-user"></i> Edit User Account - {{$user->name}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('/users')}}">Users</a></li>
    <li class="active">{{$user->name}}</li>
@endsection

@section('content')

    <article class="col-xs-12">
        <div class="jarviswidget" id="wid-edit-user-account"
             data-widget-sortable="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header>
                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                <h2><strong>{{$user->name}}</strong></h2>
                <div class="widget-toolbar">

                </div>
            </header>

            <!-- widget div-->
            <div role="content">

                <!-- widget content -->
                <div class="widget-body">

                    <form id="frm_add_new_user" class="form-horizontal" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name*</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" required="required" value="{{$user->name}}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address*</label>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" class="form-control" required="required" value="{{$user->email}}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password*</label>
                            <div class="col-md-4">
                                <input type="password" id="password" name="password" class="form-control">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role_id" class="col-md-4 control-label">Role</label>
                            <div class="col-md-4">
                                <select id="role_id" name="role_id[]" class="form-control" multiple="multiple">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{$user->roles->contains($role) ? 'selected' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Login Activated</label>
                            <div class="col-md-4">
                                <span class="onoffswitch">
                                    <input type="checkbox" name="active" class="onoffswitch-checkbox" {{$user->active ? 'checked' :''}} id="active">
                                    <label class="onoffswitch-label" for="active">
                                        <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </span>
                            </div>
                        </div>

                        <input type="hidden" name="user_id" value="{{$user->id}}">

                        <div class="form-group">
                            <label class="col-md-4"></label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-round btn-primary" value="Save Changes">
                            </div>
                        </div>
                    </form>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
    </article>

@endsection