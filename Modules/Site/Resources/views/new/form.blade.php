{!! Form::open(['id' => 'frm_news', 'class' => '', 'url' => url('site/news/update'), 'files' => true]) !!}
{!! Form::hidden('news_id', $new ? $new->id : '', ['id' => 'news_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('title', '<span class="star">*</span>Title', ['class' => ''])) !!}
        {!! Form::text('title', $new ? $new->title : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('body', '<span class="star">*</span>Body', ['class' => ''])) !!}
        {!! Form::textarea('body', $new ? $new->body : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Leading Image', ['class' => '']) !!}
        <div class="row">
            <div class="col-md-4">
                {!! Form::file('file', ['class' => 'form-control']) !!}
                <p class="help-block">Suggested image size: 848 x 480 px</p>
            </div>
            <div class="col-md-4">
                @if($new && $new->image)
                    <img src="{{url('file/serve/' . $new->image)}}" class="img-thumbnail" width="80">
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $new ? $new->active : false, ['class' => 'form-control']) !!}
    </div>
</fieldset>
{!! Form::close() !!}