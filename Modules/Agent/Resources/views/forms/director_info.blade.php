{!! Form::open(['url' => url('agent/add_new_officer'), 'class' => 'form-horizontal', 'id' => 'frm_director_info']) !!}
{!! Form::hidden('officer_type_id', get_designation_id_by_name('director'), ['id' => 'officer_type_id']) !!}
{!! Form::hidden('employee_id', $director ? $director->id : '', ['id' => 'employee_id']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_name', 'Director Name<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_name', $director ? $director->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_country', 'Country<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('director_country', $countries, $director ? $director->country : '', ['class' => 'form-control', 'disabled' => 'disabled', 'required' => 'required']) !!}
    </div>
</div>

<div id="director_address_div" class="form-group" >
    <label class="control-label col-md-4">Address Lookup</label>
    <div id="director_postcode_lookup" class="col-md-8"></div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_address_line_1', $director ? $director->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_address_line_2', 'Address Line 2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('director_address_line_2', $director ? $director->address_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_address_line_3', 'Address Line 3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('director_address_line_3', $director ? $director->address_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_city', 'City<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_city', $director ? $director->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_county', 'County/Province', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('director_county', $director ? $director->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_postcode', $director ? $director->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('director_phone_number', 'Phone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('director_phone_number', $director ? $director->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('director_email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::email('director_email', $director ? $director->email : '', ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}