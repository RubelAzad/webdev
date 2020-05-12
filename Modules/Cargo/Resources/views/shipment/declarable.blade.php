<div class="panel panel-info">
    <div class="panel-heading">
        {!! Form::open(['id' => 'frm_add_declarable', 'class' => 'form-horizontal ', 'url' => url('cargo/add-declarable')]) !!}
        {!! Form::hidden('total_declare_value', $draft ? $draft->items ? array_sum(array_pluck(json_decode($draft->items), 'value')) : '': '', ['id' => 'total_declare_value']) !!}
        <fieldset>
            <legend>
                Valuable Items
                <a href="#" rel="tooltip" title="Total value of declare items must not be grater than actual declare value!"><i class="fa fa-info-circle fa-lg fa-fw text-warning"></i></a>
            </legend>
        </fieldset>
        <div class="form-group row">
            <div class="col-sm-4">
                <select id="valuable_item_id" name="valuable_item_id" class="form-control" required="required">

                </select>
            </div>
            <div class="col-sm-3">
                {!! Form::number('valuable_item_value', '', ['id' => 'valuable_item_value', 'class' => 'form-control', 'placeholder' => 'Purchase Price', 'required' => 'required']) !!}
            </div>
            <div class="col-sm-3">
                {!! Form::number('valuable_item_cost', '', ['id' => 'valuable_item_cost', 'class' => 'form-control', 'placeholder' => 'Cost', 'required' => 'required']) !!}
            </div>
            <div class="col-sm-2">
                <button id="btn_add_declarable" class="btn btn-sm btn-primary"><i class="fa fa-arrow-down"></i> Add</button>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
    <div id="div_declarable" class="panel-body no-padding">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Item Name</th>
                <th class="center">Value</th>
                <th class="center">Shipment Cost</th>
                <th class="center"></th>
            </tr>
            </thead>
            <tbody>
            @include('cargo::shipment.declarable-table', ['items' => $draft ? json_decode($draft->items) : '', 'draft_id' => $draft ? $draft->id : ''])
            </tbody>
        </table>
    </div>
</div>
