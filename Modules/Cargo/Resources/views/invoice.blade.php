@extends('warehouse::layouts.master')
@push('scripts')
    {{--<script type="application/javascript" src="{{url(Module::asset('warehouse:js/show.js'))}}"></script>--}}

    <script>
        $(document).ready(function(){
            $("div.b1").click(function(){

                var mode = $("input[name='mode']:checked").val();
                var close = mode == "popup" && $("input#closePop").is(":checked");
                var extraCss = $("input[name='extraCss']").val();

                var print = "";
                $("input.selPA:checked").each(function(){
                    print += (print.length > 0 ? "," : "") + "div.PrintArea." + $(this).val();
                });

                var keepAttr = [];
                $(".chkAttr").each(function(){
                    if ($(this).is(":checked") == false )
                        return;

                    keepAttr.push( $(this).val() );
                });

                var headElements = $("input#addElements").is(":checked") ? '<meta charset="utf-8" />,<meta http-equiv="X-UA-Compatible" content="IE=edge"/>' : '';

                var options = { mode : mode, popClose : close, extraCss : extraCss, retainAttr : keepAttr, extraHead : headElements };

                $( print ).printArea( options );
            });

            $("input[name='mode']").click(function(){
                if ( $(this).val() == "iframe" ) $("#closePop").attr( "checked", false );
            });
        });

    </script>
