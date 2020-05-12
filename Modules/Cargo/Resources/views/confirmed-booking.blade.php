@extends('cargo::layouts.master')

@push('style')

@endpush

@push('scripts')
{{--<script type="application/javascript" src="{{url(Module::asset('cargo:js/shipment/booking_confirmed.js'))}}"></script>--}}
<script>
    $(function () {
        $('#tbl_booking').dataTable({
            responsive:true,
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10', '25', '50', 'All' ]
            ],
            dom:"<'row'<'col-sm-4'B><'col-sm-2'f><'col-sm-6 text-right'l>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>"
        });
    });
</script>

@endpush

@section('page_header')
    <i class="fa fa-archive"></i> Confirmed Booking - Awaiting To Be Picked
@endsection

@section('breadcrumb')
    <li class="active"><i class="fa fa-archive"></i> Confirmed Booking By Agent</li>
@endsection

@section('top_right_corner_button_group')

@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table id="tbl_booking" class="table table-bordered" style="width: 100%">
                <thead>
                <tr>
                    <th>Agent</th>
                    <th>City</th>
                    <th>Country</th>
                    <th class="center">Pieces</th>
                    <th class="center">Weight</th>
                    {{--<th class="center">Actions</th>--}}
                </tr>
                </thead>
                <tbody>
                @if($agents->count())
                    @foreach($agents as $pickups)
                        {{--@dump($pickups)--}}
                        <tr>
                            <td><a href="{{url('cargo/confirmed-booking/' . $pickups->first()->agent->id)}}">{{$pickups->first()->agent->name}}</a></td>
                            <td>{{$pickups->first()->agent->city}}</td>
                            <td>{{get_country_name($pickups->first()->agent->country)}}</td>
                            <td class="center">
                                {{
                                    $pickups->sum(function ($pickup){
                                        return $pickup->post->packages->sum('quantity');
                                    })
                                }}
                            </td>
                            <td class="center">
                                {{
                                    number_format($pickups->sum(function ($pickup){
                                        return get_total_weight($pickup->post->packages);
                                    }), 2)
                                }} kg
                            </td>
                            {{--<td class="center">--}}
                                {{--<button data-posts="{{$pickups->pluck('cargo_post_id')->implode(',')}}" class="btn btn-primary">Pickup</button>--}}
                            {{--</td>--}}
                            {{--<td class="center">{{$pickup->post->packages->sum('quantity')}}</td>--}}
                            {{--<td class="center">{{number_format(get_total_weight($pickup->post->packages), 2)}} kg</td>--}}
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
