<fieldset>
    <div class="form-group">
        {!! Form::label('src_country', 'Sending from', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            {!! Form::select('src_country', array_add(get_sending_countries(), '', ''), '', ['class' => 'form-control chosen', 'data-placeholder' => 'Select a country', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('dst_country', 'Sending to', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            {!! Form::select('dst_country', [], '', ['class' => 'form-control', 'data-placeholder' => 'Select a country', 'required' => 'required']) !!}
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


    <div class="form-group">
        {!! Form::label('declare_value', 'Declare value (General goods)', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            {!! Form::number('declare_value', '0', ['class' => 'form-control', 'placeholder' => 'Enter amount']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('', 'Valuable items (Excluding weight charge)', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="panel panel-default">

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
                        {{--@include('cargo::quote.valuables', ['i' => 1])--}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('', 'Add insurance', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <div class="form-group">
                {!! Form::checkbox('insurance', 'insurance', '', ['class' => 'switch', 'id' => 'insurance']) !!}
            </div>
            <div id="div_cover_all_item" class="form-group" style="display: none">
                {!! Form::checkbox('cover_all', 'cover_all', '', ['id' => 'cover_all']) !!}
            </div>
        </div>
    </div>

    <hr>
    <div class="form-group">
        {!! Form::label('', '', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <button id="btn_get_quote" class="btn btn-xl btn-primary">Get Quote</button>
        </div>
    </div>


</fieldset>