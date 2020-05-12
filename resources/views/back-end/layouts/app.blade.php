<!DOCTYPE html>
<html lang="en-us">
<head>
    @section('metadata')
        @include('back-end.partials.metadata')
    @show
</head>

<body id="app" class="smart-style-1 fixed-header fixed-ribbon"> <!-- smart-style-1 smart-style-2, smart-style-3, smart-style-4, smart-style-5, smart-style-6 fixed-navigation fixed-header fixed-ribbon-->

<!-- HEADER -->
@section('top_nav')
    @if(Auth::id())
        @include('back-end.partials.top_nav')
    @endif
@show
<!-- END HEADER -->

<!-- Left panel : Navigation area -->
<!-- Note: This width of the aside area can be adjusted through LESS variables -->
@section('sidebar')
    @if(Auth::id())
        @include('back-end.partials.sidebar')
    @endif
@show
<!-- END NAVIGATION -->

<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- Document viewer -->
    <div id="full-width-container"></div>

    <!-- RIBBON -->
    @if(Auth::id())
        <div id="ribbon">
            <span class="ribbon-button-alignment">
                <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
                    <i class="fa fa-refresh"></i>
                </span>
            </span>

            <!-- breadcrumb -->
            <ol class="breadcrumb">
                <li><a href="{{url('home')}}">Dashboard</a></li>
                @yield('breadcrumb')
            </ol>

        </div>
    @endif
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">

        <div class="row">
            <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
                <h1 class="page-title txt-color-blueDark">@yield('page_header')</h1>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
                <div class="btn-group pull-right" role="group" aria-label="...">
                    @yield('top_right_corner_button_group')
                </div>
            </div>
        </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">
            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="flash-message">
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-' . $msg))

                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                    @endif
                @endforeach
            </div> <!-- end .flash-message -->

            @include('flash::message')
            @yield('content')

        </section>
        <!-- end widget grid -->

    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->

<!-- PAGE FOOTER -->
<div class="page-footer">
    @include('back-end.partials.footer')
</div>
<!-- END PAGE FOOTER -->

<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
Note: These tiles are completely responsive,
you can add as many as you like
-->
<div id="shortcut">
    @include('back-end.partials.shortcut')
</div>
<!-- END SHORTCUT AREA -->

<!--================================================== -->
@section('jScript')
    @include('back-end.partials.javascript')
@show
<script>
    $(document).ready(function() {
        // DO NOT REMOVE : GLOBAL FUNCTIONS!
        pageSetUp();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

</script>
@include('sweet::alert')

</body>

</html>