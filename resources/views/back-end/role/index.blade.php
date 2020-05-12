@extends('back-end.layouts.app')

@push('scripts')
    <script src="{{url('assets/role/js/role.js')}}"></script>
@endpush

@section('breadcrumb')
    <li class="active">Roles</li>
@endsection

@section('page_header')
    <i class="fa fa-cogs"></i> Roles
@endsection

@section('top_right_corner_button_group')
    @can('add_new_role', \App\Role::class)
        <a href="{{url('role/add-new')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Add new role</a>
    @endcan
@endsection

@section('content')

    <article class="col-xs-12">
        <div class="jarviswidget jarviswidget-sortable" id="wid-id-user" data-widget-sortable="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header>
                <h2><strong>Role List</strong></h2>

                <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span>
            </header>

            <!-- widget div-->
            <div role="content">

                <!-- widget content -->
                <div class="widget-body no-padding">

                    <table id="tbl_roles" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">SN</th>
                            <th>Role Name</th>
                            <th class="text-center">Enabled</th>
                            <th class="text-center">Actions</th>
                            <th class="text-center">Has Users</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($roles->count() && $i = 1)
                            @foreach($roles as $role)
                                <tr>
                                    <td style="text-align: center">{{$i++}}</td>
                                    <td>{{$role->name}}</td>
                                    <td class="text-center">
                                        @if($role->active)
                                            <span class="text-success"><i class=" fa fa-check"></i> </span>
                                        @else
                                            <span class="text-danger"><i class=" fa fa-times"></i></span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if( $role->id != 1)
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-warning btn-xs dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-cog"></i>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        @can('update_role_status', $role)
                                                            <a href="{{url('role/change-status/'.$role->id)}}" class="role_status">Change Status</a>
                                                        @endcan
                                                    </li>
                                                    <li>
                                                        @can('edit_role', $role)
                                                            <a href="{{url('role/edit/'.$role->id)}}">Edit</a>
                                                        @endcan
                                                    </li>
                                                    <li>
                                                        @can('delete_role', $role)
                                                            <a href="{{url('role/delete/'.$role->id)}}" class="role_delete">Delete</a>
                                                        @endcan
                                                    </li>
                                                    <li>
                                                        @can('view_role_definition', $role)
                                                            <a href="{{url('role/definition/'.$role->id)}}">Definition</a>
                                                        @endcan
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @can('view_current_role_assignment', $role)
                                            <a href="{{url('role/assign/' . $role->id)}}" class="btn btn-info btn-sm" title="Role assignment">{{$role->id == 1 ? count($role->users)-1 : count($role->users)}}</a>
                                        @else
                                            <a class="btn btn-info btn-sm" title="Role assignment">{{$role->id == 1 ? count($role->users)-1 : count($role->users)}}</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
    </article>
@endsection