@extends('nec.layouts.service')

@section('breadcrumb')
    <span>Services</span>
@endsection

@section('heading')
    {{strtoupper('Services')}}
@endsection

@section('second-heading')
{{--    {{title_case($page->summary)}}--}}
@endsection

@section('content')
    <div class="row margin-bottom-30">
        @if($services = get_site_services())
            @foreach($services as $service)
                <div class="col-sm-4">

                    <div class="page-box page-box--block">
                        <a href="{{url('our-service/' . $service->slug)}}" class="page-box__picture">
                            <img alt="Ground Transport" class="wp-post-image" sizes="(min-width: 781px) 360px, calc(100vw - 30px)" srcset="{{url('file/serve/' . $service->image)}} 360w, {{url('file/serve/' . $service->image)}} 848w" src="{{url('file/serve/' . $service->image)}}">
                        </a>
                        <div class="page-box__content">
                            <h5 class="page-box__title text-uppercase">
                                <a href="{{url('our-service/' . $service->slug)}}">{{strtoupper($service->title)}}</a>
                            </h5>

                            {!! str_limit($service->body, 250, '...') !!}

                            <p><a class="read-more" href="{{url('our-service/' . $service->slug)}}">Read more</a></p>
                        </div>
                    </div>

                </div><!-- /.col -->
            @endforeach
        @endif
    </div><!-- /.row -->
@endsection