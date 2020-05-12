@extends('cargo::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url('doc_viewer/css/style.css')}}">
@endpush

@push('scripts')
<script type="application/javascript" src="{{url('doc_viewer/libs/yepnope.1.5.3-min.js')}}"></script>
<script type="application/javascript" src="{{url('doc_viewer/src/ttw-document-viewer.js')}}"></script>
<script type="application/javascript" src="{{url('doc_viewer/src/ttw-invisible-dom.js')}}"></script>
<script type="application/javascript" src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
<script type="application/javascript" src="{{url(Module::asset('franchise:js/show.js'))}}"></script>
<script type="application/javascript" src="{{url(Module::asset('franchise:js/documents.js'))}}"></script>
<script>
    var franchise_id = '{{$franchise->id}}';
    var country = '{{$franchise->country}}';
</script>
@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Franchise - {{$franchise->name}}
@endsection

@section('breadcrumb')
    @can('view_all_franchises', \Modules\Franchise\Entities\Franchise::class)
        <li><a href="{{url('franchise')}}"><i class="fa fa-sitemap"></i> Manage Franchise</a></li>
    @else
        <li><i class="fa fa-sitemap"></i> Manage Franchise</li>
    @endcan
    <li class="active"> View Franchises - {{$franchise->name}}</li>
@endsection

@section('top_right_corner_button_group')
    @can('edit_franchise', \Modules\Franchise\Entities\Franchise::class)
        <a href="{{url('franchise/edit/' . $franchise->id)}}" class="btn btn-warning">Edit</a>
    @endcan
@endsection

@section('content')
    <input type="hidden" name="franchise_id" id="franchise_id" value="{{$franchise ? $franchise->id : ''}}">
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default rounded shadow">
                <div class="panel-body">
                    <div class="inner-all">
                        <ul class="list-unstyled">
                            <li class="text-left">
                                @if($franchise && $franchise->logo)
                                    <img id="profile_pic" class="img-rounded img-bordered-primary" src="{{url('file/serve/' . $franchise->logo->hash)}}" alt="{{$franchise->name}}" width="140px">
                                @else
                                @endif
                            </li>
                            <li class="text-left">
                                <h1 class="text-capitalize center"><strong>{{$franchise->name}}</strong></h1>
                            </li>

                            <li><br/></li>
                            <li>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /.panel -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Credit</h3>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item">Allowed: {{get_currency_symbol($franchise->country) . number_format($franchise->credit, 2)}}</li>
                        <li class="list-group-item">Remaining: 0</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Contact Information</h3>
                </div><!-- /.panel-heading -->
                <div class="panel-body no-padding rounded">
                    <ul class="list-group no-margin">
                        <li class="list-group-item"><i class="fa fa-user mr-5"></i> {{$franchise->contact_person}}</li>
                        <li class="list-group-item"><i class="fa fa-phone mr-5"></i> {{$franchise->phone_number}} {{$franchise->ev_phone_number ? ' - ' . $franchise->ev_phone_number: ''}}</li>
                        <li class="list-group-item"><i class="fa fa-envelope mr-5"></i> {{$franchise->email}}</li>
                    </ul>
                </div><!-- /.panel-body -->
            </div><!-- /.panel -->
        </div>

        <article class="col-md-8">

            <div class="panel panel-default panel-tab rounded shadow">
                <div class="panel-body no-padding">
                    <div id="tabs">

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#tab-business-info" aria-controls="tab-business-info" role="tab" data-toggle="tab">Business Information</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-officers" aria-controls="tab-officers" role="tab" data-toggle="tab">Officers</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-contact-details" aria-controls="tab-contact-details" role="tab" data-toggle="tab">Contact Details</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-rules" aria-controls="tab-rules" role="tab" data-toggle="tab">Business Rules</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-documents" aria-controls="tab-documents" role="tab" data-toggle="tab">Documents</a>
                            </li>
                            <li role="presentation">
                                <a href="#tab-agents" aria-controls="tab-agents" role="tab" data-toggle="tab">Agents</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div id="tab-business-info" role="tabpanel" class="tab-pane padding-10 active fade in">
                                @include('franchise::business_info', ['franchise' => $franchise])
                            </div>
                            <div id="tab-officers" role="tabpanel" class="tab-pane padding-10 fade">
                                <div id="employee_list">
                                    @include('franchise::officers', ['officers' => $franchise->employees])
                                </div>
                            </div>
                            <div id="tab-contact-details" role="tabpanel" class="tab-pane padding-10 fade">
                                @include('franchise::contact_details', ['franchise' => $franchise])
                            </div>
                            <div id="tab-rules" role="tabpanel" class="tab-pane padding-10 fade">
                                @include('franchise::business_rules', ['franchise' => $franchise])
                            </div>
                            <div id="tab-documents" role="tabpanel" class="tab-pane padding-10 fade">
                                @can('upload_franchise_documents', \Modules\Franchise\Entities\FranchiseDocument::class)
                                    <button id="btn_upload_document" class="btn btn-primary"><i class="fa fa-upload"></i> Upload New Document</button>
                                @endcan
                                <div id="doc_list">
                                    @include('franchise::documents', ['documents' => $franchise->documents])
                                </div>
                                @include('franchise::forms.document', ['doc_types' => $doc_types])
                            </div>
                            <div id="tab-agents" role="tabpanel" class="tab-pane padding-10">
                                @include('franchise::agents-table', ['agents' => $franchise->agents])
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
                    @include('franchise::forms.employee', ['country' => $franchise->country])
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button id="btn_submit_employee" type="button" class="btn btn-primary"><i class="fa fa-save"></i> Save Change</button>
                </div>
            </div>
        </div>
    </div>

@stop
