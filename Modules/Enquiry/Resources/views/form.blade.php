{!! Form::open(['id' => 'frm_enquiry', 'url' => url('enquiry/update'), 'class' => 'form-horizontal', 'files' => true]) !!}

@if( ! session('agent'))
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('agent_id', '<span class="star">*</span>Agent To', ['class' => 'control-label col-md-2'])) !!}
        <div class="col-md-8">
            {!! Form::select('agent_id', get_agents()->pluck('name', 'id')->prepend('',''), $enquiry ? $enquiry->agent_id : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
@endif

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('subject_id', '<span class="star">*</span>Subject', ['class' => 'control-label col-md-2'])) !!}
    <div class="col-md-8">
        {!! Form::select('subject_id', get_subjects()->pluck('text','id')->prepend('',''), $enquiry ? $enquiry->subject_id : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('message', '<span class="star">*</span>Message', ['class' => 'control-label col-md-2'])) !!}
    <div class="col-md-8">
        {!! Form::textarea('message', $enquiry ? $enquiry->message : '', ['class' => 'form-control', 'rows' => 3, 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('attachments', '<span class="star">*</span>Attachments', ['class' => 'control-label col-md-2'])) !!}
    <div class="col-md-8">
        {!! Form::file('attachments[]', ['class' => 'form-control', 'multiple' => 'multiple']) !!}
    </div>
</div>
{!! Form::close() !!}