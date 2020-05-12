{!! Form::open(['url' => url('cargo/update-delivery'), 'class' => 'form-horizontal', 'id' => 'frm_add_delivery']) !!}
<div class="form-group">
    {!! Form::label('', 'Same as receiver address', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <input type="checkbox" name="delivery_to_receiver" id="delivery_to_receiver" {{$receiver && $receiver->receiver ? 'checked' : ''}}>
    </div>
</div>

<div id="delivery_address" style="{{$receiver && $receiver->receiver ? 'display: none' : ''}}">
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_account', 'Account/Company<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_account', $receiver ? $receiver->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_country', 'Country<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::select('delivery_country', get_countries_for_select(), $receiver ? $receiver->country : '', ['class' => 'form-control select2', 'required' => 'required']) !!}
        </div>
    </div>

    <div id="delivery_address_div" class="well well-sm" style="display: none">
        <div class="form-group">
            <label class="control-label col-sm-3">Address Lookup</label>
            <div class="col-sm-8">
                <div id="delivery_postcode_lookup"></div>
            </div>
        </div>
    </div>


    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_address_line_1', 'Address Line 1<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_address_line_1', $receiver ? $receiver->address_line_1 : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('delivery_address_line_2', 'Address Line 2', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_address_line_2', $receiver ? $receiver->address_line_2 : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('delivery_address_line_3', 'Address Line 3', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_address_line_3', $receiver ? $receiver->address_line_3 : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_city', 'City<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_city', $receiver ? $receiver->city : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('delivery_county', 'County/Province', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_county', $receiver ? $receiver->county : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_postcode', 'Postcode<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_postcode', $receiver ? $receiver->postcode : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_contact_person', 'Contact Person<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_contact_person', $receiver ? $receiver->contact_person : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('delivery_phone_number', 'Phone Number<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
        <div class="col-sm-8">
            {!! Form::text('delivery_phone_number', $receiver ? $receiver->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('delivery_email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-8">
            {!! Form::email('delivery_email', $receiver ? $receiver->email : '', ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('delivery_instruction', 'Instruction for driver', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::textarea('delivery_instruction', $receiver && $receiver->instruction ? $receiver->instruction : '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('delivery_agent_id', 'Nearest Agent Location', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        {!! Form::select('delivery_agent_id', [], '', ['class' => 'form-control delivery_location', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('delivery_price', 'Price<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::number('delivery_price', $receiver && $receiver->price ? $receiver->price : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('', '', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-8">
        <div class="col-md-4">
            <button id="btn_update_delivery_address" class="btn btn-primary"><i class="fa fa-save"></i> Update</button>
        </div>
        <div class="col-md-8">
            <div id="delivery_address_status" class="alert"></div>
        </div>
    </div>
</div>
{!! Form::close() !!}
