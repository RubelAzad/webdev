@extends('shipment::layouts.master')

@section('page_header')
    <i class="fa fa-plane"></i> Master Air Way Bill No: {{$mawb->id}}
@endsection

@section('breadcrumb')
    <li><a href="{{url('shipment/mawb')}}">Master Air Way Bills</a> </li>
    <li>MAWB Details</li>
@endsection

@section('top_right_corner_button_group')
    <a href="{{url('shipment/create-mawb')}}" class="btn btn-primary">New MAWB</a>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Flight No: {{$mawb->flight_no}} - Flight Date: {{$mawb->flight_date->format('d/m/Y')}}
                </h3>
            </div>
            <div class="panel-heading">
                <h3 class="panel-title">Weight (kg): Maximum  Allowed: {{$mawb->max_weight}}, Given: {{$mawb->max_weight}}, Remaining: {{$mawb->max_weight}}</h3>
            </div>

            <div class="panel-body">
                <h1>List of House Air Way Bills</h1>
                <table class="table table-bordered table-hover" style="width: 100%">
                    <thead>
                    <tr>
                        <th>HAWB No</th>
                        <th>Allowed Weight</th>
                        <th>Given Weight</th>
                        <th>Number of Packages</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
