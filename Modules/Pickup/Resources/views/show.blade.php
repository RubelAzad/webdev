@extends('pickup::layouts.master')

@push('scripts')
<script type="application/javascript" src="{{url(Module::asset('pickup:js/show.js'))}}"></script>
@endpush

@section('page_header')
    <i class="fa fa-truck"></i> Pickup Request
@endsection

@section('content')
<div class="container">
    <div class="panel panel-default">
        {{--<div class="panel-heading"><h3 class="panel-title">Pickup Request</h3></div>--}}
        <div class="panel-body no-padding">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>Date</th>
                    <td>{{$pickup->created_at->format('d/m/Y : H:i')}}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{title_case($pickup->name)}}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        {{title_case($pickup->address_line_1)}}
                        {!! $pickup->address_line_2 ? '<br>' . title_case($pickup->address_line_2) : '' !!}
                        {!! $pickup->address_line_3 ? '<br>' . title_case($pickup->address_line_3) : '' !!}
                        <br>{!! title_case($pickup->city) !!}
                        {!! $pickup->county ? '<br>' . title_case($pickup->county) : '' !!}
                        <br>{!! strtoupper($pickup->postcode) !!}
                        <br>{!! get_country_name($pickup->country_code) !!}
                    </td>
                </tr>
                <tr>
                    <th>Contact Number</th>
                    <td>{{$pickup->phone_number}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{$pickup->email}}</td>
                </tr>
                <tr>
                    <th>Packages</th>
                    <td>{{$pickup->quantity}}</td>
                </tr>
                <tr>
                    <th>Weight</th>
                    <td>{{$pickup->weight}}</td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td>{{$pickup->description}}</td>
                </tr>
                <tr>
                    <th>Preferred date and time</th>
                    <td>{{$pickup->preferred_date->format('d/m/Y')}} - {{$pickup->preferred_time}}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <td>{{$pickup->note}}</td>
                </tr>
                <tr>
                    <th>Assign to agent</th>
                    <td>
                        <span id="agent_info">
                            {{$pickup->agent ? $pickup->agent->name: '' }}
                            {{$pickup->agent ? ', ' . $pickup->agent->city: '' }}
                        </span>
                        <button id="btn_assign_to_agent" class="btn btn-primary">Assign to Agent</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="md_agent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">List of Available Agents</h4>
            </div>
            <div class="modal-body">
                <table id="tbl_agents" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Contact Person</th>
                        <th>Contact Number</th>
                        <th>City</th>
                        <th class="center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($agents->count() && $i=1)
                        @foreach($agents as $agent)
                            <tr>
                                <td>{{$agent->name}}</td>
                                <td>{{$agent->contact_person}}</td>
                                <td class="center">{{$agent->phone_number}}</td>
                                <td class="center">{{$agent->city}}</td>
                                <td class="center">
                                    <button data-agent_id="{{$agent->id}}" data-pickup_id="{{$pickup->id}}" class="btn btn-danger select_agent">Select</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
            {{--</div>--}}
        </div>
    </div>
</div>
@stop
