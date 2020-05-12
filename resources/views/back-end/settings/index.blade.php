@extends('back-end.layouts.app')

@push('scripts')
<script>

</script>
@endpush

@push('style')
<style>
    .onoffswitch {
        margin-top: 10px;
    }
</style>
@endpush

@section('page_header')
    System Configuration
@endsection

@section('breadcrumb')
    <li class="active">System Configuration</li>
@endsection

@section('content')
    <div class="row">
        <article class="col-xs-12">

            <div class="panel panel-tab rounded shadow">
                <div class="panel-body no-padding">
                    <div id="tabs">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tab-general" aria-controls="tab-general" role="tab" data-toggle="tab">General</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-billing" aria-controls="tab-theme" role="tab" data-toggle="tab">Billing</a>
                            </li>
                            {{--<li role="presentation">--}}
                                {{--<a href="#tab-theme" aria-controls="tab-theme" role="tab" data-toggle="tab">Theme</a>--}}
                            {{--</li>--}}
                        </ul>

                        <div class="tab-content">
                            <div id="tab-general" class="tab-pane fade in active padding-10">
                                {!! Form::open(['class' => 'form-horizontal', 'url' => url('settings/update-package')]) !!}
                                <div class="form-group">
                                    {!! Form::label('powered_by', 'Powered By Message', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-7">
                                        {!! Form::text('powered_by', get_settings('powered_by', ''), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('mass_divider', 'Volume Calculator Parameter', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-7">
                                        {!! Form::text('mass_divider', get_settings('mass_divider', '5000'), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('insurance_notice', 'Terms & Conditions for insurance', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-7">
                                        {!! Form::textarea('insurance_notice', get_settings('insurance_notice', ''), ['class' => 'form-control', 'rows' => '3']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('tandc4parcel', 'Terms & Conditions for parcels', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-7">
                                        {!! Form::textarea('tandc4parcel', get_settings('tandc4parcel', ''), ['class' => 'form-control']) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {!! Form::label('', '', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-7">
                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>

                            <div id="tab-billing" class="tab-pane fade padding-10">
                                @include('back-end.settings.billing')
                            </div>

                            {{--<div id="tab-theme" class="tab-pane fade padding-10">--}}
                                {{--@include('back-end.settings.theme')--}}
                            {{--</div>--}}
                        </div>
                    </div>
                </div>
            </div>

        </article>
    </div>
@endsection