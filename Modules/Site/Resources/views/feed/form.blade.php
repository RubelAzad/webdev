{!! Form::open(['id' => 'frm_feed', 'class' => '', 'url' => url('site/feed/update'), 'files' => true]) !!}
{!! Form::hidden('feed_id', $feed ? $feed->id : '', ['id' => 'feed_id']) !!}
<fieldset>
    <div class="form-group">
        {!! htmlspecialchars_decode(Form::label('title', '<span class="star">*</span>Title', ['class' => ''])) !!}
        {!! Form::text('title', $feed ? $feed->text : '', ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('link', 'Link', ['class' => '']) !!}
        {!! Form::url('link', $feed ? $feed->link : '', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('active', 'Publish', ['class' => '']) !!}
        {!! Form::checkbox('active', $feed ? $feed->active : false, ['class' => 'form-control']) !!}
    </div>

    {{--<div class="form-group">--}}
        {{--{!! Form::label('expire', 'Expire', ['class' => '']) !!}--}}
        {{--{!! Form::date('expire', $feed ? $feed->expire : '', ['class' => 'form-control']) !!}--}}
    {{--</div>--}}

</fieldset>
{!! Form::close() !!}