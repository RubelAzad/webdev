<div class="news">

    <div class="container">

        <div class="row">

            @if($news = get_site_news(2))
                @foreach($news as $new)
                    <div class="col-sm-4 margin-bottom-30">

                        <div class="widget_pw_latest_news">
                            <a class="latest-news" href="{{url('news/' . $new->slug)}}">
                                <div class="latest-news__date">
                                    <div class="latest-news__date__month">{{$new->created_at->format('M')}}</div>
                                    <div class="latest-news__date__day">{{$new->created_at->format('d')}}</div>
                                </div>
                                <img alt="{{title_case($new->title)}}" class="wp-post-image" sizes="(min-width: 781px) 360px, calc(100vw - 30px)" srcset="{{url('file/serve/'.$new->image)}} 360w, {{url('file/serve/'.$new->image)}} 848w" src="{{url('file/serve/'.$new->image)}}">
                                <div class="latest-news__content">
                                    <h4 class="latest-news__title">{{title_case($new->title)}}</h4>
                                    {{--<div class="latest-news__author">By Jaka Smid</div>--}}
                                </div>
                            </a>
                        </div><!-- /.widget_pw_latest_news -->

                    </div><!-- /.col -->
                @endforeach
            @endif


            <div class="col-sm-4 margin-bottom-30">

                <div class="widget_pw_latest_news">
                    @if($news = get_site_news(3))
                        @foreach($news as $new)
                            <a class="latest-news  latest-news--inline" href="{{url('news/' . $new->slug)}}">
                                <div class="latest-news__content">
                                    <h4 class="latest-news__title">{{title_case($new->title)}}</h4>
                                    <div class="latest-news__author">{{$new->created_at->format('d/m/Y')}}</div>
                                </div>
                            </a>
                        @endforeach
                    @endif

                    <a class="latest-news  latest-news--more-news" href="{{url('news')}}">
                        More news
                    </a>
                </div><!-- /.widget_pw_latest_news -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.news -->