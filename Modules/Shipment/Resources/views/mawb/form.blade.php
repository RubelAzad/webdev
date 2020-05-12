{!! Form::open(['id' => 'frm_hawb', 'class' => 'form-horizontal', 'url' => url('shipment/update-mawb')]) !!}
{!! Form::hidden('mawb_id', $mawb ? $mawb->id : '', ['id' => 'mawb_id']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('max_weight', '<span class="star">*</span>Max Weight', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('max_weight', $mawb ? $mawb->max_weight : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('flight_no', '<span class="star">*</span>Flight No', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('flight_no', $mawb ? $mawb->flight_no : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('flight_date', '<span class="star">*</span>Flight Date', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-6">
        <div class="input-group">
            {!! Form::text('flight_date', $mawb ? $mawb->flight_date->format('d/m/Y') : '', ['class' => 'form-control', 'autocomplete' => 'off', 'required' => 'required']) !!}
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        </div>
    </div>
</div>
{!! Form::close() !!}