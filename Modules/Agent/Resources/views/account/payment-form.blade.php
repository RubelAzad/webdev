{!! Form::open(['id' => 'frm_payment', 'class' => 'form-horizontal', 'url' => url('agent/update-payment')]) !!}
{!! Form::hidden('payment_id', $payment ? $payment->id : '', ['id' => 'payment_id']) !!}
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('agent_id', '<span class="star">*</span>Agent', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-8">
{{--        {!! Form::text('agent_id', $payment ? $payment->agent_id : '', ['class' => 'form-control', 'required' => 'required']) !!}--}}
        <select id="agent_id" name="agent_id" class="form-control" required="required">
            <option value=""></option>
            @foreach($agents as $agent)
                @if($payment)
                    <option value="{{$agent->id}}" {{$payment->agent_id == $agent->id ? 'selected' : ''}}>{{$agent->name}} - {{get_country_name($agent->country)}}</option>
                @else
                    <option value="{{$agent->id}}">{{$agent->name}} - {{get_country_name($agent->country)}}</option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('date', '<span class="star">*</span>Date', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::text('date', $payment ? $payment->date->format('d/m/Y') : now()->format('d/m/Y'), ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'dd/mm/yyyy']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('amount', '<span class="star">*</span>Amount', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::number('amount', $payment ? $payment->amount : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('payment_method', '<span class="star">*</span>Payment Method', ['class' => 'col-md-3 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::select('payment_method', get_payment_methods()->prepend('',''), $payment ? $payment->payment_method : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('payment_reference', 'Payment Reference', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-8">
        {!! Form::text('payment_reference', $payment ? $payment->payment_reference : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-md-3 control-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('description', $payment ? $payment->description : '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
</div>
{!! Form::close() !!}