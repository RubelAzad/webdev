
@foreach($services as $service)

    <tr>
        <td>{{$service->provider->name}} - {{$service->name}}</td>
        <td>{{$service->speed}}</td>
        <td class="center">{{$agent->id}}</td>
        <td class="center">{{$weight}}kg</td>
        <td class="center">{{$quantity}}kg</td>
        @php($price = get_service_price($service->price, $service->commission, $agent))
        <td class="center">{{get_service_price_total($service->base_price, $price, $service->commission, $quantity, $agent)}}</td>
        <td class="center">{{$service->price}}</td>

        @php( $com = $service->price)
        @php($comm = $service->commission)
        @php( $comall = ($com * ($comm/100)))
        @php( $finalcomm = $quantity * $comall )
        <td class="center">{{$finalcomm}}</td>
        <td class="center">
            <input data-provider="nec" type="radio" class="services" value="{{$service->id}}" name="service_selected">
        </td>
    </tr>
@endforeach

