
{!! Form::open(['id' => 'frm_provider', 'url' => url('service/update-provider'), 'class' => 'form-horizontal']) !!}
{!! Form::hidden('provider_id', $provider ? $provider->id : '', ['id' => 'provider_id']) !!}
<div class="form-group">
    {!! Form::label('name', '*Name', ['class' => 'control-label col-md-3']) !!}
    <div class="col-md-8">
        {!! Form::text('name', $provider ? $provider->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'control-label col-md-3']) !!}
    <div class="col-md-8">
        {!! Form::textarea('description', $provider ? $provider->description : '', ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('', 'Activate', ['class' => 'control-label col-md-3']) !!}
    <div class="col-md-8">
        {!! Form::checkbox('active', '', $provider ? $provider->active : '', ['id' =>'provider_status']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('', '', ['class' => 'control-label col-md-3']) !!}
    <div class="col-md-8">
        <button class="btn btn-primary"><i class="fa fa-save"></i> Save </button>
    </div>
</div>
{!! Form::close() !!}
