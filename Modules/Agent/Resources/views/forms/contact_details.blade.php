{!! Form::open(['url' => url('agent/update-contact-info'), 'class' => 'form-horizontal', 'id' => 'frm_contact_info']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('contact_person', 'Contact Person<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('contact_person', $agent ? $agent->contact_person : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('phone_number', 'Telephone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('phone_number', $agent ? $agent->phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('ev_phone_number', 'Day/Night Phone Number<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('ev_phone_number', $agent ? $agent->ev_phone_number : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('fax_number', 'Fax Number', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('fax_number', $agent ? $agent->fax_number : '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('email', 'Email<span class="star">*</span>', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::email('email', $agent ? $agent->email : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
{!! Form::close() !!}