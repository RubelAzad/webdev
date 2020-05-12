@php($currency_symbol = get_currency_symbol($draft->agent->country))

<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4">
                <h4><u>Sender</u></h4>
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
            </div>
            <div class="col-xs-4">
                <h4><u>Receiver</u></h4>
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
            </div>
            <div class="col-xs-4">
                @php($delivery_cost = 0)
                @if($delivery = collect(json_decode($draft->delivery)))

                    @if($delivery->has('delivery') && $delivery->get('delivery'))
                        <h4><u>Delivery address</u></h4>
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
                        <h4><u>Collection address</u></h4>
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
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xs-6 left">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Package Details</h4></div>
            <div class="panel-body">
                @php($total_kg = 0)
                @if($packages = json_decode($draft->packages))
                    <ul>
                        @foreach($packages as $package)
                            <li>
                                {{$package->quantity}} x {{$package->type_name}} -
                                @if($package->length && $package->width && $package->height)
                                    @php($this_kg = $package->length * $package->width * $package->height) / get_settings('mass_divider', 5000))
                                    {{number_format( $this_kg, 2) }}
                                    @php($total_kg = $total_kg + $this_kg)
                                @else
                                    @php($this_kg = $package->weight)
                                    {{number_format($this_kg, 2)}}
                                    @php($total_kg = $total_kg + $this_kg)
                                @endif
                                kg
                            </li>
                        @endforeach
                    </ul>
                @endif
                <b>Description:</b> {{$draft->description}} <br>
                <b>Declare Value:</b> {{number_format($draft->value, 2)}}
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
                                <td>{{number_format($item->value, 2)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading"><h4>Terms & Conditions</h4></div>
            <div class="panel-body">
                {!! get_settings('tandc4parcel', '') !!}
            </div>
        </div>
    </div>
    <div class="col-xs-6 right">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Cost Summary</h4></div>
            <div class="panel-body no-padding">
                @php($total = 0)
                <table class="table table-bordered no-margin-bottom">
                    <thead>
                    <tr>
                        <th>Description</th>
                        <th class="text-right">Price ({{$currency_symbol}})</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($packages = json_decode($draft->packages))
                        <tr>
                            <td>
                                {{$draft->service->name}} - {{number_format($total_kg, 2)}}kg <br>
                                Est. Delivery: {{$draft->service->speed}}
                            </td>
                            <td class="text-right">
                                @php($total_weight = get_total_weight($packages))
                                @php($package_price = get_service_price($draft->service->price, $draft->service->commission, $draft->agent))
                                @php($package_total = get_service_price_total($draft->service->base_price, $package_price, $draft->service->commission, $total_weight, $draft->agent))
                                {{$package_total}}
                            </td>
                            @php($total = $total + parseFloat($package_total))
                        </tr>
                        @if($draft->agent->location_charge)
                            <tr>
                                <td>Location Charge</td>
                                <td class="text-right">
                                    {{$location_charge = number_format($total_weight * $draft->agent->location_charge, 2, '.', '')}}
                                </td>
                            </tr>
                            @php($total = $total + $location_charge)
                        @endif
                        @if($draft->agent->additional_charge)
                            <tr>
                                <td>Additional Transport Cost</td>
                                <td class="text-right">
                                    {{$transport_cost = number_format(get_transport_cost($packages, $draft->agent->additional_charge), 2)}}
                                </td>
                            </tr>
                            @php($total = $total + $transport_cost)
                        @endif
                    @endif

                    @if($items = json_decode($draft->items, true))
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item['name']}}</td>
                                <td class="text-right">{{$tax_total = number_format($item['cost'], 2)}}</td>
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
                                <td class="text-right">
                                    {{$insurance_total = number_format($insurance_price, 2)}}
                                </td>
                            </tr>
                            @php($total = $total + $insurance_total)
                        @endif
                    @endif
                    @if($packaging = json_decode($draft->optionals))
                        @if(isset($packaging->pickup_cost) && $packaging->pickup_cost)
                            <tr>
                                <td>Pickup Charge</td>
                                <td class="text-right">{{ number_format($packaging->pickup_cost, 2)}}</td>
                            </tr>
                            @php($total = $total + $packaging->pickup_cost)
                        @endif
                        @if(isset($packaging->packaging))
                            @if(isset($packaging->packaging_price))
                                <tr>
                                    <td>Additional Packaging {{$packaging->packaging_description ? ' (' . $packaging->packaging_description . ')' : ''}}</td>
                                    <td class="text-right">{{number_format($packaging->packaging_price, 2)}}</td>
                                </tr>
                                @php($total = $total + $packaging->packaging_price)
                            @endif
                        @endif
                    @endif
                    @if($delivery_cost)
                        <tr>
                            <td>Delivery to specific location</td>
                            <td class="text-right">{{ number_format($delivery_cost, 2)}}</td>
                        </tr>
                        @php($total = $total + $delivery_cost)
                    @endif
                    <tr>
                        <th class="text-right">Total</th>
                        <th class="text-right">{{$currency_symbol . number_format($total, 2)}}</th>
                    </tr>
                    @if($packaging && isset($packaging->discount))
                        <tr>
                            <th class="text-right">Discount</th>
                            <th class="text-right">{{$currency_symbol . number_format($packaging->discount, 2)}}</th>
                        </tr>
                        @php($total = $total - $packaging->discount)
                    @endif
                    @if($vat_applicable = get_vat_by_country_3166_3($draft->sender->country, $draft->receiver->country))
                        <tr>
                            <th class="text-right">VAT ( {{$vat_applicable}}% )</th>
                            <th class="text-right">{{$currency_symbol . $vat = number_format($total * $vat_applicable / 100, 2)}}</th>
                        </tr>
                        @php($total = $total + $vat)
                    @endif
                    <tr>
                        <th class="text-right">Grand Total</th>
                        <th class="text-right">{{$currency_symbol . number_format($total, 2)}}</th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> {{-- end of row   --}}
