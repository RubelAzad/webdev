{!! Form::open(['url' => url('franchise/update-business-rules'), 'class' => 'form-horizontal', 'id' => 'frm_business_rules']) !!}
<div class="form-group">
    {!! Form::label('area', 'Business Area (Countries)', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::select('area[]', $countries, $franchise ? explode(',', str_replace(', ', ',', $franchise->area)) : '', ['id' => 'area', 'class' => 'form-control select2', 'multiple' => true]) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('credit', '*Allowed Credit', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::number('credit', $franchise ? $franchise->credit : 0, ['class' => 'form-control','required' => 'required']) !!}
    </div>
</div>

{{--<div class="form-group">--}}
    {{--{!! Form::label('commission', 'Commission (%)', ['class' => 'col-md-4 control-label']) !!}--}}
    {{--<div class="col-md-8">--}}
        {{--{!! Form::number('commission', $franchise ? $franchise->commission : '0', ['class' => 'form-control', 'min' => 0]) !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('agent_commission', 'Agent Commission (%)', ['class' => 'col-md-4 control-label']) !!}--}}
    {{--<div class="col-md-8">--}}
        {{--{!! Form::number('agent_commission', $franchise ? $franchise->agent_commission : '0', ['class' => 'form-control', 'min' => 0]) !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group">--}}
    {{--{!! Form::label('discount', 'Discount (%)', ['class' => 'col-md-4 control-label']) !!}--}}
    {{--<div class="col-md-8">--}}
        {{--{!! Form::number('discount', $franchise ? $franchise->discount : '0', ['class' => 'form-control', 'min' => 0]) !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group">
    {!! Form::label('note', 'Note', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-8">
        {!! Form::textarea('note', $franchise ? $franchise->note : '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
</div>
{!! Form::close() !!}