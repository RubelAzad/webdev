{!! Form::open(['url' => url('franchise/update-business-info'), 'class' => 'form-horizontal', 'id' => 'frm_business_info']) !!}

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('account', 'Account/Company<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('account', $franchise ? $franchise->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ch_number', 'CH Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('ch_number', $franchise ? $franchise->ch_number : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('vat_number', 'VAT Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('vat_number', $franchise ? $franchise->vat_number : '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('country', 'Country<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('country', $countries, $franchise ? $franchise->country : '', ['class' => 'form-control select2', 'placeholder' => 'Select a country', 'required' => 'required']) !!}
    </div>
</div>

<div id="address_div" class="form-group" style="display: none">
    <label class="control-label col-md-4">Address Lookup</label>
    <div id="postcode_lookup" class="col-md-8 well well-sm well-light bg-color-blueDark">

    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('address_line_1', $franchise ? $franchise->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address_line_2', 'Address Line 2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('address_line_2', $franchise ? $franchise->address_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address_line_3', 'Address Line 3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('address_line_3', $franchise ? $franchise->address_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('city', 'City<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('city', $franchise ? $franchise->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('county', 'County/Province', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('county', $franchise ? $franchise->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('postcode', $franchise ? $franchise->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
{!! Form::close() !!}