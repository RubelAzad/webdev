{!! Form::open(['url' => url('cargo/update-collection'), 'class' => 'form-horizontal', 'id' => 'frm_add_collection']) !!}

<div class="form-group">
    {!! Form::label('agent_id', 'Select Location', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('agent_id', [], '', ['class' => 'form-control collection_location', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('collection_price', 'Price*', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::number('collection_price', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('', '', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <div class="col-md-4">
            <button id="btn_update_collection_address" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        </div>
        <div class="col-md-8">
            <div id="collection_address_status" class="alert"></div>
        </div>
    </div>
</div>
{!! Form::close() !!}
