<div class="sidebar">
    {{--<div class="widget_search">--}}
    {{--<form action="#" class="search-form" method="get">--}}
    {{--<label>--}}
    {{--<span class="screen-reader-text">Search for:</span>--}}
    {{--<input type="search" name="s" value="" placeholder="Search ..." class="search-field">--}}
    {{--</label>--}}
    {{--<button class="search-submit" type="submit"><i class="fa fa-lg fa-search"></i></button>--}}
    {{--</form>--}}
    {{--</div>--}}
    <div class="widget_recent_entries">
        <h4 class="sidebar__headings">RECENT NEWS</h4> <ul>
            @if($news = get_site_news(10))
                @foreach($news as $item)
                    <li><a href="{{url('news/' . $item->slug)}}">{{title_case($item->title)}}</a></li>
                @endforeach
            @endif
        </ul>
    </div>
    {{--<div class="widget_tag_cloud">--}}
        {{--<h4 class="sidebar__headings">TAG CLOUD</h4>--}}
        {{--<div class="tagcloud">--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">Benefits</a>--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">Cargo</a>--}}
            {{--<a style="font-size: 10.4pt;" title="2 topics" href="#">logistic</a>--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">marketing</a>--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">Shipping</a>--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">Tracking</a>--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">transport</a>--}}
            {{--<a style="font-size: 12pt;" title="3 topics" href="#">Trucking</a>--}}
            {{--<a style="font-size: 8pt;" title="1 topic" href="#">Unbeatable Services</a>--}}
            {{--<a style="font-size: 10.4pt;" title="2 topics" href="#">Warehouse</a>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="widget_categories">--}}
        {{--<h4 class="sidebar__headings">CATEGORIES</h4>--}}
        {{--<ul>--}}
            {{--<li>--}}
                {{--<a href="#">Cargo</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Delivery</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">International</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Logistic</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Moving</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Shipping</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Storage</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Transport</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Trucking</a>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="#">Warehouse</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</div>--}}
</div>