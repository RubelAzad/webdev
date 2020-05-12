<fieldset>
    <div class="form-group">
        {!! Form::label('', 'Sending from', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <label class="checkbox-inline">{!! Form::radio('src_country', 'uk', true) !!} United Kingdom</label>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('', 'Sending to', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <label class="checkbox-inline">{!! Form::radio('dst_country', 'bd', true) !!} Bangladesh</label>
            <label class="checkbox-inline">{!! Form::radio('dst_country', 'world', false) !!} Rest of the world</label>
        </div>
    </div>
    <div class="form-group">
        {!! Form::label('', 'Parcel Type', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <label class="checkbox-inline">{!! Form::radio('document', '1', true) !!} Document</label>
            <label class="checkbox-inline">{!! Form::radio('document', '0', false) !!} Non document</label>
        </div>
    </div>
    <div class="form-group">
        <table class="table">
            <tr>
                <td>{!! Form::text('weight', '', ['class' => 'form-control', 'placeholder' => 'Weight']) !!}</td>
                <td>{!! Form::text('length', '', ['class' => 'form-control', 'placeholder' => 'Length']) !!}</td>
                <td>{!! Form::text('width', '', ['class' => 'form-control', 'placeholder' => 'Width']) !!}</td>
                <td>{!! Form::text('height', '', ['class' => 'form-control', 'placeholder' => 'Height']) !!}</td>
            </tr>
        </table>
    </div>
    <div class="form-group">
        {!! Form::label('', '', ['class' => 'col-md-3 control-label']) !!}
        <div class="col-md-8">
            <button class="btn btn-primary">Get Quote</button>
        </div>
    </div>
</fieldset>