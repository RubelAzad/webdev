<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Magic Office') }}</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{url('front-end/css/bootstrap.min.css')}}">
    <!-- Optional theme -->
    <link rel="stylesheet" href="{{url('front-end/css/bootstrap-theme.min.css')}}">

    <script src="https://use.fontawesome.com/f6510f3f79.js"></script> {{-- v4.7 --}}

    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{url('magic/plugins/sweetalert/dist/sweetalert.css')}}">
    <link rel="stylesheet" href="{{url('front-end/css/style.css')}}">
    <link rel="stylesheet" href="{{url('front-end/css/custom.css')}}">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @stack('style')
</head>
<body>
<header class="header">
    @include('front-end.partials.top-header')
</header>
<div class="main-header">
    <div class="container">
        @include('front-end.partials.top-menu')
    </div>
</div>
@yield('content')
<footer class="footer">
    @include('front-end.partials.footer')
</footer>
<div class="footer-bottom">
    <p>Copyright {{\Carbon\Carbon::now()->format('Y')}} {{ config('app.name', 'Magic Office') }}</p>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

<script type="text/javascript" src="{{url('front-end/js/jquery-latest.min.js')}}"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="{{url('front-end/js/bootstrap.min.js')}}"></script>
<script src="{{url('magic/js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>
<!-- for slider -->
<script src="{{url('front-end/js/jquery.bxslider.min.js')}}"></script>
<!-- for mesonery -->
<script src="{{url('front-end/js/isotope.pkgd.min.js')}}"></script>
<!-- for fancybox -->
<link rel="stylesheet" href="{{url('front-end/js/jquery.fancybox.css')}}" type="text/css" media="screen" />
<script type="text/javascript" src="{{url('front-end/js/jquery.fancybox.pack.js')}}"></script>
<!-- end for fancy box -->
<script src="{{url('front-end/js/jquery.sticky-kit.min.js')}}"></script>
<script src="{{url('magic/plugins/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{url('front-end/js/script.js')}}"></script>
@stack('scripts')
@include('sweet::alert')
</body>
</html>