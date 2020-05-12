@extends('warehouse::layouts.master')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-7">
                        <img src="{{$logo}}" width="200"><br>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('warehouse::pickup-list-table')
@stop