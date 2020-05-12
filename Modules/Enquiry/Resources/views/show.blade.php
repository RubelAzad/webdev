@extends('back-end.layouts.app')

@push('style')
    <style>
        .select2-dropdown, .select2-drop {
            margin-top: 48px;
        }
    </style>
@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/show.js'))}}"></script>
    <script>
        let enquiry_id = '{{$enquiry->id}}';
    </script>
@endpush

@section('page_header')
    <i class="fa fa-commenting"></i> Enquiry Details
@endsection

@section('breadcrumb')
    @can('view_all_enquiry', \Modules\Enquiry\Entities\Enquiry::class)
        <li class=""><a href="{{url('enquiry')}}"> <i class="fa fa-comment-o"></i> All Enquiries </a></li>
    @else
        <li><a href="{{url('enquiry')}}"><i class="fa fa-comment-o"></i> Enquiries</a></li>
    @endif

    @can('view_enquiries_belongs_to_agent', \Modules\Enquiry\Entities\Enquiry::class)
        <li class=""><a href="{{url('enquiry/agent')}}"> <i class="fa fa-comment-o"></i> Enquiries To Us</a></li>
    @endif

    <li class="active"><i class="fa fa-commenting"></i> Enquiry Details</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-default">
                <div class="panel-body no-padding">
                    <table class="table table-bordered">
                        <tr>
                            <th>Date</th>
                            <td>{{$enquiry->created_at->format('d/m/Y : H:i')}}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{$enquiry->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$enquiry->email}}</td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td>{{$enquiry->phone_number}}</td>
                        </tr>
                        <tr>
                            <th>Subject</th>
                            <td>{{$enquiry->subject}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{$enquiry->message}}</td>
                        </tr>

                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body no-padding">
                    <table class="table table-bordered">

                        @can('forward_enquiry', $enquiry)
                            <tr>
                                <th>Assign To Agent</th>
                                <td>
                                    <select id="agent_list" class="form-control">
                                        <option value=""></option>
                                        @foreach($agents as $country_code => $cities)
                                            <optgroup label="{{get_country_name($country_code)}}">
                                                @foreach($cities as $city => $all_agents)
                                                    <optgroup label="&nbsp;&nbsp;{{$city}} - {{get_country_name($country_code)}}">
                                                        @foreach($all_agents as $agent)
                                                            <option value="{{$agent->id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$agent->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </td>
                                <td><button id="btn_assign_to_agent" class="btn btn-primary"><i class="fa fa-save"></i></button></td>
                            </tr>
                        @endcan
                        @can('reply_enquiry', $enquiry)
                        <tr>
                            <th>Reply</th>
                            <td><textarea id="reply_message" class="form-control"></textarea></td>
                            <td><button id="btn_reply" class="btn btn-primary"><i class="fa fa-save"></i></button></td>
                        </tr>
                        @endcan
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6 ">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Assigning History</h3></div>
                <div class="panel-body no-padding">
                    <ul class="list-group">
                        @foreach($enquiry->agents as $agent)
                            <li class="list-group-item"><strong>{{$agent->name}}</strong> assigned at {{$agent->pivot->created_at->format('d/m/Y H:i')}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Reply History</h3></div>
                <div class="panel-body">
                    @foreach($enquiry->replies->sortByDesc('id') as $reply)
                        <strong>{{$reply->user ? $reply->user->name : 'Customer'}}</strong> said at {{$reply->created_at->format('d/m/Y H:i')}}
                        <br>
                        {{$reply->message}}
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
