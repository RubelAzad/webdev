@extends('nec.layouts.page')

@section('breadcrumb')
    <span>News</span>
@endsection

@section('heading')
    NEWS
@endsection

@section('second-heading')
    Latest News - What is happening around us
@endsection

@section('content')
    <div class="row margin-bottom-30">

        <div class="col-xs-12 col-md-9">

            @foreach($pages as $page)
                <article class="clearfix hentry">
                    <div class="row">
                        <div class="col-sm-12 col-md-4">
                            <a href="{{url('news/'. $page->slug)}}">
                                <img alt="placeholder" class="img-responsive" src="{{url('file/serve/' . $page->image)}}">
                            </a>
                            <div class="meta-data">
                                <time class="meta-data__date">{{$page->created_at->format('M d, Y')}}</time>
                                {{--<span class="meta-data__separator">/</span>--}}
                                {{--<span class="meta-data__author">By Jaka Smid</span>--}}
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8">
                            <h2 class="hentry__title no-margin-top"><a href="{{url('news/'. $page->slug)}}">{{title_case($page->title)}}</a></h2>
                            <div class="hentry__content">
                                {!! str_limit($page->body, 200, '...') !!}
                                <p>
                                    <a class="more-link" href="{{url('news/'. $page->slug)}}">
                                        <span class="btn btn-default btn--post">Read More</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
                <hr>
            @endforeach

            {{ $pages->links() }}

        </div><!-- /.col -->

        <div class="col-xs-12 col-md-3">

            @include('nec.news-side-bar')

        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection