@extends('back-end.layouts.app')

@push('style')
    <link href="{{url('assets/commercial/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css')}}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{url('assets/commercial/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js')}}"></script>
    <script src="{{url('assets/user/js/pro-pic.js')}}"></script>
@endpush

@section('page_header')
    <h2><i class="fa fa-user"></i>Profile Pictures- {{$user->name}}</h2>
@endsection

@section('breadcrumb')
    <li>
        <i class="fa fa-users"></i>
        <a href="{{url('/users')}}">Users</a>
        <i class="fa fa-angle-right"></i>
    </li>
    <li class="active">{{$user->name}}</li>
@endsection

@section('content')
    <div class="panel rounded shadow no-overflow">
        <div class="panel-heading">
            <div class="pull-left">
                <h3 class="panel-title">Profile Pictures</h3>
            </div>
            <div class="pull-right">

            </div>
            <div class="clearfix"></div>
        </div><!-- /.panel-heading -->
        <div class="panel-body">
            <!-- Start repeater -->
        @can('change_profile_pic', $user)
            {!! Form::open(['url' => 'user/change-profile-pic', 'files' => true, 'class' => 'form-inline']) !!}
                {!! Form::hidden('user_id', $user->id) !!}
                <div class="form-body">
                    <div class="form-group">
                        {!! Form::label('file', 'Select a file', []) !!}
                        {!! Form::file('file', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Upload', ['class' => 'btn btn-inverse']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
        @endcan
            <!--/ End repeater -->
        </div><!-- /.panel-body -->
    </div><!-- /.panel -->
    <!--/ End repeater -->
    <div class="body-content animated fadeIn">

        <div id="js-grid-masonry" class="cbp">

            @foreach($user->pics  as $pic)
            <div class="cbp-item">
                <a class="cbp-caption cbp-lightbox" data-title="Uploaded: {{$pic->created_at->format('d/m/Y')}}" href="{{url('/file/serve/' . $pic->actual_file->hash)}}">
                    <div class="cbp-caption-defaultWrap">
                        <img src="{{url('/file/serve/' . $pic->actual_file->hash)}}" alt="Profile Picture">
                    </div>
                    <div class="cbp-caption-activeWrap">
                        <div class="cbp-l-caption-alignCenter">
                            <div class="cbp-l-caption-body">
                                <div class="cbp-l-caption-title">Uploaded: {{$pic->created_at->format('d/m/Y')}}</div>
                                {{--<div class="cbp-l-caption-desc">by John Kribo</div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="btn-group btn-group-sm" role="group">
                        <a href="{{url('user/delete-profile-pic/'.$pic->id)}}" class="btn btn-danger delete-pic"><i class="fa fa-trash"></i></a>
                        <a href="{{url('user/select-profile-pic/'.$pic->id)}}" class="btn btn-primary">Select</a>
                    </div>
                </a>
            </div>
            @endforeach

        </div>
    </div>
@endsection