@extends('nec.layouts.page')

@push('scripts')
<script>
    $(function () {
        valid_this_form('#frm_submit_cv');

        $('#btn_submit_cv').click(function (e) {
            e.preventDefault();
            if( $('#frm_submit_cv').valid()){
                $('#frm_submit_cv').submit();
            }
        });
    });
</script>
@endpush

@section('breadcrumb')
    <span>Career</span>
@endsection

@section('heading')
    {{strtoupper('Career')}}
@endsection

@section('second-heading')
    {{title_case('Join our friendly team')}}
@endsection

@section('content')
    <h1>Our Current Vacancies:</h1>
    <hr>
    <div class="alert alert-info">
        <p>We are consistency looking for talented and hardworking individuals. If you think you have the potential to help our friendly team, feel free to drop your CV here. We will contact you as soon as a job match with your profile.</p>
    </div>
    {!! Form::open(['id' => 'frm_submit_cv', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('name', '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('number', 'Contact Number', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('number', '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::email('email', '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('cover_letter', 'Cover Letter', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-7">
            {!! Form::textarea('cover_letter', '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Upload your CV', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-4">
            {!! Form::file('file', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <hr>
    <div class="form-group">
        {!! Form::label('', '', ['col-md-3 control-label']) !!}
        <div class="col-md-4">
            <button id="btn_submit_cv" class="btn btn-primary"><i class="fa fa-send-o"></i> Submit</button>
        </div>
    </div>
    {!! Form::close() !!}
    <hr>
@endsection