@extends('cargo::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url('doc_viewer/css/style.css')}}">
<link rel="stylesheet" href="{{url(Module::asset('agent:css/create.css'))}}">
@endpush

@push('scripts')
<script src="{{url('doc_viewer/libs/yepnope.1.5.3-min.js')}}"></script>
<script src="{{url('doc_viewer/src/ttw-document-viewer.js')}}"></script>
<script src="{{url('doc_viewer/src/ttw-invisible-dom.js')}}"></script>
<script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>

<script src="{{url('magic/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

<script src="{{url(Module::asset('agent:js/create.js'))}}"></script>
<script src="{{url(Module::asset('agent:js/documents.js'))}}"></script>

<script>
    var agent_id = '{{$agent ? $agent->id : ''}}';
</script>

@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Create Agent {!! $franchise ? 'in <i><strong>'. $franchise->name .'</strong></i>' : '' !!}
@endsection

@section('breadcrumb')
    @if($franchise)
        <li><a href="{{url('franchise/view/' . $franchise->id)}}"><i class="fa fa-sitemap"></i> {{$franchise->name}}</a></li>
    @endif
    @can('view_all_agents', \Modules\Agent\Entities\Agent::class)
        <li><a href="{{url('agent')}}"><i class="fa fa-sitemap"></i> Manage Agents</a></li>
    @endcan
    @can('view_my_agents', \Modules\Franchise\Entities\Franchise::class)
        <li><a href="{{url('franchise/agents')}}" class="">My Agents</a></li>
    @endcan
    <li class="active">Setup New Agent</li>
@endsection

@section('content')

    <div class="panel panel-primary">
        <div class="panel-heading"><h3 class="panel-title">Create Agent Record</h3></div>
        <div class="panel-body">
            <div id="bootstrap-wizard-1" class="col-sm-12">
                <div class="form-bootstrapWizard">
                    <ul class="bootstrapWizard form-wizard">
                        <li class="active" data-target="#step1"><a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Business information</span> </a></li>
                        <li data-target="#step2"><a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Director information</span> </a></li>
                        <li data-target="#step3"><a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Contact Details</span> </a></li>
                        <li data-target="#step4"><a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Business Rules</span> </a></li>
                        <li data-target="#step5"><a href="#tab5" data-toggle="tab"> <span class="step">5</span> <span class="title">Supporting Documents</span> </a></li>
                        <li data-target="#step6"><a href="#tab6" data-toggle="tab"> <span class="step">6</span> <span class="title">Confirm</span> </a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                        <br>
                        <h3><strong>Step 1 </strong> - Business Information</h3>
                        @include('agent::forms.basic_info', ['agent' => $agent ? $agent : ''])
                    </div>
                    <div class="tab-pane" id="tab2">
                        <br>
                        <h3><strong>Step 2</strong> - Director Information</h3>
                        @include('agent::forms.director_info', ['agent' => $agent ? $agent : '', 'country' => $agent ? $agent->country : ''])
                    </div>
                    <div class="tab-pane" id="tab3">
                        <br>
                        <h3><strong>Step 3</strong> - Contact Details</h3>
                        @include('agent::forms.contact_details', ['agent' => $agent ? $agent : ''])
                    </div>
                    <div class="tab-pane" id="tab4">
                        <br>
                        <h3><strong>Step 4</strong> - Business Rules</h3>
                        @include('agent::forms.business_rules', ['agent' => $agent ? $agent : ''])
                    </div>
                    <div class="tab-pane" id="tab5">
                        <br>
                        <h3><strong>Step 5</strong> - Confirming</h3>
                        <br>
                        <button id="btn_upload_document" class="btn btn-primary"><i class="fa fa-upload"></i> Upload New Document</button>
                        <div id="doc_list">
                            @include('agent::documents', ['documents' => $agent ? $agent->documents : collect([])])
                        </div>
                    </div>
                    <div class="tab-pane" id="tab6">
                        <br>
                        <h3><strong>Step 6</strong> - Confirming</h3>
                        @include('agent::forms.confirm', ['agent' => $agent ? $agent : ''])
                    </div>

                    <div class="form-actions">
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="pager wizard no-margin">
                                    <li class="previous" style="display:none;"><a href="javascript:;" class="btn btn-lg btn-default">Previous</a></li>
                                    <li class="next"><a href="javascript:;" class="btn btn-lg txt-color-darken">Next</a></li>
                                    <li class="finish"><a href="javascript:;" class="btn btn-lg txt-color-darken">Finish</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="label">

        </div>
    </div>

    @include('agent::forms.document', ['doc_types' => $doc_types])

@stop
