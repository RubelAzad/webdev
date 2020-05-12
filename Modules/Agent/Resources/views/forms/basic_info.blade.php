{!! Form::open(['url' => url('agent/update-business-info'), 'class' => 'form-horizontal', 'id' => 'frm_business_info']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('account', 'Account/Company<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('account', $agent ? $agent->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('ch_number', 'CH Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('ch_number', $agent ? $agent->ch_number : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('vat_number', 'VAT Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('vat_number', $agent ? $agent->vat_number : '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('country', 'Country<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('country', $countries, $agent ? $agent->country : '', ['class' => 'form-control select2', 'placeholder' => 'Select a country', 'required' => 'required']) !!}
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
        {!! Form::text('address_line_1', $agent ? $agent->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address_line_2', 'Address Line 2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('address_line_2', $agent ? $agent->address_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('address_line_3', 'Address Line 3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('address_line_3', $agent ? $agent->address_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('city', 'City<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('city', $agent ? $agent->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('county', 'County/Province', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('county', $agent ? $agent->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('postcode', $agent ? $agent->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
{!! Form::close() !!}