<div class='panel panel-info'>
    <div class='panel-heading'><h3 class='panel-title'>Commission Breakdown</h3></div>
    <div class='panel-body no-padding'>
        <table class='table table-bordered' style='margin-bottom: 0'>
            <tbody>
            <tr>
                <th>Weight</th>
                <td class='text-right'>{{number_format(get_agent_commission_on_weight_post($post), 2)}}</td>
            </tr>
            @if($post->items->count())
                <tr>
                    <th>Valuable Items</th>
                    <td class='text-right'>{{number_format(get_agent_com_on_items_post($post), 2)}}</td>
                </tr>
            @endif

            @if($post->insurances->count())
                <tr>
                    <th>Insurance</th>
                    <td class='text-right'>{{number_format($post->insurances->sum('com_agent'), 2)}}</td>
                </tr>
            @endif

            @if($post->pickup_cost)
                <tr>
                    <th>Pickup Cost</th>
                    <td class='text-right'>{{number_format( $post->pickup_cost, 2)}}</td>
                </tr>
            @endif

            @if($post->packaging)
                <tr>
                    <th>Packaging</th>
                    <td class='text-right'>{{number_format( $post->packaging_price, 2)}}</td>
                </tr>
            @endif

            @if($post->discount)
                <tr>
                    <th class='text-danger'>Discount</th>
                    <td class='text-right text-danger'>-{{number_format($post->discount, 2)}}</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
