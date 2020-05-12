@extends('cargo::layouts.master')

@section('content')
    <section class="offwhite">
        <div class="container">
            <p>Some useful information tracking the parcel!</p>

        </div>
    </section>
    <section class="offwhite">
        <div class="container">
            <div class="well">
                {!! Form::open(['url' => url('cargo/track'), 'class' => 'form-horizontal']) !!}
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
    </section>


@stop
