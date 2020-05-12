@extends('back-end.layouts.app')

@push('style')
    <style>
        .select2-dropdown, .select2-drop {
            margin-top: 48px;
        }
    </style>
@endpush

@push('scripts')
    <script type="application/javascript" src="{{url(Module::asset('enquiry:js/internal-show.js'))}}"></script>
    <script>
        let enquiry_id = '{{$enquiry->id}}';
    </script>
@endpush

@section('page_header')
    <i class="fa fa-commenting"></i> Enquiry Details
@endsection

@section('breadcrumb')
    <li class=""><a href="{{url('enquiry/sent')}}"> <i class="fa fa-comment-o"></i> Enquiries Sent</a></li>
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
                            <th>Subject</th>
                            <td>{{$enquiry->subject->text}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{$enquiry->message}}</td>
                        </tr>
                        <tr>
                            <th>Attachment</th>
                            <td>
                                @if($attachments = get_attachments($enquiry))
                                    <ul>
                                        @foreach($attachments as $attachment)
                                            <li><a href="{{url('file/download/' . $attachment->hash)}}">{{$attachment->name}}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><span id="status_name">{{$enquiry->status->name}}</span></td>
                        </tr>
                        <tr>
                            <th>Change Status</th>
                            <td>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <select id="select_status" class="form-control">
                                            <option></option>
                                            @foreach($statuses as $status)
                                                <option value="{{$status->id}}">{{$status->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <button id="update_status" class="btn btn-info">Update Status</button>
                                    </div>
                                </div>
                            </td>
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
                        <tr>
                            <th>Reply</th>
                            <td><textarea id="reply_message" class="form-control"></textarea></td>
                            <td><button id="btn_reply" class="btn btn-primary"><i class="fa fa-send"></i></button></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6 ">

            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Reply History</h3></div>
                <div class="panel-body">
                    @foreach($replies->sortByDesc('id') as $reply)
                        <span class="text-primary"><strong>{{$reply->user->name}}</strong> {{$reply->to_agent ? 'from head office' : 'from agent office'}} replied at {{$reply->created_at->format('d/m/Y H:i')}}</span>
                        <br>
                        {{$reply->message}}
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
