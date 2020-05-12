@extends('shipment::layouts.master')

@section('page_header')
    <i class="fa fa-plane"></i> Master Air Way Bill
@endsection

@section('breadcrumb')
    <li>Master Air Way Bill</li>
@endsection

@section('top_right_corner_button_group')
    <a href="{{url('shipment/create-mawb')}}" class="btn btn-primary">New MAWB</a>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-body no-padding">
            <table class="table table-bordered table-hover" style="width: 100%">
                <thead>
                <tr>
                    <th>Flight No</th>
                    <th>Allowed Weight</th>
                    <th>Given Weight</th>
                    <th>Package Number</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

@stop
