@extends('location::layouts.master')

@push('scripts')
{{--<script src="{{url(Module::asset('location:js/country/index.js'))}}"></script>--}}
@endpush

@section('page_header')
    <span class="flag-icon flag-icon-{{strtolower($country->iso_3166_2)}}"></span> {{$country->name}}
@endsection

@section('breadcrumb')
    <li class=""><a href="{{url('country')}}">Countries</a></li>
    <li class="active">{{$country->name}}</li>
@endsection

@section('top_right_corner_button_group')
    @can('view_vat_settings', \Modules\Location\Entities\Country::class)
        <a href="{{url('country/view-vat/' . $country->id)}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Create new Agent"><i class="fa fa-dollar"></i> VAT Settings</a>
    @endcan
    <a href="{{url('service/src-country/'.$country->iso_3166_3)}}" class="btn btn-primary" rel="tooltip" data-placement="top" title="Services in {{$country->name}}"><i class="fa fa-list"></i> Services</a>
@endsection

@section('content')
    <ul>
        <li>Number of Zones: {{$country->zones->count()}}</li>
        <li>Number of Agents: {{$country->agents->count()}}</li>
        <li>Number of Franchises: {{$country->franchises->count()}}</li>
    </ul>

@stop