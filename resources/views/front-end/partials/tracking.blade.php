{!! Form::open(['url' => url('track'), 'class' => 'form-horizontal']) !!}
<div class="section-area">
    <div class="container">
        <div class="well">
            {!! Form::open(['url' => url('track'), 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('tracking_number', 'Enter Tracking Number', ['class' => 'col-md-3 control-label']) !!}
                <div class="col-md-8">
                    {!! Form::text('tracking_number', '', ['class' => 'form-control', 'placeholder' => 'Enter Tracking Number', 'required' => 'required']) !!}
                </div>
                <div class="col-xs-1">
                    <button class="btn btn-primary"><i class="fa fa-search"></i> </button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
{!! Form::close() !!}