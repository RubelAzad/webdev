@extends('cargo::layouts.master')

@push('scripts')
    <script src="{{url(Module::asset('cargo:js/quote/index.js'))}}"></script>
@endpush

@section('top_right_corner_button_group')
    <a href="{{url('cargo/get-quote')}}" class="btn btn-primary"> Get New Quote</a>
@endsection

@section('content')

    @php($total = 0)

    <div class="container">

        <h1 class="center">Quote Result</h1>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">General goods {{$declare_value ? '(Declare value: ' . number_format($declare_value, 2) . ')' : ''}}</h3>
            </div>
            <div class="panel-body no-padding">
                <table id="tbl_services" class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Service</th>
                        <th>Description</th>
                        <th class="center">Total Weight</th>
                        <th class="center" width="200">Price</th>
                        {{--<th class="center">Insurance</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td>{{$service->provider->name}} - {{$service->name}}</td>
                            <td>{{$service->speed}}</td>
                            <td class="center">{{$quantity}}kg</td>
                            @php($price = get_service_price($service->price, $service->commission, $agent))
                            <td class="center">
                                @php($service_price = get_service_price_total($service->base_price, $price, $service->commission, $quantity, $agent))
                                {{get_currency_symbol($agent->country) . $service_price}}
                                @php($total = $total + $service_price)
                            </td>
                            {{--<td class="center">{{number_format($insurance_all, 2)}}</td>--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{--<table class="table table-bordered table-hover">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>Select</th>--}}
                        {{--<th>Service</th>--}}
                        {{--<th>Estimated Delivery By</th>--}}
                        {{--<th>Book By</th>--}}
                        {{--<th>Latest Pickup</th>--}}
                        {{--<th>Price</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--@foreach($prices as $price)--}}
                        {{--<tr>--}}
                            {{--<td><input type="radio" name="service"></td>--}}
                            {{--<td>{{$price->ProductShortName}}</td>--}}
                            {{--<td>{{$price->DeliveryDate}} {{$price->DeliveryTime}}</td>--}}
                            {{--<td>{{$price->BookingTime}}</td>--}}
                            {{--<td>{{$price->PickupCutoffTime}}</td>--}}
                            {{--<td>{{$price->ShippingCharge}}</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            </div>
        </div>

        @if($valuable_items->count())
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Valuable items
                        <small>(Excluding weight charge)</small>
                    </h3>
                </div>
                <div class="panel-body no-padding">
                    <input type="hidden" id="item_row_number" value="1">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Item name</th>
                            <th class="center">Item value</th>
                            <th class="center" width="200"></th>
                            {{--<th class="center">Insurance</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($valuable_items as $item)
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td class="center">{{$item['value']}}</td>
                                <td class="center">{{get_currency_symbol($agent->country).number_format($item['cost'], 2)}}</td>
                                @php($total = $total + $item['cost'])
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif


        @if($insurance)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Insurance</h3>
                </div>
                <div class="panel-body no-padding">
                    <table class="table table-bordered">
                        <tr>
                            <th>General goods</th>
                            <td width="200" class="center">{{get_currency_symbol($agent->country).number_format($insurance_all, 2)}}</td>
                            @php($total = $total + $insurance_all)
                        </tr>

                        @if($valuable_items->count())
                            <tr>
                                <th>Valuable items</th>
                                <td width="200" class="center">
                                    @php($insurance_valuable = $valuable_items->sum('value') * $insurance_rate / 100)
                                    {{get_currency_symbol($agent->country).number_format($insurance_valuable, 2)}}
                                    @php($total = $total + $insurance_valuable)
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-body no-padding">
                <table class="table table-bordered">
                    <tr>
                        <th class="left">Total</th>
                        <td width="200" class="center">
                            {{get_currency_symbol($agent->country).number_format($total, 2)}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

@endsection