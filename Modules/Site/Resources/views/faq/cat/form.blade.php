{!! Form::open(['id' => 'frm_cat', 'class' => '', 'url' => url('site/faq-cat/update'), 'files' => true]) !!}
{!! Form::hidden('cat_id', $cat ? $cat->id : '', ['id' => 'cat_id']) !!}
<fieldset>
    <div class="form-group">
        {!! Form::label('name', '*Name', ['class' => '']) !!}
        {!! Form::text('name', $cat ? $cat->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('icon', 'Icon', ['class' => '']) !!}
        {!! Form::text('icon', $cat ? $cat->icon : '', ['class' => 'form-control']) !!}
        <span class="help-block">fa fa-***??? get icon name from https://fontawesome.com/v4.7.0/icons</span>
    </div>


    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $cat ? $cat->active : false, ['class' => 'form-control']) !!}
    </div>

</fieldset>
{!! Form::close() !!}