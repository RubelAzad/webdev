@if($items && $i=1)
    @foreach($items as $item)
        <tr>
            <td><input type="checkbox" class="check_insurance" data-id="{{$item->id}}" {{$item->keep ? 'checked' : ''}}></td>
            <td>{{$item->name}}</td>
            <td class="center">{{$item->value}}</td>
            <td class="center" width="220">
                <input class="form-control center" style="width: 200px" max="{{$item->value * get_settings('max_insurance', 10)/100}}" min="{{$item->value * get_settings('insurance', 10)/100}}" type="number" value="{{isset($item->insurance_price) && $item->insurance_price ? $item->insurance_price : $item->value * get_settings('insurance', 10)/100}}">
            </td>
        </tr>
        @php($i++)
    @endforeach
@endif