{!! Form::open(['id' => 'frm_page', 'class' => '', 'url' => url('site/page/update'), 'files' => true]) !!}
{!! Form::hidden('page_id', $page ? $page->id : '', ['id' => 'page_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('title', '<span class="star">*</span>Title', ['class' => ''])) !!}
        {!! Form::text('title', $page ? $page->title : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('slug', '<span class="star">*</span>Slug', ['class' => ''])) !!}
        {!! Form::text('slug', $page ? $page->slug : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('summary', 'Summary', ['class' => '']) !!}
        {!! Form::textarea('summary', $page ? $page->summary : '', ['class' => 'form-control', 'rows' => 2]) !!}
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('body', '<span class="star">*</span>Body', ['class' => ''])) !!}
        {!! Form::textarea('body', $page ? $page->body : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('file', 'Leading Image', ['class' => '']) !!}
        <div class="row">
            <div class="col-md-4">
                {!! Form::file('file', ['class' => 'form-control']) !!}
                <p class="help-block">Suggested image size: 360 x 204 px</p>
            </div>
            <div class="col-md-4">
                @if($page && $page->image)
                    <img src="{{url('../file/serve/' . $page->image)}}" class="img-thumbnail" width="80">
                @endif
            </div>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $page ? $page->active : false, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('front_page', 'Front Page', ['class' => '']) !!}
        {!! Form::checkbox('front_page', $page ? $page->front_page : false, ['class' => 'form-control']) !!}
    </div>
</fieldset>
{!! Form::close() !!}