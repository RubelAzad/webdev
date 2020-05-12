@extends('location::layouts.master')

@push('scripts')
{{--<script src="{{url(Module::asset('location:js/country/index.js'))}}"></script>--}}
@endpush

@section('page_header')
    <span class="flag-icon flag-icon-{{strtolower($country->iso_3166_2)}}"></span> {{$country->name}}
@endsection

@section('breadcrumb')
    <li class=""><a href="{{url('country')}}">Countries</a></li>
    <li class=""><a href="{{url('country/view/' . $country->iso_3166_3)}}">{{$country->name}}</a></li>
    <li class="active">VAT Settings</li>
@endsection

@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{$country->name}} VAT Settings</h3>
            </div>
            {!! Form::open(['id' => 'frm_country', 'class' => 'form-horizontal', 'url' => url('country/update-vat')]) !!}
            {!! Form::hidden('country_id', $country->id, ['id' => 'country_id']) !!}
            <div class="panel-body">
                @foreach($countries as $country)
                    <div class="form-group">
                        <label for="'id-{{$country->id}}" class="col-sm-4 control-label">{{$country->name}} <span class="flag-icon flag-icon-{!! strtolower($country->iso_3166_2) !!}"></span></label>
                        <div class="col-sm-6">
                            {!! Form::number('id-' . $country->id, 0, ['class' => 'form-control', 'required' => 'required']) !!}
                        </div>
                    </div>
                @endforeach
            </div>
            @can('update_vat_settings', \Modules\Location\Entities\Country::class)
                <div class="panel-footer center">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            @endif
            {!! Form::close() !!}
        </div>
    </div>

@stop