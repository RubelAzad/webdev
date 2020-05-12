@extends('nec.layouts.page')

@section('breadcrumb')
    <span>Track your parcel</span>
@endsection

@section('heading')
    {{strtoupper('Track your parcel')}}
@endsection

@section('second-heading')
    Find out where is your parcel now
@endsection

@section('content')
    <section id="home" data-target="home">

        <div class="section-area">
            <div class="container">
                <div class="title-section">
                    <h1>Track you parcel</h1>
                </div>
                <div class="well">
                    {!! Form::open(['url' => url('track'), 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('tracking_number', 'Enter Tracking Number', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-8">
                            {!! Form::text('tracking_number', '', ['class' => 'form-control', 'placeholder' => 'Enter Tracking Number', 'required' => 'required']) !!}
                        </div>
                        <div class="col-xs-1">
                            <button class="btn btn-primary"><i class="fa fa-search"></i> </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @if($searched)
            @if($post)
                {{--<div class="section-area">
                    <div class="container">
                        <div class="title-section">
                            <h1>Latest update on {{strtoupper($post->tracking_no)}}</h1>
                            <h1>Latest update on {{$post->status_id ? $post->current_status->name : ''}}</h1>
                            <h1>Latest update on {{$post->updated_at }}</h1>
                        </div>

                    </div>
                </div>--}}
                <div class="section-area">
                    <div class="container">
                        <div class="panel panel-default">
                            <div class="panel-body table-responsive">
                                <table id="tbl_post" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th class="center">Tracking No</th>
                                        <th class="center">Current Status</th>
                                        <th>Sender</th>
                                        <th>Receiver</th>
                                        <th class="center">Date</th>
                                        <th class="center">Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="center">{{strtoupper($post->tracking_no)}}</td>
                                        <td class="center">{{$post->status_id ? $post->current_status->name : ''}}</td>
                                        <td>{{$post->sender->name}}</td>
                                        <td>{{$post->receiver ? $post->receiver->name : ''}}</td>
                                        <td class="center">{{$post->updated_at }}</td>
                                        <td class="center">{{$post->receiver ? $post->receiver->postcode : ''}}</td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(! $found)
                <div class="section-area">
                    <div class="container">
                        <div class="alert alert-danger">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <i class="fa fa-warning" style="font-size: 4em"></i>
                                </div>
                                <div class="col-md-8 text-left">
                                    <h3>No result found with this tracking number.</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif


    </section>

@endsection