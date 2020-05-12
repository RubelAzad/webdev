@extends('nec.layouts.page')

@push('scripts')

@endpush

@section('breadcrumb')
    <span>
        <a class="post post-page" href="{{url('news')}}" title="Go to Services." rel="v:url">News</a>
    </span>
    <span>{{$page->title}}</span>
@endsection

@section('heading')
    {{strtoupper($page->title)}}
@endsection


@section('content')
    <div class="row margin-bottom-30">

        <div class="col-xs-12 col-md-9">

            <article class="clearfix hentry">
                <a href="#">
                    <img alt="placeholder" class="img-responsive" src="{{url('file/serve/'. $page->image)}}">
                </a>
                <div class="meta-data">
                    <time class="meta-data__date">{{$page->created_at->format('M d, Y')}}</time>
                    {{--<span class="meta-data__separator">/</span>--}}
                    {{--<span class="meta-data__author">By Jaka Smid</span>--}}
                </div>
                <h2 class="hentry__title">{{title_case($page->title)}}</h2>
                <div class="hentry__content">
                    {!! $page->body !!}
                </div>
            </article>
        </div><!-- /.col -->

        <div class="col-xs-12 col-md-3">
            @include('nec.news-side-bar')
        </div><!-- /.col -->

    </div><!-- /.row -->
@endsection