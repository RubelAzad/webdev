{!! Form::open(['url' => url('cargo/create-sender'), 'class' => 'form-horizontal', 'id' => 'frm_create_sender']) !!}
{!! Form::hidden('sender_id', $sender ? $sender->id : '', ['id' => 'sender_id']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_account', 'Company Name<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-5">
        {!! Form::text('sender_account', $sender ? $sender->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-sm-2">
        <button id="lookup_sender" class="btn btn-primary pull-right"><i class="fa fa-search"></i> Lookup </button>
    </div>
    <div class="col-sm-1">
        <button id="new_sender" type="reset" class="btn btn-primary pull-left"> New </button>
    </div>
</div>

@if(strtolower($agent->country) == strtolower('gbr'))
<div id="sender_address_div" class="">
    <div class="form-group">
        <label class="control-label col-sm-3">Address Lookup</label>
        <div class="col-sm-8">
            <div id="sender_postcode_lookup"></div>
        </div>
    </div>
</div>
@endif


<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_address_line_1', $sender ? $sender->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('sender_address_line_2', 'Address Line 2', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_address_line_2', $sender ? $sender->address_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('sender_address_line_3', 'Address Line 3', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_address_line_3', $sender ? $sender->address_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_city', 'City<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_city', $sender ? $sender->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('sender_county', 'County/Province', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_county', $sender ? $sender->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_postcode', $sender ? $sender->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_country', 'Country<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::select('sender_country', get_countries_for_select(), $sender ? $sender->country : $agent->country, ['class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_contact_person', 'Contact Person<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_contact_person', $sender ? $sender->contact_person : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('sender_phone_number', 'Phone Number<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('sender_phone_number', $sender ? $sender->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('sender_email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::email('sender_email', $sender ? $sender->email : '', ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}
