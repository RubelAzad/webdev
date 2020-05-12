<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">You are about to submit the following</h3>
    </div>
    <div class="panel-body no-padding">
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th class="center">Item</th>
                <th class="center">Quantity</th>
                <th class="center">Weight(kg)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($packages as $package)
                <tr>
                    <td class="center">{{$package['name']}}</td>
                    <td class="center">{{$package['quantity']}}</td>
                    <td class="center">{{$package['weight']}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="panel-footer text-left">
        <ul>
            <li>Your available credit: {{get_currency_symbol($agent->country) . number_format($available_credit, 2)}}</li>
            <li>Total cost for this request: {{get_currency_symbol($agent->country) . number_format($total_cost, 2)}}</li>
        </ul>
        @if( ! $allow_to_submit)
            <div class="alert alert-danger">
                Your Available credit limit is less than the total cost!
            </div>
        @endif
    </div>
</div>