<tr>
    <td width="">
        <select id="valuable_item_id" name="valuable_item_id" class="form-control">
            <option value="0" data-max="0" data-min="0">Select item</option>
        </select>
    </td>
    <td width="200">
        {!! Form::number('item_value', '', ['id' => 'item_value', 'class' => 'form-control', 'placeholder' => 'Amount']) !!}
    </td>
    <td width="150">
        {!! Form::number('valuable_item_cost', '', ['id' => 'valuable_item_cost', 'class' => 'form-control', 'placeholder' => 'Cost']) !!}
    </td>
    <td width="100" class="center">
        <button id="btn_remove_item" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
        <button id="btn_add_item" class="btn btn-xs btn-success add-more"><i class="fa fa-plus"></i></button>
    </td>
</tr>
@include('cargo::quote.items-row', ['items' => $valuable_items])
