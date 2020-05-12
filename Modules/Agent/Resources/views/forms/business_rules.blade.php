{!! Form::open(['url' => url('agent/update-business-rules'), 'class' => 'form-horizontal', 'id' => 'frm_business_rules']) !!}
<div class="form-group">
    {!! Form::label('zone_id', 'Zone', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::select('zone_id', $zones, $agent ? $agent->zone_id : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('franchise_id', 'Parent Franchise', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        @if($agent && $agent->franchise)
            {!! Form::select('franchise_id', $franchises , $agent->franchise->id, ['class' => 'form-control', 'required' => 'required']) !!}
        @elseif($franchise)
            {!! Form::select('franchise_id', $franchise->pluck('name', 'id'), $franchise->id, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
        @else
            {!! Form::select('franchise_id', $franchises, '', ['class' => 'form-control', 'required' => 'required']) !!}
        @endif
    </div>
</div>

<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('credit', '<span class="star">*</span>Allowed Credit', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::number('credit', $agent ? $agent->credit : 0, ['class' => 'form-control','required' => 'required']) !!}
    </div>
</div>
@if( !session('agent') && !session('franchise'))
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('holding_credit', '<span class="star">*</span>Holding Credit', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::number('holding_credit', $agent ? $agent->holding_credit : 0, ['class' => 'form-control','required' => 'required']) !!}
    </div>
</div>
<div class="form-group">
    {!! htmlspecialchars_decode(Form::label('location_charge', '<span class="star">*</span>Location Charge (+ per kg)', ['class' => 'col-md-4 control-label'])) !!}
    <div class="col-md-8">
        {!! Form::number('location_charge', $agent ? $agent->location_charge : 0, ['class' => 'form-control','required' => 'required']) !!}
    </div>
</div>
@endif
<div class="form-group">
    {!! Form::label('commission', 'Commission (%)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::number('commission', $agent ? $agent->commission : 0, ['class' => 'form-control', 'max' => 100, 'min' => 0]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('increment', 'Price increment (%)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::number('increment', $agent ? $agent->increment : 0, ['class' => 'form-control', 'max' => 99, 'min' => 0]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('commission_valuable', 'Commission on Valuable Items (%)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::number('commission_valuable', $agent ? $agent->commission_valuable : 0, ['class' => 'form-control', 'max' => 99, 'min' => 0]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('additional_charge', 'Additional charge for pickup', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::number('additional_charge', $agent ? $agent->additional_charge : 0, ['class' => 'form-control', 'max' => 99, 'min' => 0]) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('', 'Allow to provide discount', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="checkbox" name="allow_discount" id="allow_discount" {{$agent && $agent->allow_discount ? 'checked' : ''}}>
    </div>
</div>
<div class="form-group">
    {!! Form::label('', 'Customer drop off', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="checkbox" name="receive" id="receive" {{$agent && $agent->receive ? 'checked' : ''}}>
    </div>
</div>
<div class="form-group">
    {!! Form::label('', 'Pickup from Sender', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="checkbox" name="pickup" id="pickup" {{$agent && $agent->pickup ? 'checked' : ''}}>
    </div>
</div>
<div class="form-group">
    {!! Form::label('', 'Customer collection', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="checkbox" name="collection" id="collection" {{$agent && $agent->collection ? 'checked' : ''}}>
    </div>
</div>
<div class="form-group">
    {!! Form::label('', 'Home delivery', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        <input type="checkbox" name="delivery" id="delivery" {{$agent && $agent->delivery ? 'checked' : ''}}>
    </div>
</div>
@if( !session('agent') && !session('franchise'))
    <div class="form-group">
        {!! Form::label('', 'Visible to website', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-8">
            <input type="checkbox" name="visible_website" id="visible_website" {{$agent && $agent->visible_website ? 'checked' : ''}}>
        </div>
    </div>
@endif
<div class="form-group">
    {!! Form::label('note', 'Note', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('note', $agent ? $agent->note : '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
</div>
{!! Form::close() !!}