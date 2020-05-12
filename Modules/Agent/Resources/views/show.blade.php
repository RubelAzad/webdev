@extends('cargo::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url('doc_viewer/css/style.css')}}">
@endpush

@push('scripts')
<script type="application/javascript" src="{{url('doc_viewer/libs/yepnope.1.5.3-min.js')}}"></script>
<script type="application/javascript" src="{{url('doc_viewer/src/ttw-document-viewer.js')}}"></script>
<script type="application/javascript" src="{{url('doc_viewer/src/ttw-invisible-dom.js')}}"></script>
<script type="application/javascript" src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
<script type="application/javascript" src="{{url(Module::asset('agent:js/show.js'))}}"></script>
<script type="application/javascript" src="{{url(Module::asset('agent:js/documents.js'))}}"></script>
<script>
    var agent_id = '{{$agent->id}}';
    var country = '{{$agent->country}}';
</script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Agent - {{$agent->name}}
@endsection

@section('breadcrumb')
    @can('view_all_agents', \Modules\Agent\Entities\Agent::class)
        <li><a href="{{url('agent')}}"><i class="fa fa-sitemap"></i> Manage Agents</a></li>
    @else
        <li><i class="fa fa-sitemap"></i> Manage Agents</li>
    @endcan
    <li class="active"> View Agents - {{$agent->name}}</li>
@endsection

@section('top_right_corner_button_group')
    @can('edit_agent', \Modules\Agent\Entities\Agent::class)
        <a href="{{url('agent/edit/' . $agent->id)}}" class="btn btn-warning">Edit</a>
    @endcan
@endsection

@section('content')
    <input type="hidden" name="agent_id" id="agent_id" value="{{$agent ? $agent->id : ''}}">
    <div class="row">
        <article class="col-md-4">
            <div class="panel panel-default rounded shadow">
                <div class="panel-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-left">
                                @if($agent && $agent->logo)
                                    <img id="profile_pic" class="img-rounded img-bordered-primary" src="{{url('file/serve/' . $agent->logo->hash)}}" alt="{{$agent->name}}" width="140px">
                                @else
                                @endif
                            </li>
                            <li class="text-left">
                                <h1 class="text-capitalize"><strong>{{$agent->name}}</strong></h1>
                            </li>

                            <li><br/></li>
                            <li>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-footer">
                    <strong>Parent Franchise: {{$agent->franchise ? $agent->franchise->name : ''}}</strong>
                </div>
            </div><!-- /.panel -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Information</h3>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-user mr-5"></i> {{$agent->contact_person}}</li>
                        <li class="list-group-item"><i class="fa fa-phone mr-5"></i> {{$agent->phone_number}} {{$agent->ev_phone_number ? ' - ' . $agent->ev_phone_number: ''}}</li>
                        <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> {{$agent->email}}</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">Credit</h3>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item">Allowed: {{get_currency_symbol($agent->country) . number_format($agent->credit, 2)}}</li>
                        <li class="list-group-item">Remaining: 0</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </article>
        <article class="col-md-8">
            <div class="panel panel-default panel-tab rounded shadow">
                <div class="panel-body no-padding">
                    <div id="tabs">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tabs-business-info" aria-controls="tabs-business-info" role="tab" data-toggle="tab">Business Information</a>
                            </li>
                            <li role="presentation">
                                <a href="#tabs-services" aria-controls="tabs-services" role="tab" data-toggle="tab">Business Rules</a>
                            </li>
                            <li role="presentation">
                                <a href="#tabs-officers" aria-controls="tabs-officers" role="tab" data-toggle="tab">Officers</a>
                            </li>
                            <li role="presentation">
                                <a href="#tabs-contact-details" aria-controls="tabs-contact-details" role="tab" data-toggle="tab">Contact Details</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-documents" aria-controls="tab-documents" role="tab" data-toggle="tab">Documents</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tabs-business-info" role="tabpanel" class="tab-pane padding-10 active fade in">
                                @include('agent::business_info', ['agent' => $agent])
                            </div>
                            <div id="tabs-services" role="tabpanel" class="tab-pane padding-10 fade">
                                @include('agent::services', ['agent' => $agent])
                            </div>
                            <div id="tabs-officers" role="tabpanel" class="tab-pane padding-10 fade">
                                <div id="employee_list">
                                    @include('agent::officers', ['officers' => $agent->officers])
                                </div>
                            </div>
                            <div id="tabs-contact-details" role="tabpanel" class="tab-pane padding-10 fade">
                                @include('agent::contact_details', ['agent' => $agent])
                            </div>
                            <div id="tab-documents" role="tabpanel" class="tab-pane padding-10 fade">
                                @can('upload_agent_documents', \Modules\Agent\Entities\AgentDocument::class)
                                    <button id="btn_upload_document" class="btn btn-primary"><i class="fa fa-upload"></i> Upload New Document</button>
                                @endcan
                                <div id="doc_list" role="tabpanel" class="tab-pane">
                                    @include('agent::documents', ['documents' => $agent->documents])
                                </div>
                                @include('agent::forms.document', ['doc_types' => $doc_types])
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </article>
    </div>

    <div class="modal fade" id="mdl_employee" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="mdl_employee_title">Franchise Employee</h4>
                </div>
                <div class="modal-body">
                    @include('agent::forms.employee', ['country' => $agent->country])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_submit_employee" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
                </div>
            </div>
        </div>
    </div>
@stop
