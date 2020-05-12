@extends('cargo::layouts.master')

@push('style')
<link rel="stylesheet" href="{{url('doc_viewer/css/style.css')}}">
<link rel="stylesheet" href="{{url(Module::asset('cargo:css/stripe.css'))}}">
<link rel="stylesheet" href="{{url(Module::asset('cargo:css/shipment/create.css'))}}">
@endpush
@push('scripts')

<script src="https://getaddress.io/js/jquery.getAddress-2.0.1.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="{{url('magic/js/plugin/bootstrap-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
<script src="{{url(Module::asset('cargo:js/shipment/create.js'))}}"></script>
<script>
    let draft_id = '{{$draft ? $draft->id : ''}}';
    let mass_divider = '{{get_settings('mass_divider', '5000')}}';
    let vat_percentage = '{{get_settings('vat', 0)}}';

    let strip_api = '{{env('STRIPE_KEY')}}';
    // Create a Stripe client.
    let stripe = Stripe(strip_api);

    // Create an instance of Elements.
    let elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    let style = {
        base: {
            color: '#32325d',
            lineHeight: '18px',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    valid_this_form('#frm_payment');

</script>

@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Create Shipment
@endsection

@section('breadcrumb')
    <li><a href="{{url('cargo')}}"><i class="fa fa-archive"></i> Management Shipments</a></li>
    <li class="active">Create Shipment</li>
@endsection

@section('content')

    @php
        $optionals = '';
        if($draft){
            if( $draft->optionals ){
                $optionals = json_decode($draft->optionals);
            }
        }
    @endphp

    <input type="hidden" id="draft_id" value="{{$draft ? $draft->id : ''}}">

    <div class="row">
        <article class="col-xs-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-new-franchise" data-widget-sortable="false" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"><i class="fa fa-sitemap"></i> </span>
                    <h2>Create Shipment </h2>
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
                                <div id="wizard-head" class="form-bootstrapWizard">
                                    <ul class="bootstrapWizard form-wizard">
                                        <li class="active" data-target="#step1"><a href="#tab1" data-toggle="tab"> <span class="step">1</span> <span class="title">Sender Details</span> </a></li>
                                        <li data-target="#step2"><a href="#tab2" data-toggle="tab"> <span class="step">2</span> <span class="title">Receiver Details</span> </a></li>
                                        <li data-target="#step3"><a href="#tab3" data-toggle="tab"> <span class="step">3</span> <span class="title">Package Details</span> </a></li>
                                        <li data-target="#step4"><a href="#tab4" data-toggle="tab"> <span class="step">4</span> <span class="title">Select Service</span> </a></li>
                                        <li data-target="#step5"><a href="#tab5" data-toggle="tab"> <span class="step">5</span> <span class="title">Additional Options</span> </a></li>
                                        <li data-target="#step6"><a href="#tab6" data-toggle="tab"> <span class="step">6</span> <span class="title">Confirm</span> </a></li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                        <br>
                                        <h3><strong>Step 1 </strong> - Sender Details</h3>
                                        @include('cargo::shipment.sender', ['sender' => $draft ? $draft->sender : ''])
                                        @include('cargo::shipment.senders-modal')
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <br>
                                        <h3><strong>Step 2</strong> - Receiver Details</h3>
                                        @include('cargo::shipment.receiver', ['receiver' => $draft && $draft->receiver ? $draft->receiver : ''])
                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        <br>
                                        <h3><strong>Step 3</strong> - Package Details</h3>
                                        <input type="hidden" id="package_added" value="{{$draft && $draft->packages ? count(json_decode($draft->packages)) : 0}}">
                                        @include('cargo::shipment.package', [])
                                        <hr>
                                        <div class="panel panel-info">
                                            <table id="tbl_package_details" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Package Type</th>
                                                    <th class="center">Quantity</th>
                                                    <th class="center">Weight</th>
                                                    <th class="center">Length</th>
                                                    <th class="center">Width</th>
                                                    <th class="center">Height</th>
                                                    <th class="center">Volume</th>
                                                    <th class="center">Actual Weight</th>
                                                    <th class="center">Final weight</th>
                                                    <th class="center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @include('cargo::shipment.package-table', ['packages' => $draft ? json_decode($draft->packages) : '', 'draft_id' => $draft ? $draft->id :''])
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                        <br>
                                        <h3><strong>Step 4</strong> - Select Service</h3>
                                        <input type="hidden" value="" name="service_selected" id="service_selected">
                                        <input type="hidden" value="" name="service_provider" id="service_provider">
                                        <table id="tbl_services" class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Service</th>
                                                <th>Description</th>
                                                <th class="center">Net Weight</th>
                                                <th class="center">Gross Weight</th>
                                                <th class="center">Total Price</th>
                                                <th class="center"></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <br>
                                        <h3><strong>Step 5</strong> - Additional Options</h3>
                                        <div class="row">
                                            {{--<div class="col-sm-6">
                                                <div class="panel panel-success">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <label for="" class="col-xs-12" style="font-size: 1.2em">
                                                                Selected Service: <span id="selected_service_info" class="form-control-static form-control"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>--}}
                                            <div class="col-sm-9">
                                                <div class="panel panel-success">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <label class="col-xs-12" style="font-size: 1.2em">Pickup Charge: <a href="#" rel="tooltip" title="A cost if you have picked up the parcel from customer address"><i class="fa fa-info-circle text-warning"></i></a>
                                                                <input type="number" id="pickup_charge" min="0" class="form-control" value="{{$optionals && isset($optionals->pickup_cost) ? $optionals->pickup_cost : ''}}">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                @include('cargo::shipment.declarable', ['draft' => $draft])
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="panel panel-success">
                                                    @php
                                                        $delivery = [];
                                                        if($draft){
                                                            if( $draft->delivery ){
                                                                $delivery = collect(json_decode($draft->delivery));
                                                            }
                                                        }
                                                    //dd($delivery);
                                                    @endphp
                                                    <div class="panel-heading">
                                                        <h4>
                                                            <input id="chk_delivery" data-off-title="Collection" data-on-title="Delivery" type="checkbox" {{$delivery && $delivery->has('delivery') && $delivery->get('delivery') ? 'checked' : ''}}>
                                                        </h4>
                                                    </div>
                                                    <div id="div_delivery_details" class="panel-body" style="{{$delivery && $delivery->has('delivery') && $delivery->get('delivery') ? '' : 'display:none'}}">
                                                        @if($draft)
                                                            @if($delivery && $delivery->has('receiver'))
                                                                @include('cargo::shipment.delivery', ['receiver' => json_decode($draft->delivery)])
                                                            @else
                                                                @if($draft->receiver)
                                                                    @include('cargo::shipment.delivery', ['receiver' => $draft->receiver])
                                                                @else
                                                                    @include('cargo::shipment.delivery', ['receiver' => ''])
                                                                @endif
                                                            @endif
                                                        @else
                                                            @include('cargo::shipment.delivery', ['receiver' => ''])
                                                        @endif
                                                    </div>
                                                    <div id="div_collection_details" class="panel-body" style="{{$delivery && $delivery->has('delivery') && $delivery->get('delivery') ? 'display: none' : ''}}">
                                                        @include('cargo::shipment.collection', ['agent' => ''])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="panel panel-success">
                                                    @php($insurance = $draft ? $draft->insurance : '')

                                                    <div class="panel-heading">
                                                        <h4><label><input id="chk_insurance" type="checkbox" {{$insurance ? 'checked' : ''}}> Insurance</label></h4>
                                                    </div>
                                                    <div id="div_insurance_details" class="panel-body" style="{{$insurance ? '' : 'display: none'}}">

                                                        @if(get_settings('insurance_notice',''))
                                                            <div class="alert alert-info">
                                                                <p>{!! get_settings('insurance_notice','') !!}</p>
                                                            </div>
                                                        @endif

                                                        <button id="btn_refresh_insurance" class="btn btn-primary">Refresh Insurance Table</button>

                                                        <table class="table table-bordered">
                                                            <thead>
                                                            <tr>
                                                                <th>Cover</th>
                                                                <th>Item</th>
                                                                <th class="center">Value</th>
                                                                <th class="center">Insurance Price</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="insurance_table">
                                                            @include('cargo::shipment.insurance-table',
                                                            [
                                                                'items' => $draft && $draft->insurance ? json_decode($draft->insurance) : [],
                                                                'draft_id' => $draft ? $draft->id : ''
                                                            ])
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="panel panel-success">
                                                    @if($optionals && property_exists($optionals, 'packaging'))
                                                        <div class="panel-heading">
                                                            <h4><label><input id="chk_additional_packaging" type="checkbox" {{$optionals && $optionals->packaging ? 'checked' : ''}}> Additional Packaging</label></h4>
                                                        </div>
                                                        <div id="div_additional_packaging" class="panel-body" style="{{$optionals && $optionals->packaging ? '' : 'display: none'}}">
                                                            {!! Form::open(['id' => 'frm_additional_packaging', 'class' => 'form-horizontal', 'url' => 'cargo/update-additional-packaging']) !!}

                                                            <div id="" class="form-group">
                                                                {!! Form::label('additional_packaging_price', 'Price*', ['class' => 'col-sm-3 control-label']) !!}
                                                                <div class="col-sm-8">
                                                                    {!! Form::number('additional_packaging_price', $optionals && isset($optionals->packaging_price) ? $optionals->packaging_price : '', ['class' => 'form-control', 'required' => 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div id="" class="form-group">
                                                                {!! Form::label('additional_packaging_description', '*Description', ['class' => 'col-sm-3 control-label']) !!}
                                                                <div class="col-sm-8">
                                                                    {!! Form::textarea('additional_packaging_description', $optionals && isset($optionals->packaging_description) ? $optionals->packaging_description : '', ['class' => 'form-control', 'required' => 'required', 'rows' => '2']) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::label('', '', ['class' => 'col-sm-3 control-label']) !!}
                                                                <div class="col-sm-8">
                                                                    <div class="col-md-4">
                                                                        <button id="btn_update_additional_packaging" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div id="additional_packaging_status" class="alert"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @else
                                                        <div class="panel-heading">
                                                            <h4><label><input id="chk_additional_packaging" type="checkbox"}}> Additional Packaging</label></h4>
                                                        </div>
                                                        <div id="div_additional_packaging" class="panel-body" style="display: none">
                                                            {!! Form::open(['id' => 'frm_additional_packaging', 'class' => 'form-horizontal', 'url' => 'cargo/update-additional-packaging']) !!}

                                                            <div id="" class="form-group">
                                                                {!! Form::label('additional_packaging_price', 'Price*', ['class' => 'col-sm-3 control-label']) !!}
                                                                <div class="col-sm-8">
                                                                    {!! Form::number('additional_packaging_price', '', ['class' => 'form-control', 'required' => 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div id="" class="form-group">
                                                                {!! Form::label('additional_packaging_description', '*Description', ['class' => 'col-sm-3 control-label']) !!}
                                                                <div class="col-sm-8">
                                                                    {!! Form::textarea('additional_packaging_description', '', ['class' => 'form-control', 'required' => 'required', 'rows' => '2']) !!}
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                {!! Form::label('', '', ['class' => 'col-sm-3 control-label']) !!}
                                                                <div class="col-sm-8">
                                                                    <div class="col-md-4">
                                                                        <button id="btn_update_additional_packaging" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        <div id="additional_packaging_status" class="alert"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {!! Form::close() !!}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <br>
                                        <h3><strong>Step 6</strong> - Confirming
                                            <button id="print_summary" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print Draft Invoice</button>
                                        </h3>
                                        <div id="summary">
                                            {{--@if($draft)--}}
                                                {{--@include('cargo::shipment.summary', ['draft' => $draft])--}}
                                            {{--@endif--}}

                                        </div>

                                        <div class="panel panel-danger">
                                            <div class="panel-heading">Payment & Confirmation</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        {!! Form::open(['id' => 'frm_payment', 'class' => 'form-horizontal', 'url' => url('post/create')]) !!}
                                                        <div class="form-group">
                                                            {!! Form::label('payment_method', 'Payment Method', ['class' => 'control-label col-sm-4']) !!}
                                                            <div class="col-sm-8">
                                                                {!! Form::select('payment_method', get_payment_methods()->prepend('',''), '', ['class' => 'form-control', 'required' => 'required']) !!}
                                                            </div>
                                                        </div>
                                                        <div id="div-ard-details" class="form-group" style="display: none">
                                                            {!! Form::label('', 'Enter Card details', ['class' => 'col-sm-4 label-control text-right']) !!}
                                                            <div class="col-sm-8">
                                                                <div id="card-element"></div>
                                                                <div id="card-errors" role="alert"></div>
                                                            </div>
                                                        </div>
                                                        <div id="div-payment-ref" class="form-group">
                                                            {!! Form::label('payment_reference', 'Payment Reference', ['class' => 'control-label col-sm-4']) !!}
                                                            <div class="col-sm-8">
                                                                {!! Form::text('payment_reference', '', ['class' => 'form-control']) !!}
                                                            </div>
                                                        </div>
                                                        <div id="div-payment-ref" class="form-group">
                                                            {!! Form::label('note', 'Note', ['class' => 'control-label col-sm-4']) !!}
                                                            <div class="col-sm-8">
                                                                {!! Form::textarea('note', '', ['class' => 'form-control', 'rows' => 2]) !!}
                                                            </div>
                                                        </div>
                                                        {!! Form::close() !!}
                                                    </div>
                                                    <div class="col-sm-12 center">
                                                        <p><input type="checkbox" id="final_confirm"> I confirm, All above information is correct.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    </div>


@stop
