<tr>
    <td width="">
        {!! Form::select('row-'. $i .'-package_type', $package_types->pluck('name', 'id')->prepend('Select package type',''), '', ['id' => '', 'class' => 'form-control', 'required' => 'required']) !!}
    </td>
    <td width="150">{!! Form::text('row-'. $i .'-weight', '', ['id' => '', 'class' => 'form-control', 'required' => 'required', 'placeholder' => 'kg']) !!}</td>
    <td width="150">{!! Form::text('row-'. $i .'-length', '', ['id' => '', 'class' => 'form-control', 'placeholder' => 'cm']) !!}</td>
    <td width="150">{!! Form::text('row-'. $i .'-width', '', ['id' => '', 'class' => 'form-control', 'placeholder' => 'cm']) !!}</td>
    <td width="150">{!! Form::text('row-'. $i .'-height', '', ['id' => '', 'class' => 'form-control', 'placeholder' => 'cm']) !!}</td>
    <td width="100">
        <button class="btn btn-danger btn-xs remove"><i class="fa fa-times"></i></button>
    </td>
</tr>
