{!! Form::open(['url' => url('cargo/create-receiver'), 'class' => 'form-horizontal', 'id' => 'frm_create_receiver']) !!}
{!! Form::hidden('receiver_id', $receiver ? $receiver->id : '', ['id' => 'receiver_id']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_account', 'Account/Company<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-5">
        {!! Form::text('receiver_account', $receiver ? $receiver->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-sm-2">
        <button id="lookup_receiver" class="btn btn-primary"><i class="fa fa-search"></i> Lookup </button>
    </div>
    <div class="col-sm-1">
        <button type="button" class="btn btn-primary">New </button>
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('receiver_country', 'Country<span class="star">*</span>', ['class' => 'col-sm-3 control-label'])) !!}
    <div class="col-sm-8">
        {!! Form::select('receiver_country', get_countries_by_src_for_select($agent->country), $receiver ? $receiver->country : '', ['class' => 'form-control select2', 'required' => 'required']) !!}
    </div>
</div>

<div id="receiver_address_div" class="well well-sm" style="display: none">
    <div class="form-group">
        <label class="control-label col-sm-3">Address Lookup</label>
        <div class="col-sm-8">
            <div id="receiver_postcode_lookup"></div>
        </div>
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

<div class="modal fade" id="mdl_receiver" style="overflow:hidden;" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times fa-fw"></i> </span></button>
                <h4 class="modal-title" id="myModalLabel">Lookup Receiver</h4>
            </div>
            <div class="modal-body">
                <table id="tbl_receiver_list" class="table table-bordered table-condensed" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th class="center">Postcode</th>
                        <th class="center">Phone Number</th>
                        <th class="center">Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="select_receiver" type="button" class="btn btn-primary">Select</button>
            </div>
        </div>
    </div>
</div>