@extends('cargo::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('cargo:js/quote/index.js'))}}"></script>
@endpush

@section('content')

    <div class="container">
        {!! Form::open(['id' => 'frm_get_quote', 'class' => '']) !!}
        <div class="row">
            {!! Form::hidden('src_country_code', $agent->country, ['id' => 'src_country_code']) !!}
            <div class="col-xs-12">
                <div class="col-sm-6 no-padding-left">
                    <div class="form-group">
                        {!! Form::label('to_country_code', '*Destination country', ['class' => '']) !!}
                        {!! Form::select('to_country_code', get_countries_by_src_for_select($agent->country)->prepend('', ''), '', ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                </div>
            </div>
        </div>


        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="panel-title">Packages</h3></div>
            <div class="panel-body no-padding">
                <input type="hidden" id="package_row_number" value="1">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Package type</th>
                        <th class="center">Weight</th>
                        <th class="center">Length</th>
                        <th class="center">Width</th>
                        <th class="center">Height</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="package_fields">
                    @include('cargo::quote.package-fields', ['i' => 1])
                    </tbody>
                </table>
                <div class="row" style="padding-left: 10px">
                    <div class="col-xs-12" style="padding-left: 10px">
                        <button id="btn_add_package" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add another package</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-sm-3" style="padding-left: 6px">
                            <div class="form-group">
                                {!! Form::label('declare_value', 'Declare value (General goods)', ['class' => '']) !!}
                                {!! Form::number('declare_value', '0', ['class' => 'form-control', 'placeholder' => 'Enter amount']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Valuable items
                    <small>(Excluding weight charge)</small>
                </h3>
            </div>
            <div class="panel-body no-padding">
                <input type="hidden" id="item_row_number" value="1">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Item name</th>
                            <th class="center">Item value</th>
                            <th class="center">Shipment cost</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="item_fields">
                    @include('cargo::quote.valuables', ['i' => 1])
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-xs-12">
            <div class="col-sm-6 no-padding-left">
                <div class="form-group">
                    {!! Form::label('', 'Is insurance required?', ['class' => '']) !!}
                    {!! Form::checkbox('insurance', 'insurance', '', ['class' => 'switch', 'id' => 'insurance']) !!}
                </div>
                <div id="div_cover_all_item" class="form-group" style="display: none">
                    {!! Form::checkbox('cover_all', 'cover_all', '', ['id' => 'cover_all']) !!}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 center">
                <button id="btn_get_quote" class="btn btn-xl btn-primary">Get Quote</button>
            </div>
        </div>

        {!! Form::close() !!}

    </div>

@endsection