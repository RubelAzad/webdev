@extends('back-end.layouts.app')

@push('scripts')
<script src="{{url('magic/js/plugin/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script src="{{url('assets/role/js/assign.js')}}"></script>
@endpush

@push('style')

@endpush

@section('breadcrumb')
    <li><a href="{{url('role/all')}}">All Role</a></li>
    <li class="active">Assign Role</li>
@endsection

@section('page_header')
    Assign Users To "{{$role->name}}" Role
@endsection
@section('content')
    <input type="hidden" id="role_name" value="{{$role->name}}">

    <article class="col-xs-12">
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-user" data-widget-sortable="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header>
                <h2><strong>Assign role to users</strong></h2>

                <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
            </header>

            <!-- widget div-->
            <div role="content">

                <!-- widget content -->
                <div class="widget-body no-padding">

                    <form action="{{url('role/assign')}}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <!-- #section:plugins/input.duallist -->
                                    <select multiple="multiple" size="10" name="user_list[]" id="duallist">
                                        @foreach($users as $user){
                                        @if($user->id != 1)
                                            @if(isset($assigned[$user->id]))
                                                <option value="{{$user->id}}" selected="selected">{{$user->name}}</option>
                                            @else
                                                <option value="{{$user->id}}">{{$user->name}}</option>
                                            @endif
                                        @endif
                                        @endforeach
                                    </select>
                                    <!-- /section:plugins/input.duallist -->
                                    <div class="hr hr-16 hr-dotted"></div>
                                </div>
                            </div>
                            <input type="hidden" name="role_id" id="role_id" value="{{$role->id}}">
                        </fieldset>
                        <br>
                        <div class="row">
                            <div class="col-sm-4 col-sm-offset-4">
                                <div class="well well-sm bg-color-teal txt-color-white">
                                    <table id="user_info" class="table table-bordered">

                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="widget-footer">
                            @if($role->id == 1)
                                @if(Auth::User()->role_id == 1)
                                    <button class="btn btn-lg btn-block btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Change</button>
                                @endif
                            @else
                                @can('make_change_on_roll_assignment', \App\Role::class)
                                    <button class="btn btn-primary btn-lg btn-block"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Change</button>
                                @endcan
                            @endif
                        </div>
                    </form>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
    </article>

@endsection