<meta charset="utf-8">
<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

<meta name="description" content="">
<meta name="author" content="">

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Basic Styles -->
<link rel="stylesheet" type="text/css" media="screen" href="{{url('css/app.css')}}"> <!-- Bootstrap  -->
<link rel="stylesheet" type="text/css" media="screen" href="{{url('magic/plugins/datatables/datatables.min.css')}}">

<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
<link rel="stylesheet" type="text/css" media="screen" href="{{url('magic/css/smartadmin-production-plugins.css')}}">
<link rel="stylesheet" type="text/css" media="screen" href="{{url('magic/css/smartadmin-production.min.css')}}">
<link rel="stylesheet" type="text/css" media="screen" href="{{url('magic/css/smartadmin-skins.min.css')}}">

<link rel="stylesheet" type="text/css" media="screen" href="{{url('common/css/global.css')}}">


<!-- Specifying a Webpage Icon for Web Clip -->
<link rel="apple-touch-icon" sizes="57x57" href="{{url('img/logo/apple-icon-57x57.png')}}">
<link rel="apple-touch-icon" sizes="60x60" href="{{url('img/logo/apple-icon-60x60.png')}}">
<link rel="apple-touch-icon" sizes="72x72" href="{{url('img/logo/apple-icon-72x72.png')}}">
<link rel="apple-touch-icon" sizes="76x76" href="{{url('img/logo/apple-icon-76x76.png')}}">
<link rel="apple-touch-icon" sizes="114x114" href="{{url('img/logo/apple-icon-114x114.png')}}">
<link rel="apple-touch-icon" sizes="120x120" href="{{url('img/logo/apple-icon-120x120.png')}}">
<link rel="apple-touch-icon" sizes="144x144" href="{{url('img/logo/apple-icon-144x144.png')}}">
<link rel="apple-touch-icon" sizes="152x152" href="{{url('img/logo/apple-icon-152x152.png')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{url('img/logo/apple-icon-180x180.png')}}">
<link rel="icon" type="image/png" sizes="192x192"  href="{{url('img/logo/android-icon-192x192.png')}}">
<link rel="icon" type="image/png" sizes="32x32" href="{{url('img/logo/favicon-32x32.png')}}">
<link rel="icon" type="image/png" sizes="96x96" href="{{url('img/logo/favicon-96x96.png')}}">
<link rel="icon" type="image/png" sizes="16x16" href="{{url('img/logo/favicon-16x16.png')}}">
<link rel="manifest" href="{{url('img/logo/manifest.json')}}">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="{{url('img/logo/ms-icon-144x144.png')}}">
<meta name="theme-color" content="#ffffff">

@stack('style')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Magic Office') }}</title>

<!-- Scripts -->
<script>
    window.Laravel = '{!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}';

</script>