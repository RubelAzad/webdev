{!! Form::open(['url' => url('franchise/update-contact-info'), 'class' => 'form-horizontal', 'id' => 'frm_contact_info']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('contact_person', 'Contact Person<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('contact_person', $franchise ? $franchise->contact_person : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('phone_number', 'Telephone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('phone_number', $franchise ? $franchise->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('ev_phone_number', 'Day/Night Phone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('ev_phone_number', $franchise ? $franchise->ev_phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('fax_number', 'Fax Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('fax_number', $franchise ? $franchise->fax_number : '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('email', 'Email<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::email('email', $franchise ? $franchise->email : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
{!! Form::close() !!}