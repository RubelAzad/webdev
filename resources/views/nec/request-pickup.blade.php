@extends('nec.layouts.page')

@push('style')
<style>
    .btn-primary{
        border-color: #16f91e;
    }
    .btn-primary.active, .btn-primary:active {
        background-color: #2c8d14;
        border-color: #16f91e;
    }
    .btn-primary.active:hover {
        background-color: #2c8d14;
        border-color: #16f91e;
    }
    .input-group[class*="col-"] {
        padding-left: 15px;
    }
    .day {
        background-color: #0e5d1a;
        color: #e1f808;
    }
    .datepicker table tr td.day:hover {
        background-color: #42b333;
    }
    .datepicker table tr td.disabled:hover{
        background-color: inherit;
    }
    /*.datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {*/
        /*color: #d7d8de;*/
    /*}*/
</style>
@endpush

@push('scripts')
<script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
<script>
    $(function () {

        $('#div_date .input-group.date').datepicker({
            format: "dd/mm/yyyy",
            weekStart: 1,
            startDate: '+1d',
            endDate: '+22d',
            autoclose: true
        });

        $('#postcode_lookup').getAddress({
            api_key: '3Ihph0lYAU6P1llsphU68Q5211',
            output_fields:{
                line_1: '#address_line_1',
                line_2: '#address_line_2',
                line_3: '#address_line_3',
                post_town: '#city',
                county: '#county',
                postcode: '#postcode'
            }
        });

        valid_this_form('#frm_request_pickup');

        $('#btn_request_pickup').click(function (e) {
            e.preventDefault();

            if( $('#frm_request_pickup').valid() ){
                $('#frm_request_pickup').submit();
            }
        });

    });
</script>
@endpush

@section('heading')
    Request for home pickup
@endsection

@section('second-heading')
    Please fill and send the form with required information. We will contact you as soon as possible!
@endsection

@section('breadcrumb')
    <span>Request for home pickup</span>
@endsection

@section('content')
    <section id="home" data-target="home">

        <div class="section-area">
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {!! Form::open(['class' => 'form-horizontal', 'id' => 'frm_request_pickup']) !!}

                <fieldset>
                    <legend>Package Details</legend>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('quantity', '<span class="star">*</span>Package Quantity', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::number('quantity', '', ['class' => 'form-control', 'min' => 1, 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('weight', '<span class="star">*</span>Package Weight (kg)', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::number('weight', '', ['class' => 'form-control', 'min' => 1, 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('description', '<span class="star">*</span>Description', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::text('description', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Contact Person</legend>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('phone_number', '<span class="star">*</span>Phone Number', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::text('phone_number', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email', ['class'=> 'control-label col-md-3']) !!}
                        <div class="col-md-8">
                            {!! Form::email('email', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div id="div_date" class="form-group">
                        {!! htmlspecialchars_decode(Form::label('preferred_date', '<span class="star">*</span>Preferred Date', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-4 input-group date">
                            {!! Form::text('preferred_date', '', ['class' => 'form-control', 'required' => 'required']) !!}
                            {{--<input id="preferred_date" type="text" class="form-control">--}}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('preferred_time') ? ' has-error' : '' }}">
                        {!! Form::label('', '*Preferred Time to pickup', ['class'=> 'control-label col-md-3']) !!}
                        <div class="col-md-9 btn-group" data-toggle="buttons">
                            <label class="btn btn-primary"><input type="radio" name="preferred_time" value="Morning 9:00 am - 12:30 pm">Morning 9:00 am - 12:30 pm</label>
                            <label class="btn btn-primary"><input type="radio" name="preferred_time" value="After noon 1:00 pm - 5:00 pm">After noon 1:00 pm - 5:00 pm</label>
                            <label class="btn btn-primary"><input type="radio" name="preferred_time" value="Evening 5:00 pm - 7:00 pm">Evening 5:00 pm - 7:00 pm</label>
                            @if ($errors->has('preferred_time'))
                                <br><br>
                                <span class="help-block"><strong>{{ $errors->first('preferred_time') }}</strong></span>
                            @endif
                        </div>
                    </div>

                </fieldset>
                <fieldset>
                    <legend>Collection Address</legend>

                    <div class="form-group">
                        <label class="control-label col-sm-3">Search postcode</label>
                        <div id="postcode_lookup" class="col-sm-8"></div>
                    </div>

                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('address_line_1', '<span class="star">*</span>Address Line 1', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::text('address_line_1', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('address_line_2', 'Address Line 2', ['class'=> 'control-label col-md-3']) !!}
                        <div class="col-md-8">
                            {!! Form::text('address_line_2', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('address_line_3', 'Address Line 3', ['class'=> 'control-label col-md-3']) !!}
                        <div class="col-md-8">
                            {!! Form::text('address_line_3', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('city', '<span class="star">*</span>City', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::text('city', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('county', 'County', ['class'=> 'control-label col-md-3']) !!}
                        <div class="col-md-8">
                            {!! Form::text('county', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! htmlspecialchars_decode(Form::label('postcode', '<span class="star">*</span>Postcode', ['class'=> 'control-label col-md-3'])) !!}
                        <div class="col-md-8">
                            {!! Form::text('postcode', '', ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('message', 'Special Instruction', ['class'=> 'control-label col-md-3']) !!}
                        <div class="col-md-8">
                            {!! Form::textarea('message', '', ['class' => 'form-control', 'rows' => 2]) !!}
                        </div>
                    </div>
                </fieldset>
                <div class="form-group">
                    {!! Form::label('', '', ['class'=> 'control-label col-md-3']) !!}
                    <div class="col-md-8">
                        {!! Form::captcha(config('captcha.attributes')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('', '', ['class'=> 'control-label col-md-3']) !!}
                    <div class="col-md-8">
                        <button id="btn_request_pickup" class="btn btn-primary">Send Request</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </section>

@endsection