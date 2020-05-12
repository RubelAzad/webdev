@extends('back-end.layouts.app')

@push('style')
    <link rel="stylesheet" href="{{url('assets/user/css/user.css')}}">
    <link rel="stylesheet" href="{{url('doc_viewer/css/style.css')}}">
@endpush

@push('scripts')
    <script src="{{url('doc_viewer/libs/yepnope.1.5.3-min.js')}}"></script>
    <script src="{{url('doc_viewer/src/ttw-document-viewer.js')}}"></script>
    <script src="{{url('doc_viewer/src/ttw-invisible-dom.js')}}"></script>

    <script type="application/javascript" src="{{url('assets/user/js/user.js')}}"></script>
    <script>
        var user_id = '{{$user->id}}';
    </script>
@endpush

@section('page_header')
    <i class="fa fa-user"></i> User Profile - {{$user->name}}
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-users"></i>
        <a href="{{url('/users')}}">Users</a>
    </li>
    <li class="active">{{$user->name}}</li>
@endsection

@section('top_right_corner_button_group')
    @can('edit_user', \App\User::class)
        <a href="{{url('user/edit/'.$user->id)}}" class="btn btn-default"><i class="fa fa-edit fa-lg"></i> Edit User Profile</a>
    @endcan
    @can('login_as', $user)
        <a href="{{url('login_as/'.$user->id)}}" class="btn btn-default"><i class="fa fa-power-off fa-lg"></i> Login As {{$user->name}}</a>
    @endcan
    @can('override_user_abilities', $user)
        <a href="{{url('role/override/'.$user->id)}}" class="btn btn-default"><i class="fa fa-lock fa-lg"></i> Permission Override</a>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">

            <div class="panel panel-default rounded shadow">
                <div class="panel-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-center">
                                <img id="profile_pic" class="img-circle img-bordered-primary" src="{{ ($user->pic ? url($user->pic) : Gravatar::get($user->email))  }}" alt="{{$user->name}}" width="250px">
                            </li>
                            <li class="text-center">
                                <h4 class="text-capitalize">{{$user->name}}</h4>
                                <p class="text-muted text-capitalize">{{$user->roleAll()->implode(', ')}}</p>
                            </li>
                            @can('change_profile_pic', $user)
                                <li>
                                    <a href="{{url('user/change-profile-pic/'. $user->id)}}" class="btn btn-success text-center btn-block">Change Profile Picture</a>
                                </li>
                            @endcan
                        </ul>
                    </div>
                </div>
            </div><!-- /.panel -->

            <div class="panel panel-default panel-theme rounded shadow">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact</h3>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> {{$user->email}}</li>
                        <li class="list-group-item"><i class="fa fa-phone mr-5"></i> {{$user->phone_number}}</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div>

        <div class="col-lg-9 col-md-9 col-sm-8">
            <div id="profile_content" class="panel panel-default panel-tab rounded shadow">
                <!-- Start tabs heading -->
                <div class="panel-heading no-padding-top no-padding-left no-padding--right">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tc_personal" data-toggle="tab" aria-expanded="true">
                                <i class="fa fa-user"></i>
                                <span>Personal</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#tc_address" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-home"></i>
                                <span>Addresses</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#tc_employment" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-briefcase"></i>
                                <span>Employments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#tc_documents" data-toggle="tab" aria-expanded="false">
                                <i class="fa fa-file"></i>
                                <span>Documents</span>
                            </a>
                        </li>
                        @can('change_user_password', $user)
                            <li>
                                <a href="#tc_password" data-toggle="tab" aria-expanded="false">
                                    <i class="fa fa-key"></i>
                                    <span>Password</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div><!-- /.panel-heading -->
                <!--/ End tabs heading -->

                <!-- Start tabs content -->
                <div class="panel-body no-padding">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tc_personal">
                            {{--@include('user.profile.personal')--}}
                        </div>
                        <div class="tab-pane fade" id="tc_address">
                            {{--                        @include('user.profile.address')--}}
                        </div>
                        <div class="tab-pane fade" id="tc_employment">
                            {{--                        @include('user.profile.employment')--}}
                        </div>
                        <div class="tab-pane fade" id="tc_documents">
                            {{--@include('user.profile.documents')--}}
                        </div>
                        @can('change_user_password', $user)
                            <div class="tab-pane fade" id="tc_password">
                                @include('back-end.user.profile.password')
                            </div>
                        @endcan
                    </div>
                </div><!-- /.panel-body -->
                <!--/ End tabs content -->
            </div>
        </div>
    </div>
@endsection