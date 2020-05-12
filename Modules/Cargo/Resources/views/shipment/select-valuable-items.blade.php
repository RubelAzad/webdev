<option value="" data-max="" data-min="">Select item</option>
@if($valuables = get_valuable_items_by_source_destination($src, $dst))
    @foreach($valuables as $valuable)
        <option value="{{$valuable->id}}" data-max="{{$valuable->purchase_price}}" data-min="{{$valuable->price}}" data-max_cost="{{$valuable->max_price}}">{{$valuable->name}}</option>
    @endforeach
@endif