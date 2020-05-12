<!DOCTYPE html>
<html lang="en">
<head>
    @include('nec.partials.head')
</head>
<body>

<!-- MAIN PAGE CONTAINER -->
<div class="boxed-container">
    @include('nec.partials.header')
    @include('nec.partials.page-title')
    @include('nec.partials.breadcrumb')
    <div class="container">
        <div class="row">
            <main class="col-xs-12 col-md-9 col-md-push-3">
                @yield('content')
            </main>
            <div class="col-xs-12 col-md-3 col-md-pull-9">

                <div class="sidebar">
                    <ul class="nav nav-pills nav-stacked" id="menu-services-menu">
                        <li class="{{$slug ? '' : 'active'}}"><a href="{{url('our-service')}}">All Services</a></li>
                        @if($services = get_site_services())
                            @foreach($services as $service)
                                <li class="{{$slug == $service->slug? 'active' : ''}}">
                                    <a href="{{url('our-service/' . $service->slug)}}">{{title_case($service->title)}}</a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div><!-- /.sidebar -->
            </div><!-- /.col -->
        </div>
    </div><!-- /.container -->
    @include('nec.partials.footer')
</div><!-- /.boxed-container -->

@include('nec.partials.js')
@include('sweet::alert')

</body>
</html>