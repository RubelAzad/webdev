@if($items && $i=1)
    @foreach($items as $item)
        <tr>
            <td>{{$item->name}}</td>
            <td class="center">{{$item->value}}</td>
            <td class="center">{{$item->cost}}</td>
            <td class="center"><a class="remove-declarable" href="{{url('cargo/remove-declarable/'. $draft_id .'/' . $i++ )}}"><i class="fa fa-times text-danger"></i></a></td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3" class="center"><span class="text-danger">No declarable item has been added!</span></td>
    </tr>
@endif