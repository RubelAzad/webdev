@extends('back-end.layouts.app')

@section('breadcrumb')
    <li><i class="fa fa-users"></i> <a href="{{url('/users')}}">Users</a></li>
    <li class="active"><i class="fa fa-user-plus"></i> Add New User</li>
@endsection

@section('page_header')
    <i class="fa fa-user-plus"></i> Add New User
@endsection

@section('content')

    <article class="col-xs-12">
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-user" data-widget-sortable="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header>
                <h2><i class="fa fa-user-plus"></i> <strong>Add New User</strong></h2>

                <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
            </header>

            <!-- widget div-->
            <div role="content">

                <!-- widget content -->
                <div class="widget-body">

                    <form id="frm_add_new_user" class="form-horizontal" action="{{url('user/add-new')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name*</label>
                            <div class="col-md-6">
                                <input type="text" name="name" id="name" class="form-control" required="required" value="">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address*</label>
                            <div class="col-md-6">
                                <input type="email" name="email" id="email" class="form-control" required="required" value="">
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
                                <input type="password" id="password" name="password" class="form-control" required="required">
                                @if ($errors->has('password'))
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
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Login Activated</label>
                            <div class="col-md-4">
                                <span class="onoffswitch">
                                    <input type="checkbox" name="active" class="onoffswitch-checkbox" id="active">
                                    <label class="onoffswitch-label" for="active">
                                        <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Send Email to User</label>
                            <div class="col-md-6">
                                <span class="onoffswitch">
                                    <input type="checkbox" name="send_email" class="onoffswitch-checkbox" id="send_email">
                                    <label class="onoffswitch-label" for="send_email">
                                        <span class="onoffswitch-inner" data-swchon-text="YES" data-swchoff-text="NO"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4"></label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-round btn-primary" value="Create New User">
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