@extends('warehouse::layouts.master')


@section('page_header')
    <i class="fa fa-archive"></i> Login to Warehouses
@endsection

@section('breadcrumb')
    <li><a href="{{url('warehouse')}}"> <i class="fa fa-archive"></i> Management Warehouses</a> </li>
    <li class="active"> Login to Warehouses</li>
@endsection

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Select which warehouse to login !</h3></div>
            <div class="panel-body">
                <div class="list-group">
                    @if('admin')
                        @foreach($houses as $house)
                            <a class="list-group-item" href="{{url('warehouse/login/' . $house->id)}}">
                                <i class="fa fa-arrow-right"></i> <i class="fa fa-home"></i>
                                {{$house->name}}
                            </a>
                        @endforeach
                    @else
                        @foreach($houses as $house)
                            <a class="list-group-item" href="{{url('warehouse/login/' . $house->warehouse->id)}}">
                                <i class="fa fa-arrow-right"></i> <i class="fa fa-home"></i>
                                {{$house->warehouse->name}}
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