@endpush
@section('content')
    <br>
    <div class="container">
        <div class="PrintArea area1 all" id="Retain">
        <div class="panel panel-default all-invoice" style="overflow: hidden;display: block;">
            <div class="panel-body">
                <div class="row" style="width: 100%; margin:0 auto;">
                    <div class="col-xs-7" style="width: 60%; float: left;">
                        <img src="{{$logo}}" width="200" height="50"><br>
                        {{$agent->name}}<br>
                        <i class="fa fa-map-marker"></i> {{trim($agent->address_line_1)}}{{$agent->address_line_2 ? ', ' . $agent->address_line_2 : ''}}{{$agent->address_line_3 ? ', ' . $agent->address_line_3 : ''}}{{$agent->city ? ', ' . $agent->city : ''}}{{$agent->county ? ', ' . $agent->county : ''}}{{$agent->postcode ? ' ' . $agent->postcode : ''}},{{get_country_name($agent->country)}}
                        <br>
                        <i class="fa fa-phone-square"></i> {{$agent->phone_number}}{{$agent->ev_phone_number ? ', ' . $agent->ev_phone_number : ''}}
                        @if($agent->fax)
                            <br>
                            <i class="fa fa-fax"></i> {{$agent->fax}}
                        @endif
                        <br>
                        <i class="fa fa-envelope"></i> {{$agent->email}}
                    </div>
                    <div class="col-xs-5 text-right" style="width: 30%;float: right;">
                        <br>Date: {{$post->created_at->format('d/m/Y')}}
                        <br>Tracking Number: {{strtoupper($post->tracking_no)}}
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default all-invoice" style="overflow: hidden;display: block;">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-4" style="width: 30%; float: left;">
                        <h3><u>Sender</u></h3>
                        @if($sender = $post->sender)
                            {{$sender->name}}<br>
                            {{$sender->address_line_1}}{!! $sender->address_line_2 ? ', ' . $sender->address_line_2 : '' !!}{!! $sender->address_line_3 ? ', ' . $sender->address_line_3 : '' !!}, {!! $sender->city !!}{!! $sender->county ? ', ' . $sender->county : '' !!}{!! $sender->postcode ? ', ' . $sender->postcode : '' !!}{!! $sender->country ? ', ' . get_country_name($sender->country) : '' !!}
                            <br>Contact Person: {{$sender->contact_person}}
                            <br>Contact Number: {{$sender->phone_number}}
                            <br>Email: {{$sender->email}}
                        @endif
                    </div>
                    <div class="col-xs-4" style="width: 30%; float: left;">
                        <h3><u>Receiver</u></h3>
                        @if($receiver = $post->receiver)
                            {{$receiver->name}}<br>
                            {{$receiver->address_line_1}}{!! $receiver->address_line_2 ? ', ' . $receiver->address_line_2 : '' !!}{!! $receiver->address_line_3 ? ', ' . $receiver->address_line_3 : '' !!}, {!! $receiver->city !!}{!! $receiver->county ? ', ' . $receiver->county : '' !!}{!! $receiver->postcode ? ', ' . $receiver->postcode : '' !!}{!! $receiver->country ? ', ' . get_country_name($receiver->country) : '' !!}
                            <br>Contact Person: {{$receiver->contact_person}}
                            <br>Contact Number: {{$receiver->phone_number}}
                            <br>Email Address: {{$receiver->email}}
                        @endif
                    </div>
                    <div class="col-xs-4" style="width: 40%; float: left;">
                        @php($delivery_cost = 0)
                        @if($delivery = $post->delivery)
                            @if($delivery->name == 'Agent Location')
                                <h3><u>Collection Address</u></h3>
                                {{$delivery->agent->name}}<br>
                                {{$delivery->agent->address_line_1}}{!! $delivery->agent->address_line_2 ? ', ' . $delivery->agent->address_line_2 : '' !!}{!! $delivery->agent->address_line_3 ? ', ' . $delivery->agent->address_line_3 : '' !!}{!! $delivery->agent->city ? ', ' . $delivery->agent->city : '' !!}{!! $delivery->agent->county ? ', ' . $delivery->agent->county : '' !!}{!! $delivery->agent->postcode ? ', ' . $delivery->agent->postcode : '' !!}{!! $delivery->agent->country ? ', ' . get_country_name($delivery->agent->country) : '' !!}
                                <br>Contact Person: {{$delivery->agent->contact_person}}
                                <br>Contact Number: {{$delivery->agent->phone_number}}
                                <br>Email Address: {{$delivery->agent->email}}
                            @else
                                <h3><u>Delivery Address</u></h3>
                                {{$delivery->name}}<br>
                                {{$delivery->address_line_1}}{!! $delivery->address_line_2 ? ', ' . $delivery->address_line_2 : '' !!}{!! $delivery->address_line_3 ? ', ' . $delivery->address_line_3 : '' !!}{!! $delivery->city ? ', ' . $delivery->city : '' !!}{!! $delivery->county ? ', ' . $delivery->county : '' !!}{!! $delivery->postcode ? ', ' . $delivery->postcode : '' !!}{!! $delivery->country ? ', ' . get_country_name($delivery->country) : '' !!}
                                <br>Contact Person: {{$delivery->contact_person}}
                                <br>Contact Number: {{$delivery->phone_number}}
                                <br>Email Address: {{$delivery->email}}
                            @endif
                            <br>Note: {{$delivery->instruction}}
                            @php($delivery_cost = $delivery_cost + $delivery->price)
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="row" style="overflow: hidden;display: block;">
            <div class="col-xs-6 left" style="width: 100%;">
                <div class="panel panel-default all-invoice">
                    <div class="panel-heading"><h4><u>Package Details</u></h4>
                    </div>
                    <div class="panel-body">
                        @php($total_kg = 0)
                        <ul>
                            @if($packages = $post->packages)
                                @foreach($packages as $package)
                                    @php($quan_test=$package->quantity)
                                    @php($inv_total = ($package->length * $package->width * $package->height) / get_settings('mass_divider', 5000))
                                    @php($inv_weight=$package->weight)
                                    <li>
                                        {{$package->quantity}} x {{$package->type->name}} -
                                        @if($inv_total > $inv_weight)
                                            {{$inv_total * $quan_test}}

                                        @else
                                            {{$inv_weight * $quan_test}}
                                        @endif
                                        kg
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <b>Description:</b> {{$post->description}} <br>
                        <b>Declare Value:</b> {{number_format($post->value, 2)}}
                        @if($post->items->count())
                            @if($items = $post->items)
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Valuable Item</th>
                                        <th>Declare Value</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{$item->name}}</td>
                                            <td>{{number_format($item->value, 2)}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-xs-6 right" style="overflow: hidden; display: block; width:100%;">
                <div class="panel panel-default all-invoice">
                    <div class="panel-heading"><h4>Cost Summary</h4></div>
                    <div class="panel-body no-padding">
                        @php($total = 0)
                        <table class="table table-bordered no-margin-bottom" style="width:100%;">
                            <thead>
                            <tr>
                                <th style="text-align: left;border: 1px solid #000;">Description</th>
                                <th style="text-align: right;border: 1px solid #000;">Price ({{get_currency_symbol($agent->country)}})</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr style="text-align: left;border: 1px solid #000;">
                                <td style="text-align: left;border: 1px solid #000;">
                                    @if($packages = $post->packages)
                                        @foreach($packages as $package)
                                            @php($quan_test1=$package->quantity)
                                            @php($inv_total1 = ($package->length * $package->width * $package->height) / get_settings('mass_divider', 5000))
                                            @php($inv_weight1=$package->weight)

                                        {{$post->service->name}} -
                                            @if($inv_total > $inv_weight)
                                                {{$inv_total * $quan_test}}

                                            @else
                                                {{$inv_weight * $quan_test}}
                                            @endif
                                            kg <br>

                                        @endforeach
                                    @endif
                                        <br>
                                        Est. Delivery: {{$post->service->speed}}
                                </td>
                                <td style="text-align: right;border: 1px solid #000;">
                                    @php($package_total = number_format(get_total_weight($post->packages) * $post->unit_price, 2))
                                    {{$package_total = number_format(parseFloat($package_total >= $post->base_price ? $package_total : $post->base_price), 2)}}
                                </td>
                                @php($total = $total + parseFloat($package_total))
                            </tr>
                            @if($post->billing->location_charge)
                                <tr style="text-align: right;border: 1px solid #000;">
                                    <td style="text-align: left;border: 1px solid #000;">Location Charge</td>
                                    <td style="text-align: right;border: 1px solid #000;">
                                        {{$location_charge = number_format($total_kg * $post->billing->location_charge, 2, '.', '')}}
                                    </td>
                                </tr>
                                @php($total = $total + $location_charge)
                            @endif
                            @if($post->transport_cost)
                                <tr style="text-align: right;border: 1px solid #000;">
                                    <td style="text-align: left;border: 1px solid #000;">Additional transport cost</td>
                                    <td style="text-align: right;border: 1px solid #000;">{{number_format($post->transport_cost, 2)}}</td>
                                </tr>
                                @php($total = $total + $post->transport_cost)
                            @endif
                            @if($post->items->count())
                                @if($items = $post->items)
                                    @foreach($items as $item)
                                        <tr style="text-align: right;border: 1px solid #000;">
                                            <td style="text-align: left;border: 1px solid #000;">{{$item->name}}</td>
                                            <td style="text-align: right;border: 1px solid #000;">{{number_format($item->tax, 2)}}</td>
                                        </tr>
                                    @endforeach
                                    @php($total = $total + $items->sum('tax'))
                                @endif
                            @endif

                            @if($post->insurances->count())
                                @php($insurance_price = 0)
                                <tr style="text-align: right;border: 1px solid #000;">
                                    <td style="text-align: left;border: 1px solid #000;">
                                        Insurance for following item(s):
                                        <ul>
                                            @foreach($post->insurances as $item)
                                                <li>{{$item->name}} - ({{number_format($item->cost, 2)}})</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td style="text-align: right;border: 1px solid #000;">
                                        {{number_format($post->insurances->sum('cost'), 2)}}
                                    </td>
                                </tr>
                                @php($total = $total + $post->insurances->sum('cost'))
                            @endif
                            @if($post->packaging)
                                <tr style="text-align: right;border: 1px solid #000;">
                                    <td style="text-align: left;border: 1px solid #000;">Additional Packaging</td>
                                    <td style="text-align: right;border: 1px solid #000;">{{number_format($post->packaging_price, 2)}}</td>
                                </tr>
                                @php($total = $total + $post->packaging_price)
                            @endif
                            @if($post->pickup_cost)
                                <tr style="text-align: right;border: 1px solid #000;">
                                    <td style="text-align: left;border: 1px solid #000;">Pickup Charge</td>
                                    <td style="text-align: right;border: 1px solid #000;">{{number_format($post->pickup_cost, 2)}}</td>
                                </tr>
                                @php($total = $total + $post->pickup_cost)
                            @endif
                            @if($delivery_cost)
                                <tr>
                                    <td>Delivery to specific location</td>
                                    <td class="text-right">{{number_format($delivery_cost, 2)}}</td>
                                </tr>
                                @php($total = $total + $delivery_cost)
                            @endif
                            <tr style="border: 1px solid #000;">
                                <th style="text-align: right;border: 1px solid #000;">Total</th>
                                <th style="text-align: right;border: 1px solid #000;">{{get_currency_symbol($agent->country) . number_format($total, 2)}}</th>
                            </tr>
                            @if($post->discount)
                                <tr style="text-align: right;border: 1px solid #000;">
                                    <th style="text-align: right;border: 1px solid #000;">Discount</th>
                                    <th style="text-align: right;border: 1px solid #000;">{{get_currency_symbol($agent->country) . number_format($post->discount, 2)}}</th>
                                </tr>
                                @php($total = $total - $post->discount)
                            @endif

                            @if($post->vat)
                                <tr>
                                    <th class="text-right">VAT ( {{$post->vat}}% )</th>
                                    <th class="text-right">{{get_currency_symbol($agent->country)}}{{$vat = number_format($total * $post->vat / 100, 2)}}</th>
                                </tr>
                                @php($total = $total + $vat)
                            @endif
                            <tr style="text-align: right;border: 1px solid #000;">
                                <th style="text-align: right;border: 1px solid #000;">Grand Total</th>
                                <th style="text-align: right;border: 1px solid #000;">{{get_currency_symbol($agent->country) . number_format($total, 2)}}</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel-heading"><h4>Terms & Conditions</h4></div>
            <div class="panel-body" style="text-align: justify;">
                {!! get_settings('tandc4parcel', '') !!}
            </div>
        </div> {{-- end of row   --}}
            <br>
        <div class="row">
            <div class="col-xs-6 left" style="width: 50%;float: left;">
                <div class="panel panel-default all-invoice cus-pa" style="border: 1px solid #333333 !important;padding:0px 10px !important; margin-right: 2px !important;padding-bottom: 73px !important;">
                    <div class="panel-heading"><h4>Customer Signature</h4></div>
                    <div class="panel-body">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 right" style="width: 50%;float: left;">
                <div class="panel panel-default all-invoice cus-cre" style="border: 1px solid #333333 !important;margin-left: 2px !important;padding:0px 10px !important;padding-bottom: 17px !important;">
                    <div class="panel-heading"><h4>Invoice Created By</h4></div>
                    <div class="panel-body">
                    Name: {{$post->user->name}}<br>
                        <br>
                    Signature:
                        <br>
                    </div>
                </div>
            </div>
        </div> {{-- end of row   --}}
        <br>
        </div>
        <div style="padding: 0 10px 10px;" class="buttonBar text-center">
            <div class="btn btn-primary button b1">Print</div> <input type="checkbox" class="selPA" value="area1" checked />
            <div class="settingVals">
                <input type="hidden" class="selPA" value="area1" checked /><br>
            </div>
        </div>
    </div>

@stop
