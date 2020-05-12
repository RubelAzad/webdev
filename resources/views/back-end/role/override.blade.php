@extends('back-end.layouts.app')

@push('scripts')
<script src="{{url('assets/role/js/override.js')}}"></script>
@endpush

@section('breadcrumb')
    <li><a href="{{url('user/view/' . $user->id)}}">Profile</a><i class="fa fa-angle-right"></i></li>
    <li class="active">Override Abilities for User</li>
@endsection

@section('page_header')
    <h2><i class="fa fa-lock"></i>Override Abilities</h2>
@endsection

@section('content')
    <div class="panel rounded shadow no-overflow">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">User: {{$user->name}} ( {{$user->roleAll()->implode(', ')}} )</h3>
            </div>
            <div class="pull-right">
                <div class="btn-group" role="group">
                    <button type="button" id="btn_see_all" class="btn btn-primary">Show All</button>
                    <button type="button" id="btn_see_overridden" class="btn ">Overridden</button>
                    <button type="button" id="btn_see_not_overridden" class="btn ">Not Overridden</button>
                </div>
            </div>
            <div class="clearfix"></div>
        </div><!-- /.panel-heading -->
        <div class="panel-body no-padding">
            <!-- Start repeater -->
            <form action="{{url('role/override')}}" method="post">
                {{ csrf_field() }}

                <table id="role_override" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Ability [Showing: <span id="what_to_show"></span> ]</th>
                        <th class="text-center">Override</th>
                        <th class="text-center">Allowed</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($abilities as $ability)
                        <tr class="{{(isset($assigned[$ability->ability]) ? 'overridden': 'not_overridden')}}">
                            <td>{{$ability->model}}:: {{$ability->title}}</td>
                            <td class="text-center">
                                <label>
                                    <input id="override" name="override-{{$ability->ability}}" class="ace ace-switch ace-switch-5" type="checkbox" {{(isset($assigned[$ability->ability]) ? 'checked': '')}} />
                                    <span class="lbl" data-toggle="tooltip" title="Click to change status"></span>
                                </label>
                            </td>
                            <td class="text-center">
                                <label>
                                    <input
                                            id="allowed"
                                            name="allowed-{{$ability->ability}}"
                                            class="ace ace-switch ace-switch-5"
                                            type="checkbox"
                                            {{(isset($assigned[$ability->ability]) ? ($assigned[$ability->ability]->allow ? 'checked': ''): '')}}
                                    />
                                    <span class="lbl" data-toggle="tooltip" title="Click to change status"></span>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="user_id" id="user_id" value="{{$user->id}}">
                <hr>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                        @can('override_user_abilities', $user)
                            <button class="btn btn-block btn-primary">Save Change</button>
                        @endcan
                    </div>
                </div>
            </form>
            <!--/ End repeater -->
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
    <!--/ End repeater -->
@endsection