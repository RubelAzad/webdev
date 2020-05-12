<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    @section('metadata')
        @include('back-end.partials.metadata')
    @show
</head>

<body class="animated fadeInDown">

<header id="header">

    <div id="logo-group">
        <span id="logo"> <img src="{{url('img/logo.png')}}" alt="SmartAdmin"> </span>
    </div>

    <span id="extr-page-header-space">
        @yield('top_right_corner')
    </span>

</header>

<div id="main" role="main">

    <!-- MAIN CONTENT -->
    <div id="content" class="container">

        <div class="row">
            @yield('content_left')
            @yield('content_right')
        </div>
    </div>

</div>

<!--================================================== -->
@section('jScript')
    @include('back-end.partials.javascript')
@show

</body>
</html>