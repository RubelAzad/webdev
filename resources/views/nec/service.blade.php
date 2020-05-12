@extends('nec.layouts.service')

@section('breadcrumb')
    <span>
        <a class="post post-page" href="{{url('our-service')}}" title="Go to Services." rel="v:url">Services</a>
    </span>
    <span>{{$page->title}}</span>
@endsection

@section('heading')
    {{title_case($page->title)}}
@endsection

@section('second-heading')
    {{title_case($page->summary)}}
@endsection

@section('content')
    <div class="row margin-bottom-30">
        <div class="col-sm-{{$page->image ? 6 : 12}}">
            {!! $page->body !!}
        </div>

        @if($page->image)
            <div class="col-sm-6">
                <img alt="placeholder" src="{{url('file/serve/'. $page->image)}}" class="alignnone">
            </div>
        @endif
    </div>
@endsection