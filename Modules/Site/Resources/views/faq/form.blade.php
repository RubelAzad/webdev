{!! Form::open(['id' => 'frm_faq', 'class' => '', 'url' => url('site/faq/update'), 'files' => true]) !!}
{!! Form::hidden('faq_id', $faq ? $faq->id : '', ['id' => 'faq_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('question', '<span class="star">*</span>Question', ['class' => ''])) !!}
        {!! Form::text('question', $faq ? $faq->question : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('answer', '<span class="star">*</span>Answer', ['class' => ''])) !!}
        {!! Form::textarea('answer', $faq ? $faq->answer : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>

    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('cat_id', '<span class="star">*</span>Category', ['class' => ''])) !!}
        {!! Form::select('cat_id', $categories->pluck('name', 'id')->prepend('',''),$faq ? $faq->cat_id : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $faq ? $faq->active : false, ['class' => 'form-control']) !!}
    </div>

</fieldset>
{!! Form::close() !!}