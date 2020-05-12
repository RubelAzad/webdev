@extends('nec.layouts.page')

@section('breadcrumb')
    <span>Contact us</span>
@endsection

@section('heading')
    Contact us
@endsection

@section('second-heading')
    Something about us from a little bit of different perspective
@endsection

@section('content')
    <section id="home" data-target="home">
        <div class="section-area">
            <div class="container">
                <div class="title-section">
                    <h1>Contact Us</h1>
                    <p>{{get_settings('contact_page_message', 'Please fill the form with your enquiry and send it to us. We aim to answer within 24 hours of receiving your query!')}}</p>
                </div>
                {!! Form::open([]) !!}

                <div class="form-group">
                    {!! Form::label('name', '*Name', ['class'=> 'control-label']) !!}
                    {!! Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('phone_number', '*Phone Number', ['class'=> 'control-label']) !!}
                    {!! Form::text('phone_number', '', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class'=> 'control-label']) !!}
                    {!! Form::text('email', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('subject', '*Subject', ['class'=> 'control-label']) !!}
                    {!! Form::text('subject', '', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('message', '*Message', ['class'=> 'control-label']) !!}
                    {!! Form::textarea('message', '', ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::checkbox('send_copy', '', false, ['id' => 'send_copy']) !!}
                    {!! Form::label('send_copy', 'Send a copy to me', ['class'=> 'control-label']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection