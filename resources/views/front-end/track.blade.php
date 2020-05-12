@extends('front-end.layouts.app')

@section('content')
    <section id="home" data-target="home">

        <div class="action-banner">
            <div class="container">
                @include('front-end.partials.middle-menu')
            </div>
        </div>
        <div class="section-area">
            <div class="container">
                <div class="title-section">
                    <h1>Track you parcel</h1>
                    <p>Please enter the tracking number !</p>
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
                <div class="section-area">
                    <div class="container">
                        <div class="title-section">
                            <h1>Latest update on {{strtoupper($post->tracking_no)}}</h1>
                        </div>
                        <div class="well">
                            @include('cargo::post.accordion.tracking-info', ['histories' => $post->histories])
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
                                    <i class="fa fa-warning fa-3x"></i>
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