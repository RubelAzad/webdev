@if($receivers->count() && $i=1)
    @foreach($receivers as $receiver)
        <tr id="{{$receiver->id}}">
            <td>{{$i++}}</td>
            <td>{{$receiver->name}}</td>
            <td>{{$receiver->address_line_1}}</td>
            <td class="center">{{$receiver->postcode}}</td>
            <td class="center">{{$receiver->phone_number}}</td>
            <td class="center">{{$receiver->email}}</td>
        </tr>
    @endforeach
@endif