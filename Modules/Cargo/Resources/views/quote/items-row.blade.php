@foreach($items as $item)
    <tr>
        <td>{{$item['name']}}</td>
        <td class="center">{{$item['value']}}</td>
        <td class="center">{{number_format($item['cost'], 2)}}</td>
        <td class="center">
            <button class="btn btn-danger btn-xs btn_remove_item"><i class="fa fa-times"></i></button>
        </td>
    </tr>
@endforeach