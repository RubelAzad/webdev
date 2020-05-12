@extends('cargo::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url('doc_viewer/css/style.css')}}">
<link rel="stylesheet" href="{{url(Module::asset('franchise:css/create.css'))}}">
@endpush

@push('scripts')
<script src="{{url('doc_viewer/libs/yepnope.1.5.3-min.js')}}"></script>
<script src="{{url('doc_viewer/src/ttw-document-viewer.js')}}"></script>
<script src="{{url('doc_viewer/src/ttw-invisible-dom.js')}}"></script>
<script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>

<script src="{{url('magic/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>

<script src="{{url(Module::asset('franchise:js/create.js'))}}"></script>
<script src="{{url(Module::asset('franchise:js/documents.js'))}}"></script>

<script>
    var franchise_id = '{{$franchise ? $franchise->id : ''}}';
</script>

@endpush

@section('page_header')
    <i class="fa fa-sitemap"></i> Create Franchises
@endsection

@section('breadcrumb')
    <li><a href="{{url('franchise')}}"><i class="fa fa-sitemap"></i> Manage Franchises</a></li>
    <li class="active">Setup New Franchises</li>
@endsection

@section('content')

    <article class="col-xs-12">

        <!-- Widget ID (each widget will need unique ID)-->
        <div class="jarviswidget jarviswidget-color-darken" id="wid-new-franchise" data-widget-sortable="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

            <header>
                <span class="widget-icon"><i class="fa fa-sitemap"></i> </span>
                <h2>Create Franchise Record </h2>
            </header>

            <!-- widget div-->
            <div>

                <!-- widget edit box -->
                <div class="jarviswidget-editbox">
                    <!-- This area used as dropdown edit box -->

                </div>
                <!-- end widget edit box -->

                <!-- widget content -->
                <div class="widget-body">

                    <div class="row">

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
                                    @include('franchise::forms.basic_info', ['franchise' => $franchise ? $franchise : ''])
                                </div>
                                <div class="tab-pane" id="tab2">
                                    <br>
                                    <h3><strong>Step 2</strong> - Director Information</h3>
                                    @include('franchise::forms.director_info', ['director' => $director ? $director : '', 'country' => $franchise ? $franchise->country : ''])
                                </div>
                                <div class="tab-pane" id="tab3">
                                    <br>
                                    <h3><strong>Step 3</strong> - Contact Details</h3>
                                    @include('franchise::forms.contact_details', ['franchise' => $franchise ? $franchise : ''])
                                </div>
                                <div class="tab-pane" id="tab4">
                                    <br>
                                    <h3><strong>Step 4</strong> - Business Rules</h3>
                                    @include('franchise::forms.business_rules', ['franchise' => $franchise ? $franchise : ''])
                                </div>
                                <div class="tab-pane" id="tab5">
                                    <br>
                                    <h3><strong>Step 5</strong> - Confirming</h3>
                                    <br>
                                    <button id="btn_upload_document" class="btn btn-primary"><i class="fa fa-upload"></i> Upload New Document</button>
                                    <div id="doc_list">
                                        @include('franchise::documents', ['documents' => $franchise ? $franchise->documents : collect([])])
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab6">
                                    <br>
                                    <h3><strong>Step 6</strong> - Confirming</h3>
                                    @include('franchise::forms.confirming', ['franchise' => $franchise ? $franchise : ''])
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
                <!-- end widget content -->

            </div>
            <!-- end widget div -->

        </div>
        <!-- end widget -->

    </article>

    <div class="form-group">
        <div class="label">

        </div>
    </div>

    @include('franchise::forms.document', ['doc_types' => $doc_types])

@stop
