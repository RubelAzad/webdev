{!! Form::open(['id' => 'frm_partner', 'class' => '', 'url' => url('site/partner/update'), 'files' => true]) !!}
{!! Form::hidden('partner_id', $partner ? $partner->id : '', ['id' => 'partner_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => ''])) !!}
        {!! Form::text('name', $partner ? $partner->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('link', 'Link', ['class' => '']) !!}
        {!! Form::url('link', $partner ? $partner->link : '', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Leading Image', ['class' => '']) !!}
        <div class="row">
            <div class="col-md-4">
                {!! Form::file('file', ['class' => 'form-control']) !!}
                <p class="help-block">Suggested image size: 200 x 100 px</p>
            </div>
            <div class="col-md-4">
                @if($partner && $partner->logo)
                    <img src="{{url('file/serve/' . $partner->logo)}}" class="img-thumbnail" width="200">
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $partner ? $partner->active : false, ['class' => 'form-control']) !!}
    </div>
</fieldset>
{!! Form::close() !!}