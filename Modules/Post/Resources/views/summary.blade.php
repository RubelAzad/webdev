
<div class="panel-group smart-accordion-default" id="accordion-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#sender" aria-expanded="false" class="collapsed">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Sender
                </a>
            </h4>
        </div>
        <div id="sender" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">

                @can('edit_shipment', $post)
                    <button id="btn_edit_sender" class="btn btn-warning pull-right"><i class="fa fa-edit"></i></button>
                @endcan
                <dl id="div_sender_info" class="dl-horizontal">
                    @if($sender = $post->sender)
                        <dt>Account Name</dt><dd>{{$sender->name}}</dd>
                        <dt>Address</dt>
                        <dd>
                            {{$sender->address_line_1}}
                            {!! $sender->address_line_2 ? '<br>' . $sender->address_line_2 : '' !!}
                            {!! $sender->address_line_3 ? '<br>' . $sender->address_line_3 : '' !!}
                            {!! $sender->city ? '<br>' . $sender->city : '' !!}
                            {!! $sender->county ? '<br>' . $sender->county : '' !!}
                            {!! $sender->postcode ? '<br>' . $sender->postcode : '' !!}
                            {!! $sender->country ? '<br>' . get_country_name($sender->country) : '' !!}
                        </dd>
                        <dt>Contact Person</dt><dd>{{$sender->contact_person}}</dd>
                        <dt>Contact Number</dt><dd>{{$sender->phone_number}}</dd>
                        <dt>Email Address</dt><dd>{{$sender->email}}</dd>
                    @endif
                </dl>

                <div id="div_edit_sender_info" style="display: none">
                    @include('post::form.sender', ['sender' => $post->sender, 'agent' => $post->agent])
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#receiver" class="collapsed" aria-expanded="false">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Receiver
                </a>
            </h4>
        </div>
        <div id="receiver" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                @can('edit_shipment', $post)
                    <button id="btn_edit_receiver" class="btn btn-warning pull-right"><i class="fa fa-edit"></i></button>
                @endcan
                <dl id="div_receiver_info" class="dl-horizontal">
                    @if($receiver = $post->receiver)
                        <dt>Account Name</dt><dd>{{$receiver->name}}</dd>
                        <dt>Address</dt>
                        <dd>
                            {{$receiver->address_line_1}}
                            {!! $receiver->address_line_2 ? '<br>' . $receiver->address_line_2 : '' !!}
                            {!! $receiver->address_line_3 ? '<br>' . $receiver->address_line_3 : '' !!}
                            {!! $receiver->city ? '<br>' . $receiver->city : '' !!}
                            {!! $receiver->county ? '<br>' . $receiver->county : '' !!}
                            {!! $receiver->postcode ? '<br>' . $receiver->postcode : '' !!}
                            {!! $receiver->country ? '<br>' . get_country_name($receiver->country) : '' !!}
                        </dd>
                        <dt>Contact Person</dt><dd>{{$receiver->contact_person}}</dd>
                        <dt>Contact Number</dt><dd>{{$receiver->phone_number}}</dd>
                        <dt>Email Address</dt><dd>{{$receiver->email}}</dd>
                    @endif
                </dl>
                <div id="div_edit_receiver_info" style="display: none">
                    @include('post::form.receiver', ['receiver' => $post->receiver])
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#delivery_address" class="collapsed" aria-expanded="false">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Delivery address
                </a>
            </h4>
        </div>
        <div id="delivery_address" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <dl class="dl-horizontal">
                    @php($delivery_cost = 0)
                    @if($delivery = $post->delivery)
                        <dt>Name</dt><dd>{{$delivery->name}}</dd>
                        <dt>Address</dt>
                        <dd>
                            {{$delivery->address_line_1}}
                            {!! $delivery->address_line_2 ? '<br>' . $delivery->address_line_2 : '' !!}
                            {!! $delivery->address_line_3 ? '<br>' . $delivery->address_line_3 : '' !!}
                            {!! $delivery->city ? '<br>' . $delivery->city : '' !!}
                            {!! $delivery->county ? '<br>' . $delivery->county : '' !!}
                            {!! $delivery->postcode ? '<br>' . $delivery->postcode : '' !!}
                            {!! $delivery->country ? '<br>' . get_country_name($delivery->country) : '' !!}
                        </dd>
                        <dt>Contact Person</dt><dd>{{$delivery->contact_person}}</dd>
                        <dt>Contact Number</dt><dd>{{$delivery->phone_number}}</dd>
                        <dt>Email Address</dt><dd>{{$delivery->email}}</dd>
                        <dt>Note</dt><dd>{{$delivery->instruction}}</dd>
                        @php($delivery_cost = $delivery_cost + $delivery->price)
                    @endif
                </dl>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#packages" class="collapsed" aria-expanded="false">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Package
                </a>
            </h4>
        </div>
        <div id="packages" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body no-padding">
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Package Type</th>
                        <th>Quantity</th>
                        <th>Weight</th>
                        <th>Length</th>
                        <th>Width</th>
                        <th>Height</th>
                        <th>Volume</th>
                        <th>Net Weight</th>
                        <th>Final Weight</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($packages = $post->packages)
                        @foreach($packages as $package)
                            <tr>
                                <td>{{$package->type->name}}</td>
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
                                    <?php
                                        $pack_l = number_format(($package->length * $package->width * $package->height) / get_settings('mass_divider', 5000), 2);
                                        $pack_w = number_format($package->weight, 2);
                                        if( $pack_l > $pack_w ){
                                            echo $pack_l * $package->quantity;
                                        }else{
                                            echo $pack_w * $package->quantity;
                                        }
                                    ?>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#package_details" class="collapsed" aria-expanded="false">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Package Details
                </a>
            </h4>
        </div>
        <div id="package_details" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body">
                <dl class="dl-horizontal">
                    <dt>Description</dt><dd>{{$post->description}}</dd>
                    <dt>Declare Value</dt><dd>{{number_format($post->value, 2)}}</dd>
                </dl>
                @if($post->items->count())
                    @if($items = $post->items)
                        <fieldset>
                            <legend>Valuable Items:</legend>
                        </fieldset>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th class="center">SN</th>
                                <th>Name</th>
                                <th class="center">Value</th>
                                <th class="center">Shipment Cost</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($i = 1)
                                @foreach($items as $item)
                                    <tr>
                                        <td class="center">{{$i++}}</td>
                                        <td>{{$item->name}}</td>
                                        <td class="center">{{number_format($item->value, 2)}}</td>
                                        <td class="center">{{number_format($item->tax, 2)}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#cost_summary" class="collapsed" aria-expanded="false">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Cost Summary
                </a>
            </h4>
        </div>
        <div id="cost_summary" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body no-padding">
                @php($total = 0)
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th class="center">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            {{$post->service->provider->name}} - {{$post->service->name}} <br>
                            {{$post->service->speed}}
                        </td>
                        <td class="center">
                            @php($package_total = number_format(get_total_weight($post->packages) * $post->unit_price, 2))
                            {{$package_total = number_format(parseFloat($package_total >= $post->base_price ? $package_total : $post->base_price), 2)}}
                        </td>
                        @php($total = $total + parseFloat($package_total))
                    </tr>
                    @if($post->billing->location_charge)
                        <tr>
                            <td>Location Charge</td>
                            <td class="center">
                                {{$location_charge = number_format(get_total_weight($post->packages) * $post->billing->location_charge, 2, '.', '')}}
                            </td>
                        </tr>
                        @php($total = $total + $location_charge)
                    @endif
                    @if($post->transport_cost)
                        <tr>
                            <td>Additional transport cost</td>
                            <td class="center">{{number_format($post->transport_cost, 2)}}</td>
                        </tr>
                        @php($total = $total + $post->transport_cost)
                    @endif
                    @if($post->items->count())
                        @if($items = $post->items)
                            @foreach($items as $item)
                                <tr>
                                    <td>{{$item->name}}</td>
                                    <td class="center">{{$tax_total = number_format($item->tax, 2)}}</td>
                                </tr>
                                @php($total = $total + $tax_total)
                            @endforeach
                        @endif
                    @endif

                    @if($post->insurances->count())
                        @php($insurance_price = 0)
                        <tr>
                            <td>
                                @if($items = $post->insurances)
                                    Insurance for following item(s) in the package
                                    <ul>
                                        @foreach($items as $item)
                                            <li>{{$item->name}} - ({{number_format($item->cost, 2)}})</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td class="center">
                                {{number_format($post->insurances->sum('cost'), 2)}}
                            </td>
                        </tr>
                        @php($total = $total + $post->insurances->sum('cost'))
                    @endif
                    @if($post->packaging)
                        <tr>
                            <td>Additional Packaging {{$post->packaging_description ? ' (' . $post->packaging_description . ')' : ''}}</td>
                            <td class="center">{{number_format($post->packaging_price, 2)}}</td>
                        </tr>
                        @php($total = $total + $post->packaging_price)
                    @endif
                    @if($post->pickup_cost)
                        <tr>
                            <td>Pickup Charge</td>
                            <td class="center">{{number_format($post->pickup_cost, 2)}}</td>
                        </tr>
                        @php($total = $total + $post->pickup_cost)
                    @endif
                    @if($delivery_cost)
                        <tr>
                            <td>Delivery to specific location</td>
                            <td class="center">{{number_format($delivery_cost, 2)}}</td>
                        </tr>
                        @php($total = $total + $delivery_cost)
                    @endif
                    <tr>
                        <th class="text-right">Total</th>
                        <th class="center">{{number_format($total, 2)}}</th>
                    </tr>
                    @if($post->discount)
                        <tr>
                            <td class="text-right">Discount</td>
                            <td class="center">{{number_format($post->discount, 2)}}</td>
                        </tr>
                        @php($total = $total - $post->discount)
                    @endif
                    @if($post->vat)
                        <tr>
                            <th class="text-right">VAT ( {{$post->vat}}% )</th>
                            <th class="text-center">{{$vat = number_format($total * $post->vat / 100, 2)}}</th>
                        </tr>
                        @php($total = $total + $vat)
                    @endif
                    <tr>
                        <th class="text-right">Grand Total</th>
                        <th class="center">{{number_format($total, 2)}}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion-2" href="#payment_info" class="collapsed" aria-expanded="false">
                    <i class="fa fa-fw fa-plus-circle txt-color-green"></i>
                    <i class="fa fa-fw fa-minus-circle txt-color-red"></i>
                    Payment Information
                </a>
            </h4>
        </div>
        <div id="payment_info" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
            <div class="panel-body no-padding">
                <table class="table table-bordered">
                    <tr>
                        <th>Payment Method</th>
                        <td>{{title_case($post->payment_method)}}</td>
                    </tr>
                    <tr>
                        <th>Payment Reference</th>
                        <td>
                            {{$post->payment_method == 'online' ? 'Last 4 digit of the card: ' . $card_number : $post->payment_reference }}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

</div>

