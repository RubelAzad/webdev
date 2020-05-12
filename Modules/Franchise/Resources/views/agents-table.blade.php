<table id="tbl_agents" class="table table-bordered table-hover table-condensed" width="100%" cellspacing="0">
    <thead>
    <tr>
        <th class="center">SN</th>
        <th>Name</th>
        <th class="center">City</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @if($agents->count() && $i=1)
        @foreach($agents as $agent)
            <tr>
                <td class="center">{{$i++}}</td>
                <td><a href="{{url('agent/view/'. $agent->id)}}">{{$agent->name}}</a></td>
                <td class="center">{{$agent->city}}</td>
                <th></th>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>