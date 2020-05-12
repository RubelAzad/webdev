{!! Form::open(['id' => 'frm_testimonial', 'class' => '', 'url' => url('site/testimonial/update'), 'files' => true]) !!}
{!! Form::hidden('testimonial_id', $testimonial ? $testimonial->id : '', ['id' => 'testimonial_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('text', '<span class="star">*</span>Testimonial', ['class' => ''])) !!}
        {!! Form::textarea('text', $testimonial ? $testimonial->text : '', ['class' => 'form-control', 'rows' => 2, 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('name', '<span class="star">*</span>Name', ['class' => ''])) !!}
        {!! Form::text('name', $testimonial ? $testimonial->name : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('occupation', 'Occupation', ['class' => '']) !!}
        {!! Form::text('occupation', $testimonial ? $testimonial->occupation : '', ['class' => 'form-control']) !!}
    </div>
    {{--<div class="form-group">--}}
        {{--{!! Form::label('file', 'Leading Image', ['class' => '']) !!}--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--{!! Form::file('file', ['class' => 'form-control']) !!}--}}
            {{--</div>--}}
            {{--<div class="col-md-4">--}}
                {{--@if($testimonial && $testimonial->image)--}}
                    {{--<img src="{{url('file/serve/' . $testimonial->image)}}" class="img-thumbnail" width="80">--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $testimonial ? $testimonial->active : false, ['class' => 'form-control']) !!}
    </div>
</fieldset>
{!! Form::close() !!}