<div class="row" style="border: solid thin lightgray;">
    <div class="col-xs-4 col-sm-3 col-md-2 text-right highlighted"><h4>Latest Update</h4></div>
    <div class="col-xs-8 col-sm-9 col-md-10">
        <div class="TickerNews" id="T1">
            <div class="ti_wrapper">
                <div class="ti_slide">

                    <div class="ti_content">
                        @if($feeds = get_site_feeds())
                            @foreach($feeds as $feed)
                                <div class="ti_news"><a href="{{url($feed->link ? $feed->link: '#')}}" target="{{$feed->link ? '_blank' : '_self'}}"> {{$feed->text}} </a></div>
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>