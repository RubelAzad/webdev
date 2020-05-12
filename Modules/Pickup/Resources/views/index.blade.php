@extends('pickup::layouts.master')

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('pickup:js/index.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-truck"></i> Active Pickup Request
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body row">
            <div class=" table-responsive col-xs-12">
                <table id="tbl_pickup_list" class="table table-bordered" style="width: 100%">
                    <thead>
                    <tr class="hidden-sm">
                        <td>Date</td>
                        <td>Requester</td>
                        <td class="center">Phone Number</td>
                        <td>Email</td>
                        <td class="center">Postcode</td>
                        <td class="center">Preferred Date</td>
                        <td>Time</td>
                        <td class="center">Weight</td>
                        <td class="hidden-print">Actions</td>
                    </tr>
                    <tr>
                        <th class="center">Date</th>
                        <th>Requester</th>
                        <th class="center">Phone Number</th>
                        <th>Email</th>
                        <th class="center">Postcode</th>
                        <th class="center">Preferred Date</th>
                        <th>Time</th>
                        <th class="center">Weight</th>
                        <th class="hidden-print"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pickups as $pickup)
                        <tr>
                            <td class="center">{{$pickup->created_at->format('d/m/Y')}}</td>
                            <td>{{$pickup->name}}</td>
                            <td class="center">{{$pickup->phone_number}}</td>
                            <td>{{$pickup->email}}</td>
                            <td class="center">{{$pickup->postcode}}</td>
                            <td class="center">{{$pickup->preferred_date->format('d/m/Y')}}</td>
                            <td>{{$pickup->preferred_time}}</td>
                            <td class="center">{{$pickup->weight}}</td>
                            <td class="hidden-print center">
                                <a href="{{url('pickup/view/' . $pickup->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-search"></i> </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
