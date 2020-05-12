{!! Form::open(['id' => 'frm_service', 'class' => '', 'url' => url('site/service/update'), 'files' => true]) !!}
{!! Form::hidden('service_id', $service ? $service->id : '', ['id' => 'service_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('title', '<span class="star">*</span>Title', ['class' => ''])) !!}
        {!! Form::text('title', $service ? $service->title : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('summary', 'Summary', ['class' => '']) !!}
        {!! Form::textarea('summary', $service ? $service->summary : '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('body', '<span class="star">*</span>Body', ['class' => ''])) !!}
        {!! Form::textarea('body', $service ? $service->body : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('icon', 'Icon', ['class' => '']) !!}
        {!! Form::text('icon', $service ? $service->icon : '', ['class' => 'form-control']) !!}
        <span id="helpIcon" class="help-block">fa fa-***??? get icon name from https://fontawesome.com/v4.7.0/icons</span>
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Leading Image', ['class' => '']) !!}
        <div class="row">
            <div class="col-md-4">
                {!! Form::file('file', ['class' => 'form-control']) !!}
                <p class="help-block">Suggested image size: 360 x 204 px</p>
            </div>
            <div class="col-md-4">
                @if($service && $service->image)
                    <img src="{{url('file/serve/' . $service->image)}}" class="img-thumbnail" width="80">
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $service ? $service->active : false, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('front_page', 'Front Page', ['class' => '']) !!}
        {!! Form::checkbox('front_page', $service ? $service->front_page : false, ['class' => 'form-control']) !!}
    </div>
</fieldset>
{!! Form::close() !!}