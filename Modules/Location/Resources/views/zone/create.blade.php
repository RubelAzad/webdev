@extends('location::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url(Module::asset('location:css/zone/create.css'))}}">
@endpush

@push('scripts')
<script src="{{url(Module::asset('location:js/zone/create.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Create new zone {!! $country ? 'in <i><strong>'. $country->name .'</strong></i>' : '' !!}
@endsection

@section('breadcrumb')
    {{--@if($franchise)--}}
        {{--<li><a href="{{url('franchise/view/' . $franchise->id)}}"><i class="fa fa-sitemap"></i> {{$franchise->name}}</a></li>--}}
    {{--@endif--}}
    {{--<li class="active"><i class="fa fa-sitemap"></i> Manage Agents</li>--}}
@endsection

@section('top_right_corner_button_group')
    {{--@can('create_agent', Modules\Agent\Entities\Agent::class)--}}
        {{--<a href="{{url('agent/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Agent"><i class="fa fa-plus"></i> Create New Agent</a>--}}
    {{--@endcan--}}
    <a href="{{url('zone/create')}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Agent"><i class="fa fa-plus"></i> Create New Zone</a>
@endsection

@section('content')
    {!! Form::open(['id' => 'frm_zone', 'url' => url('zone/create'), 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('zone_id', $zone ? $zone->id : '', ['id' => 'zone_id']) !!}
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => 'control-label col-md-3'])) !!}
        <div class="col-md-8">
            {!! Form::text('name', $zone ? $zone->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('country', '<span class="star">*</span>Country', ['class' => 'control-label col-md-3'])) !!}
        <div class="col-md-8">
            {!! Form::select('country', $countries, $zone ? $zone->country_code : '', ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('receive', '<span class="star">*</span>Drop off cost', ['class' => 'control-label col-md-3'])) !!}
        <div class="col-md-8">
            {!! Form::text('receive', $zone ? $zone->receive : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('pickup', '<span class="star">*</span>Pick up cost', ['class' => 'control-label col-md-3'])) !!}
        <div class="col-md-8">
            {!! Form::text('pickup', $zone ? $zone->pickup : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('collection', '<span class="star">*</span>Collection cost', ['class' => 'control-label col-md-3'])) !!}
        <div class="col-md-8">
            {!! Form::text('collection', $zone ? $zone->collection : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery', '<span class="star">*</span>Home delivery cost', ['class' => 'control-label col-md-3'])) !!}
        <div class="col-md-8">
            {!! Form::text('delivery', $zone ? $zone->delivery : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('', '', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-8">
            <button class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
        </div>
    </div>
    {!! Form::close() !!}
@stop