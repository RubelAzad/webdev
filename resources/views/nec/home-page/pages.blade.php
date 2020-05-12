<div class="row jumbotron-overlap first">

    <div class="col-sm-3">
        @if($f_page)
            <div class="featured-widget">
                <h3 class="widget-title">{{strtoupper($f_page->title)}}</h3>
                {!! str_limit($f_page->body, 400, '...') !!}
                <p><a class="read-more" href="{{url('page/' . $f_page->slug)}}">READ MORE</a></p>
            </div>
        @endif
    </div><!-- /.col -->

    @foreach($pages as $page)
        <div class="col-sm-3">

            <a href="{{url('page/' . $page->slug)}}">
                <img alt="{{$page->title}}" class="post-image" sizes="(min-width: 781px) 360px, calc(100vw - 30px)" srcset="{{url('file/serve/' . $page->image)}} 360w, {{url('file/serve/' . $page->image)}} 848w" src="{{url('file/serve/' . $page->image)}}">
            </a>

            <h5 class="page-box__title"><a href="{{url('page/' . $page->slug)}}">{{strtoupper($page->title)}}</a></h5>
            {!! str_limit($page->body, 250, '...') !!}
            <p>
                <a class="read-more" href="{{url('page/' . $page->slug)}}">Read more</a>
            </p>

        </div>
    @endforeach
</div><!-- /.row -->