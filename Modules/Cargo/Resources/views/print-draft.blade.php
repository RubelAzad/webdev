@extends('layouts.invoice')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-7">
                        <h1>Draft Invoice</h1>
                        <h5 class="text-danger">This invoice is not final. Please check carefully before confirm the booking</h5>
                    </div>
                    <div class="col-xs-5 text-right">
                        <br>Date: {{$draft->created_at->format('d/m/Y')}}
                    </div>
                </div>
            </div>
        </div>

        @include('cargo::shipment.draft-summary', [ 'draft' => $draft, 'agent' => $agent ])


        <div class="row">
            <div class="col-xs-6 left">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>Customer Signature</h4></div>
                    <div class="panel-body">
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 right">
                <div class="panel panel-default">
                    <div class="panel-heading"><h4>For Office Use</h4></div>
                    <div class="panel-body">
                        <br>
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </div> {{-- end of row   --}}


    </div>

@stop
