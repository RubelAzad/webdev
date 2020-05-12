@extends('back-end.layouts.app')

@push('scripts')
<script>
    $(function () {
        valid_this_form('#frm_settings');
        $('#btn_save_setting').click(function (e) {
            e.preventDefault();

            if( $('#frm_settings').valid() ){
                $.LoadingOverlay('show',{
                    image: '',
                    fontawesome : "fa fa-cog fa-spin"
                });
                $('#frm_settings').submit();
            }
        });
    });
</script>
@endpush

@section('content')
    <section class="panel panel-danger">
        <div class="panel-heading"><h1 class="">Manage Website Settings</h1></div>
        <div class="panel-body">
            {!! Form::open(['id' => 'frm_settings', 'class' => 'form-horizontal', 'url' => url('site/settings/update'), 'files' => true]) !!}
            <fieldset>
                <legend>Customer Care Details</legend>
                <div class="form-group">
                    {!! Form::label('customer_care_number', '*Contact Number', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::text('customer_care_number', get_settings('customer_care_number', ''), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('customer_care_email', '*Contact Email', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::text('customer_care_email', get_settings('customer_care_email', ''), ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('contact_page_message', 'Contact Page Message', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::textarea('contact_page_message', get_settings('contact_page_message', ''), ['class' => 'form-control', 'rows' => 2]) !!}
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Logo</legend>
                <div class="form-group">
                    {!! Form::label('file', 'Change Main Logo', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::file('file', ['class' => 'form-control']) !!}
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Social Site Links</legend>
                <div class="form-group">
                    {!! Form::label('facebook', 'Facebook', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::url('facebook', get_settings('facebook', ''), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('twitter', 'Twitter', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::url('twitter', get_settings('twitter', ''), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('linkedin', 'Linkedin', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::url('linkedin', get_settings('linkedin', ''), ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('youtube', 'Youtube', ['class' => 'control-label col-md-3']) !!}
                    <div class="col-md-7">
                        {!! Form::url('youtube', get_settings('youtube', ''), ['class' => 'form-control']) !!}
                    </div>
                </div>
            </fieldset>
            {!! Form::close() !!}
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-7">
                    <button id="btn_save_setting" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
                </div>
            </div>
        </div>
    </section>
@endsection