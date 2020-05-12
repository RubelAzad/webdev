<div id="pickup_list_container" class="container">
    <div class="panel panel-default">
        <div class="panel-heading" style="padding: 10px">
            <h3 class="panel-title">Pickup List #{{$pickup->id}}</h3>
        </div>
        <div class="panel-body">
            <table class="table no-border table-border-0">
                <tbody>
                <tr>
                    <th style="width: 200px; border: 0!important;">Created at</th>
                    <td style="border: 0!important;">: {{$pickup->created_at->format('d/m/Y : H:m')}}</td>
                </tr>
                <tr>
                    <th style="border: 0!important;">Warehouse</th>
                    <td style="border: 0!important;">: {{$pickup->warehouse->name}}</td>
                </tr>
                <tr>
                    <th style="border: 0!important;">Driver</th>
                    <td style="border: 0!important;">:
                        @if($pickup->external_driver)
                            {{$pickup->ext_driver->name}}
                        @else
                            {{$pickup->driver->name}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="border: 0!important;">Agent</th>
                    <td style="border: 0!important;">: {{$pickup->agent->name}}</td>
                </tr>
                <tr>
                    <th style="border: 0!important;">Estimated Pickup Date</th>
                    <td style="border: 0!important;">: {{$pickup->est_pickup_date ? $pickup->est_pickup_date->format('d/m/Y') : ''}}</td>
                </tr>
                <tr>
                    <th style="border: 0!important;">Note</th>
                    <td style="border: 0!important;">: {{$pickup->note}}</td>
                </tr>
                </tbody>
            </table>

            <br>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th class="center">Tracking No</th>
                    <th class="center">Booking Date</th>
                    <th>Receiver</th>
                    <th class="center">Mobile Number</th>
                    <th>Destination</th>
                    <th class="center">Pieces</th>
                    <th class="center">Weight</th>
                    <th class="center">Valuable Items</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts->sortByDesc('id') as $post)
                    <tr>
                        <td class="center"><a href="{{url('post/view/' . $post->post->tracking_no)}}">{{strtoupper($post->post->tracking_no)}}</a></td>
                        <td class="center">{{$post->post->created_at->format('d/m/Y')}}</td>
                        <td>{{$post->post->receiver ? $post->post->receiver->name : ''}}</td>
                        <td class="center">{{$post->post->receiver ? $post->post->receiver->phone_number : ''}}</td>
                        <td>{{$post->post->receiver ? get_country_name($post->post->receiver->country) : ''}}</td>
                        <td class="center">{{$post->post->packages ? $post->post->packages->sum('quantity') : ''}}</td>
                        <td class="center">{{$post->post->packages ? number_format(get_total_weight($post->post->packages), 2) : ''}} kg</td>
                        <td>{{$post->post->items->count() ? $post->post->items->implode('name') : ''}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>