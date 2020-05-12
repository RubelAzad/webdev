<div class="container">
    @if(session('agent') != $agent->id)
        <h3>Commission: {{number_format($agent->commission, 2)}}%</h3>
        <h3>Additional Commission: {{number_format($agent->increment, 2)}}%</h3>
        <h3>Commission on Valuable Items: {{number_format($agent->commission_valuable, 2)}}%</h3>
        <h3>Additional charge for pickup: {{get_currency_symbol($agent->country)}}{{number_format($agent->additional_charge, 2)}}</h3>
        <h3>Location Charge: {{number_format($agent->location_charge, 2)}} per kg</h3>
    @endif

@if($agent->zone_id)
    <h3>Area: {{$agent->zone->name}} in {{$agent->main_country->name}}</h3>
@endif
<table class="table table-bordered" style="max-width: 400px">
    <tr>
        <td>Allow to provide discount</td>
        <td class="center">
            @can('edit_agent', \Modules\Agent\Entities\Agent::class)
                <input type="checkbox" name="allow_discount" id="allow_discount" {{$agent->allow_discount ? 'checked' : ''}}>
            @else
                <i class="fa fa-{{$agent->allow_discount ? 'check' : 'times'}}"></i>
            @endcan
        </td>
    </tr>
    <tr>
        <td>Customer drop off</td>
        <td class="center">
            @can('edit_agent', \Modules\Agent\Entities\Agent::class)
                <input type="checkbox" name="receive" id="receive" {{$agent->receive ? 'checked' : ''}}>
            @else
                <i class="fa fa-{{$agent->receive ? 'check' : 'times'}}"></i>
            @endcan
        </td>
    </tr>
    <tr>
        <td>Pickup from Sender</td>
        <td class="center">
            @can('edit_agent', \Modules\Agent\Entities\Agent::class)
                <input type="checkbox" name="pickup" id="pickup" {{$agent->pickup ? 'checked' : ''}}>
            @else
                <i class="fa fa-{{$agent->pickup ? 'check' : 'times'}}"></i>
            @endcan
        </td>
    </tr>
    <tr>
        <td>Customer collection</td>
        <td class="center">
            @can('edit_agent', \Modules\Agent\Entities\Agent::class)
                <input type="checkbox" name="collection" id="collection" {{$agent->collection ? 'checked' : ''}}>
            @else
                <i class="fa fa-{{$agent->collection ? 'check' : 'times'}}"></i>
            @endcan
        </td>
    </tr>
    <tr>
        <td>Home delivery</td>
        <td class="center">
            @can('edit_agent', \Modules\Agent\Entities\Agent::class)
                <input type="checkbox" name="delivery" id="delivery" {{$agent->delivery ? 'checked' : ''}}>
            @else
                <i class="fa fa-{{$agent->delivery ? 'check' : 'times'}}"></i>
            @endcan
        </td>
    </tr>
</table>

</div>