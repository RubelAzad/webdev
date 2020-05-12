{!! Form::open(['url' => url('cargo/create-receiver'), 'class' => 'form-horizontal', 'id' => 'frm_create_receiver']) !!}
{!! Form::hidden('receiver_id', $receiver ? $receiver->id : '', ['id' => 'receiver_id']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_account', 'Account/Company<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-5">
        {!! Form::text('receiver_account', $receiver ? $receiver->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_country', 'Country<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::select('receiver_country', get_countries_by_src_for_select($agent->country), $receiver ? $receiver->country : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_address_line_1', $receiver ? $receiver->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('receiver_address_line_2', 'Address Line 2', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_address_line_2', $receiver ? $receiver->address_line_2 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('receiver_address_line_3', 'Address Line 3', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_address_line_3', $receiver ? $receiver->address_line_3 : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_city', 'City<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_city', $receiver ? $receiver->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('receiver_county', 'County/Province', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_county', $receiver ? $receiver->county : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_postcode', $receiver ? $receiver->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_contact_person', 'Contact Person<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_contact_person', $receiver ? $receiver->contact_person : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_phone_number', 'Phone Number<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::text('receiver_phone_number', $receiver ? $receiver->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('receiver_email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::email('receiver_email', $receiver ? $receiver->email : '', ['class' => 'form-control']) !!}
    </div>
</div>
{!! Form::close() !!}

<div class="center">
    <button id="btn_update_receiver" class="btn btn-primary"><i class="fa fa-save"></i> Update Receiver</button>
    <button id="btn_cancel_update_receiver" class="btn btn-danger"><i class="fa fa-times"></i> Cancel</button>
</div>
