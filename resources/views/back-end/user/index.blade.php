@extends('back-end.layouts.app')

@push('style')

@endpush

@push('scripts')
    <script type="application/javascript" src="{{url('assets/user/js/user.js')}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-users"></i> Users
@endsection

@section('breadcrumb')
    <li class="active">Users</li>
@endsection

@section('top_right_corner_button_group')
    @can('add_new_user', \App\User::class)
        <a href="{{url('user/add-new')}}" class="btn btn-primary" rel="tooltip" data-placement="top" data-title="Add New User"><i class="fa fa-user-plus"></i> Add New User</a>
    @endcan
@endsection

@section('content')
<div class="panel panel-default">
    <div class="panel-body">
        <table id="users" class="table table-striped table-bordered table-hover responsive nowrap" width="100%" cellspacing="0">
            <thead>
            <tr>
                {{--<th class="text-center" data-hide="phone" width="10px">SN</th>--}}
                <th>Name</th>
                <th>Email Address</th>
                <th class="center">Role</th>
                <th class="center">Verified</th>
                <th class="center">Enabled</th>
                <th class="center">Actions</th>
                <th class="center">Last Login</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                @if($user->id != 1 )
                    <tr>
                        {{--<td class="text-center">{{$i++}}</td>--}}
                        <td><a href="{{url('user/view/'.$user->id)}}">{{$user->name}}</a></td>
                        <td><a href="{{url('user/view/'.$user->id)}}">{{$user->email}}</a></td>
                        <td class="text-center">{{$user->roleAll()->implode(', ')}}</td>
                        <td class="text-center">
                            @if($user->verified)
                                <span class="text-success"><i class=" fa fa-check"></i> </span>
                            @else
                                <span class="text-danger"><i class=" fa fa-times"></i></span>
                            @endif
                        </td>
                        <td class="text-center">
                            @can('change_user_status', \App\User::class)
                                <input type="checkbox" class="change_user_status" {{($user->active ? 'checked' : '')}} id="user-{{$user->id}}">
                            @else
                                @if($user->active)
                                    <span class="text-success"><i class=" fa fa-check"></i> </span>
                                @else
                                    <span class="text-danger"><i class=" fa fa-times"></i></span>
                                @endif
                            @endcan
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                @can('edit_user', \App\User::class)
                                    <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i> </a>
                                @endcan
                                @can('delete_user', \App\User::class)
                                    <a href="{{url('user/delete/'.$user->id)}}" class="btn btn-danger delete_user"><i class="fa fa-trash"></i></a>
                                @endcan
                                @can('login_as', $user)
                                    <a href="{{url('login_as/'.$user->id)}}" class="btn btn-success"><i class="fa fa-user-secret"></i></a>
                                @endcan
                            </div>
                        </td>
                        <td class="text-center">{{ $user->last_login ? $user->last_login->format('d/m/Y H:i:s') : 'Never'}}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection