
{!! Form::open(['id' => 'frm_valuable', 'url' => url('service/update-valuable'), 'class' => 'form-horizontal']) !!}
{!! Form::hidden('valuable_id', $valuable ? $valuable->id : '', ['id' => 'valuable_id']) !!}
<fieldset>
    <legend>Valuable Item</legend>
    <div class="form-group">
        {!! Form::label('name', '*Name', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-6">
            {!! Form::text('name', $valuable ? $valuable->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>


    <div class="form-group">
        {!! Form::label('src_country', '*Source Country', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-6">
            {!! Form::select('src_country', get_countries_for_select()->prepend('',''), $valuable ? $valuable->src_country : '', ['class' => 'form-control select2', 'required' => 'required', 'data-placeholder' => 'Select Country']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('dst_country', '*Destination Country', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-6">
            {!! Form::select('dst_country', get_countries_for_select()->prepend('',''), $valuable ? $valuable->dst_country : '', ['class' => 'form-control select2', 'required' => 'required', 'data-placeholder' => 'Select Country']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('purchase_price', '*Maximum Coverage Value', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-4">
            {!! Form::number('purchase_price', $valuable ? $valuable->purchase_price : 0, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('price', '*Minimum Selling Price', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-4">
            {!! Form::number('price', $valuable ? $valuable->price : 0, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('max_price', '*Maximum Selling Price', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-4">
            {!! Form::number('max_price', $valuable ? $valuable->max_price : 0, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('commission', 'Commission %', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-4">
            {!! Form::number('commission',$valuable ? $valuable->commission :  0, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('commission_amount', 'Commission Amount', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-4">
            {!! Form::text('commission_amount', 0, ['class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('ho_price', 'HO Price', ['class' => 'control-label col-md-3']) !!}
        <div class="col-md-4">
            {!! Form::text('ho_price', 0, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        </div>
    </div>
</fieldset>

<div class="form-group">
    {!! Form::label('', '', ['class' => 'control-label col-md-3']) !!}
    <div class="col-md-8">
        <button id="btn_save_valuable" class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
    </div>
</div>
{!! Form::close() !!}
