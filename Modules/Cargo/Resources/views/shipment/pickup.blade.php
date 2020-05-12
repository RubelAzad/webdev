{!! Form::open(['url' => url('cargo/add-pickup'), 'class' => 'form-horizontal', 'id' => 'frm_add-pickup']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_name', 'Account/Company<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_name', $sender ? $sender->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_country', 'Country<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('pickup_country', get_countries_for_select(), $sender ? $sender->country : '', ['class' => 'form-control select2', 'required' => 'required']) !!}
    </div>
</div>

<div id="pickup_address_div" class="well well-sm" style="display: none">
    <div class="form-group">
        <label class="control-label col-md-4">Address Lookup</label>
        <div class="col-md-8">
            <div id="pickup_postcode_lookup"></div>
        </div>
    </div>
</div>


<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_address_line_1', $sender ? $sender->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('pickup_address_line_2', 'Address Line 2', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_address_line_2', $sender ? $sender->address_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('pickup_address_line_3', 'Address Line 3', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_address_line_3', $sender ? $sender->address_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_city', 'City<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_city', $sender ? $sender->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('pickup_county', 'County/Province', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_county', $sender ? $sender->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_postcode', $sender ? $sender->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_contact_person', 'Contact Person<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_contact_person', $sender ? $sender->contact_person : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_phone_number', 'Phone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_phone_number', $sender ? $sender->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('pickup_email', 'Email', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::email('pickup_email', $sender ? $sender->email : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('pickup_instruction', 'Instruction for driver', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('pickup_instruction', '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('pickup_cost', 'Cost<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('pickup_cost', '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
{!! Form::close() !!}
