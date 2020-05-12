<div class="panel panel-default">
    <div class="panel-body">
        <fieldset class="col-sm-4">
            <legend>Sender</legend>
            @if($sender = $draft->sender)
                {{$sender->name}}
                <br>{{$sender->address_line_1}}
                {!! $sender->address_line_2 ? '<br>' . $sender->address_line_2 : '' !!}
                {!! $sender->address_line_3 ? '<br>' . $sender->address_line_3 : '' !!}
                {!! $sender->city ? '<br>' . $sender->city : '' !!}
                {!! $sender->county ? '<br>' . $sender->county : '' !!}
                {!! $sender->postcode ? '<br>' . $sender->postcode : '' !!}
                {!! $sender->country ? '<br>' . get_country_name($sender->country) : '' !!}
                <br>Contact Person: {{$sender->contact_person}}
                <br>Contact Number: {{$sender->phone_number}}
                <br>Email Address: {{$sender->email}}
            @endif
        </fieldset>

        <fieldset class="col-sm-4">
            <legend>Receiver</legend>
            @if($receiver = $draft->receiver)
                {{$receiver->name}}
                <br>{{$receiver->address_line_1}}
                {!! $receiver->address_line_2 ? '<br>' . $receiver->address_line_2 : '' !!}
                {!! $receiver->address_line_3 ? '<br>' . $receiver->address_line_3 : '' !!}
                {!! $receiver->city ? '<br>' . $receiver->city : '' !!}
                {!! $receiver->county ? '<br>' . $receiver->county : '' !!}
                {!! $receiver->postcode ? '<br>' . $receiver->postcode : '' !!}
                {!! $receiver->country ? '<br>' . get_country_name($receiver->country) : '' !!}
                <br>Contact Person: {{$receiver->contact_person}}
                <br>Contact Number: {{$receiver->phone_number}}
                <br>Email Address: {{$receiver->email}}
            @endif
        </fieldset>

        <fieldset class="col-sm-4">
            @php($delivery_cost = 0)
            @if($delivery = collect(json_decode($draft->delivery)))

                @if($delivery->has('delivery') && $delivery->get('delivery'))
                    <legend>Delivery address</legend>
                    {{$delivery->get('name')}}
                    <br>{{$delivery->get('address_line_1')}}
                    {!! $delivery->get('address_line_2') ? '<br>' . $delivery->get('address_line_2') : '' !!}
                    {!! $delivery->get('address_line_3') ? '<br>' . $delivery->get('address_line_3') : '' !!}
                    {!! $delivery->get('city') ? '<br>' . $delivery->get('city') : '' !!}
                    {!! $delivery->get('county') ? '<br>' . $delivery->get('county') : '' !!}
                    {!! $delivery->get('postcode') ? '<br>' . $delivery->get('postcode') : '' !!}
                    {!! $delivery->get('country') ? '<br>' . get_country_name($delivery->get('country')) : '' !!}
                    <br>Contact Person: {{$delivery->get('contact_person')}}
                    <br>Contact Number: {{$delivery->get('phone_number')}}
                    <br>Email Address: {{$delivery->get('email')}}
                    <br>Note: {{$delivery->get('instruction')}}
                    @php($delivery_cost = $delivery_cost + $delivery->get('price'))
                @else
                    {{--@php(dd($delivery))--}}
                    <legend>Collection point</legend>
                    @if($agent = get_agent_by_id($delivery->get('agent_id')))
                        {{$agent->name}}
                        <br>{{$agent->address_line_1}}
                        {!! $agent->address_line_2 ? '<br>' . $agent->address_line_2 : '' !!}
                        {!! $agent->address_line_3 ? '<br>' . $agent->address_line_3 : '' !!}
                        {!! $agent->city ? '<br>' . $agent->city : '' !!}
                        {!! $agent->county ? '<br>' . $agent->county : '' !!}
                        {!! $agent->postcode ? '<br>' . $agent->postcode : '' !!}
                        {!! $agent->country ? '<br>' . get_country_name($agent->country) : '' !!}
                        <br>Contact Number: {{$agent->phone_number}}
                        <br>Email Address: {{$agent->email}}
                    @endif
                    @php($delivery_cost = $delivery_cost + $delivery->get('collection_price'))
                @endif
            @endif
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Package Details</h4></div>
            <div class="panel-body">
                @php($t1=0)
                @if($packages = json_decode($draft->packages))
                    @foreach($packages as $package)
                        @php($test = $package->weight)

                        @php($t1 = $t1 + $test)

                    @endforeach
                    <b>Net Weight:</b> {{$t1}} kg<br>

                @endif
                @php($total_kg = 0)
                @php($tot_quan = 0)
                @if($packages = json_decode($draft->packages))
                    <b>Gross Weight:</b>
                    <ul>

                        @foreach($packages as $package)
                            @php($t_quan = $package->quantity)
                            @php($tot_quan = $tot_quan + $t_quan)
                            @php($test1=(($package->length * $package->width * $package->height) / get_settings('mass_divider', 5000)))
                            @php($test = $package->weight)
                            <li>
                                {{$package->type_name}} {{$t_quan }} x
                                @if( $test1 > $test)
                                    {{number_format( $test1, 2, '.', '') }} = {{$test1 * $t_quan}}
                                    @php($total_kg = $total_kg + $test1)
                                @else
                                    {{number_format($test, 2, '.', '')}} = {{$test * $t_quan}}

                                    @php($total_kg = $total_kg + $test)
                                @endif
                                kg

                            </li>
                        @endforeach
                    </ul>
                @endif
                <b>Description:</b> {{$draft->description}} <br>
                <b>Declare Value:</b> {{number_format($draft->value, 2, '.', '')}}
                @if($items = json_decode($draft->items))
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Valuable Item</th>
                            <th>Value</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{number_format($item->value, 2, '.', '')}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="panel panel-success">
            <div class="panel-heading">Cost Summary</div>
            @php($total = 0)
            <div class="panel-body no-padding">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th class="center">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php($total_kg1 = 0)
                    @php($t_quan=0)
                    @php($all_quan_pack=0)
                    @if($packages = json_decode($draft->packages))
                        @foreach($packages as $package)
                            @php($t_quan = $package->quantity)
                            @php($tot_quan = $tot_quan + $t_quan)
                            @php($test12=(($package->length * $package->width * $package->height) / get_settings('mass_divider', 5000)))
                            @php($test2 = $package->weight)
                            <tr>
                                <td>
                                    {{--{{$package->type_name}} -  {{number_format( $test1, 2, '.', '') }} = {{$test1 * $t_quan}}kg <br>--}}
                                    @if( $test12 > $test2)
                                        {{$draft->service->name}} ( {{$package->type_name}} ) - {{$test12 * $t_quan}}kg
                                        @php($total_kg1 = $total_kg1 + $test12)
                                    @else
                                        {{$draft->service->name}} ( {{$package->type_name}} ) - {{$test2 * $t_quan}}kg

                                        @php($total_kg1 = $total_kg1 + $test2)
                                    @endif
                                </td>
                                <td class="center">
                                    @if( $test12 > $test2)
                                        @php($total_weight1 = $test12 *  $t_quan)
                                        @php($package_price1 = get_service_price($service->price, $service->commission, $draft->agent))
                                        @php($package_total1 = get_service_price_total($service->base_price, $package_price1, $service->commission, $total_weight1, $draft->agent))
                                        {{ $package_total1 }}
                                    @else
                                        @php($total_weight1 = $test2 *  $t_quan)
                                        @php($package_price1 = get_service_price($service->price, $service->commission, $draft->agent))
                                        @php($package_total1 = get_service_price_total($service->base_price, $package_price1, $service->commission, $total_weight1, $draft->agent))
                                        {{ $package_total1 }}

                                    @endif
                                </td>
                                @php($total = $total + parseFloat($package_total1))
                            </tr>
                        @endforeach
                        @if($draft->agent->location_charge)
                            <tr>
                                <td>Location Charge</td>
                                <td class="center">
                                    {{$location_charge = number_format($total_weight * $draft->agent->location_charge, 2, '.', '')}}
                                </td>
                            </tr>
                            @php($total = $total + $location_charge)
                        @endif
                        @if($draft->agent->additional_charge)
                            <tr>
                                <td>Additional Transport Cost</td>
                                <td class="center">
                                    {{$transport_cost = number_format(get_transport_cost($packages, $draft->agent->additional_charge), 2, '.', '')}}
                                </td>
                            </tr>
                            @php($total = $total + $transport_cost)
                        @endif
                    @endif
                    @if($items = json_decode($draft->items, true))
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td class="center">{{$tax_total = number_format($item['cost'], 2)}}</td>
                            </tr>
                            @php($total = $total + $tax_total)
                        @endforeach
                    @endif

                    @if($draft->insurance)
                        @if($insurance = json_decode($draft->insurance))
                            @php($insurance_price = 0)
                            <tr>
                                <td>
                                    Insurance for following item(s):
                                    <ul>
                                        @foreach($insurance as $item)
                                            @if($item->keep)
                                                <li>{{$item->name}} - ({{number_format($item->cost, 2)}})</li>
                                                @php($insurance_price = $insurance_price + $item->cost)
                                            @endif
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="center">
                                    {{$insurance_total = number_format($insurance_price, 2)}}
                                </td>
                            </tr>
                            @php($total = $total + $insurance_total)
                        @endif
                    @endif
                    @if($packaging = json_decode($draft->optionals))
                        @if(property_exists($packaging, 'pickup_cost'))
                            @if($packaging->pickup_cost)
                                <tr>
                                    <td>Pickup Charge</td>
                                    <td class="center">{{number_format($packaging->pickup_cost, 2)}}</td>
                                </tr>
                                @php($total = $total + $packaging->pickup_cost)
                            @endif
                        @endif

                        @if(property_exists($packaging, 'packaging'))
                            @if($packaging->packaging)
                                <tr>
                                    <td>Additional Packaging {{$packaging->packaging_description ? ' (' . $packaging->packaging_description . ')' : ''}}</td>
                                    <td class="center">{{number_format($packaging->packaging_price, 2)}}</td>
                                </tr>
                                @php($total = $total + $packaging->packaging_price)
                            @endif
                        @endif
                    @endif
                    @if($delivery_cost)
                        <tr>
                            <td>Delivery to specific location</td>
                            <td class="center">{{number_format($delivery_cost, 2)}}</td>
                        </tr>
                        @php($total = $total + $delivery_cost)
                    @endif
                    <tr>
                        <th class="text-center">Total</th>
                        <th class="center"><span class="total">{{number_format($total, 2)}}</span></th>
                    </tr>
                    @if(discount_allowed(session('agent')))
                        <tr>
                            <th class="text-center">Discount</th>
                            <th class="center">
                                <input type="number" class="form-control discount center" data-max="{{get_maximum_discount_allowed($draft)}}" min="0" value="{{$packaging && isset($packaging->discount) ? $discount = $packaging->discount : $discount = 0}}">
                            </th>
                            @php($total = $total - $discount)
                        </tr>
                    @endif
                    @if($vat_applicable = get_vat_by_country_3166_3($draft->sender->country, $draft->receiver->country) > 0)
                        <tr>
                            <th class="text-center">VAT ({{$vat_applicable}}%)</th>
                            <th class="center"><span class="vat">{{$vat = number_format($total * $vat_applicable / 100, 2)}}</span></th>
                        </tr>
                        @php($total = $total + $vat)
                    @endif
                    <tr>
                        <th class="text-center">Grand Total</th>
                        <th class="center"><span class="grand_total">{{number_format($total, 2)}}</span></th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
