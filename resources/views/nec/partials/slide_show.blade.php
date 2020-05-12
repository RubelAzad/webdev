<!-- JUMBOTRON -->
<div class="jumbotron jumbotron--with-captions">

    <div data-interval="5000" data-ride="carousel" id="headerCarousel" class="carousel slide">

        <div class="carousel-inner">

            @if($shows = get_slide_shows())
                @php($i=1)
                @foreach($shows as $show)
                    <div class="item {{$i == 1 ? 'active' : ''}}">
                        <img alt="{{strtoupper($show->title)}}" sizes="100vw" srcset="{{url('file/serve/' . $show->image)}} 1920w, {{url('file/serve/' . $show->image)}} 425w" src="{{url('file/serve/' . $show->image)}}">
                        @if($show->show_info)
                            <div class="container">
                                <div class="jumbotron-content">

                                    @if($show->title)
                                        <div class="jumbotron-content__title">
                                            <span style="font-size: 1.5em">{{strtoupper($show->title)}}</span>
                                        </div>
                                    @endif
                                    <div class="jumbotron-content__description">
                                        @if($show->description)
                                            <span class="p1"><span class="s1">{{$show->description}}</span></span>
                                        @endif

                                        @if($show->button1_text || $show->button2_text)
                                            <div>
                                                @if($show->button1_text)
                                                    <a target="_self" href="{{url($show->button1_link ? $show->button1_link : '#')}}" class="btn btn-primary">{{$show->button1_text}}</a> &nbsp;
                                                @endif
                                                @if($show->button2_text)
                                                    <a target="_self" href="{{url($show->button2_link ? $show->button2_link : '#')}}" class="btn btn-secondary">{{$show->button2_text}}</a>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="w69b-screencastify-mouse"></div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div><!-- /.item -->
                    @php($i++)
                @endforeach
            @endif
        </div><!-- /.carousel-inner -->

        <div class="container hide">

            <a data-slide="prev" role="button" href="#headerCarousel" class="left jumbotron__control">
                <i class="fa  fa-caret-left"></i>
            </a>
            <a data-slide="next" role="button" href="#headerCarousel" class="right jumbotron__control">
                <i class="fa  fa-caret-right"></i>
            </a>
        </div><!-- /.container -->

    </div><!-- /.carousel -->

</div><!-- /.jumbotron -->