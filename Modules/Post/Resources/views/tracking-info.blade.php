<table class="table">
    <thead>
    <tr>
        <th>SN</th>
        <th>Updated at</th>
        <th>Location</th>
        <th>Description</th>
    </tr>
    </thead>
    <tbody>
    @if($histories->count() && $i = 1)
        @foreach($histories->sortByDesc('id') as $history)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$history->created_at->format('d/m/Y : H:i')}}</td>
                <td>{{$post->agent->city}}</td>
                <td>{{$history->description}}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>