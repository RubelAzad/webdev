{!! Form::open(['id' => 'frm_slide_show', 'class' => '', 'class' => 'form-horizontal', 'url' => url('site/slide-show/update'), 'files' => true]) !!}
{!! Form::hidden('slide_show_id', $slide_show ? $slide_show->id : '', ['id' => 'slide_show_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('title', '<span class="star">*</span>Title', ['class' => 'col-md-3 control-label'])) !!}
        <div class="col-md-6">
            {!! Form::text('title', $slide_show ? $slide_show->title : '', ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Summary', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('description', $slide_show ? $slide_show->description : '', ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('file', 'Image', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6">
                    {!! Form::file('file', ['class' => 'form-control']) !!}
                    <p class="help-block">Suggested image size: 1920 x 600 px</p>
                </div>
                <div class="col-md-6">
                    @if($slide_show && $slide_show->image)
                        <img src="{{url('file/serve/' . $slide_show->image)}}" class="img-thumbnail">
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('button1_text', 'Button 1', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('button1_text', $slide_show ? $slide_show->button1_text : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('button1_link', 'Link to Button 1', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::url('button1_link', $slide_show ? $slide_show->button1_link : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('button2_text', 'Button 2', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('button2_text', $slide_show ? $slide_show->button2_text : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('button2_link', 'Link to Button 2', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::url('button2_link', $slide_show ? $slide_show->button2_link : '', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-6">
            {!! Form::checkbox('active', $slide_show ? $slide_show->active : false, ['class' => 'form-control']) !!}
        </div>
    </div>
</fieldset>
{!! Form::close() !!}