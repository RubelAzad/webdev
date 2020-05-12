{!! Form::open(['id' => 'frm_warehouse', 'class' => 'form-horizontal', 'url' => url('warehouse/update')]) !!}

{!! Form::hidden('house_id', $house ? $house->id : '', ['id' => 'house_id']) !!}

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => 'control-label col-sm-4'])) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('name', $house ? $house->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('add_line_1', '<span class="star">*</span>Address Line 1', ['class' => 'control-label col-sm-4'])) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('add_line_1', $house ? $house->add_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('add_line_2', 'Address Line 2', ['class' => 'control-label col-sm-4']) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('add_line_2', $house ? $house->add_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('add_line_3', 'Address Line 3', ['class' => 'control-label col-sm-4']) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('add_line_3', $house ? $house->add_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('city', '<span class="star">*</span>City', ['class' => 'control-label col-sm-4'])) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('city', $house ? $house->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('county', 'County', ['class' => 'control-label col-sm-4']) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('county', $house ? $house->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('postcode', '<span class="star">*</span>Postcode', ['class' => 'control-label col-sm-4'])) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('postcode', $house ? $house->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('country_code', '<span class="star">*</span>Country', ['class' => 'control-label col-sm-4'])) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::select('country_code', array_add(get_countries_for_select_2(), '', ''), $house ? $house->country_code : '', ['class' => 'form-control', 'required' => 'required', 'data-placeholder' => 'Select Country']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number', ['class' => 'control-label col-sm-4']) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('phone_number', $house ? $house->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('email', 'Email', ['class' => 'control-label col-sm-4']) !!}
    <div class="col-sm-7 col-md-6">
        {!! Form::text('email', $house ? $house->email : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
{!! Form::close() !!}