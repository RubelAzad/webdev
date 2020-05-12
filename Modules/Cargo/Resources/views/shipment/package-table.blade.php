@if($packages && $i=1)
    @foreach($packages as $package)
        <tr>
            <td>{{$package->type_name}}</td>
            <td class="center">{{$package->quantity}}</td>
            <td class="center">{{$package->weight}}</td>
            <td class="center">{{$package->length}}</td>
            <td class="center">{{$package->width}}</td>
            <td class="center">{{$package->height}}</td>
            <td class="center">
                @if($package->length && $package->width && $package->height)
                    {{number_format(( $package->length * $package->width * $package->height) / get_settings('mass_divider', 5000), 2) }}
                @endif
            </td>
            <td class="center">{{number_format($package->weight, 2)}}</td>
            <td class="center">
                @php
                    $pack_l = number_format(( $package->length * $package->width * $package->height) / get_settings('mass_divider', 5000), 2);
                    $pack_w = number_format($package->weight, 2);
                    if( $pack_l > $pack_w ){
                        echo $pack_l;
                    }else{
                        echo $pack_w;
                    }
                @endphp
            </td>
            <td class="center"><a class="remove-package" href="{{url('cargo/remove-package/'. $draft_id .'/' . $i++ )}}"><i class="fa fa-times text-danger"></i></a></td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="9" class="center"><span class="text-danger">No package has been added!</span></td>
    </tr>
@endif