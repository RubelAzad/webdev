{!! Form::open(['url' => url('agent/update-employee'), 'class' => 'form-horizontal', 'id' => 'frm_employee']) !!}
{!! Form::hidden('employee_id', '', ['id' => 'employee_id']) !!}

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('officer_type_id', 'Employee Designation<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('officer_type_id', get_employee_designations_for_select(), '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_name', 'Name<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_name', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_country', 'Country<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('director_country', $countries, $country, ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) !!}
    </div>
</div>

@if($country == 'GBR')
<div id="director_address_div" class="form-group">
    <label class="control-label col-md-4">Address Lookup</label>
    <div id="director_postcode_lookup" class="col-md-8"></div>
</div>
@endif

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_address_line_1', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_address_line_2', 'Address Line 2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('director_address_line_2', '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_address_line_3', 'Address Line 3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('director_address_line_3', '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_city', 'City<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_city', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_county', 'County/Province', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('director_county', '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_postcode', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_phone_number', 'Phone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_phone_number', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::email('director_email', '', ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}