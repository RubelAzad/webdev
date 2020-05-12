{!! Form::open(['class' => 'form-horizontal', 'url' => url('settings/update-billing')]) !!}

<fieldset>
    <legend>Website Selling</legend>
    <div class="form-group">
        {!! Form::label('commission_increment', 'Commission (%)', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('commission_increment', get_settings('commission_increment', 0), ['class' => 'form-control']) !!}
        </div>
    </div>

</fieldset>

<fieldset>
    <legend>Insurance</legend>
    <div class="form-group">
        {!! Form::label('insurance', 'Default insurance (%)', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('insurance', get_settings('insurance', 0), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('max_insurance', 'Maximum insurance (%)', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('max_insurance', get_settings('max_insurance', 0), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('insurance_commission', 'Distribute insurance commission(%)', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('insurance_commission', get_settings('insurance_commission', 0), ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('insurance_commission_franchise', 'Insurance commission for franchise (%)', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('insurance_commission_franchise', get_settings('insurance_commission_franchise', 0), ['class' => 'form-control', 'min' => 0, 'max' => 80]) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('insurance_commission_agent', 'Insurance commission for agent (%)', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-7">
            {!! Form::text('insurance_commission_agent', get_settings('insurance_commission_agent', 0), ['class' => 'form-control', 'min' => 0, 'max' => 80]) !!}
        </div>
    </div>
</fieldset>

<div class="form-group">
    {!! Form::label('', '', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-7">
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
    </div>
</div>
{!! Form::close() !!}