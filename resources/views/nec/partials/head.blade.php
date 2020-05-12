<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>{{ config('app.name', 'Magic Office') }}</title>

<!-- Styling -->
<link href="{{url('css/app.css')}}" rel="stylesheet">
<link href="{{url('nec/css/style.css')}}" rel="stylesheet">
<link href="{{url('nec/css/style-alt1.css')}}" rel="stylesheet">
<link href="{{url('nec/css/magnific-popup.css')}}" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Roboto%3A400%2C700%7CSource+Sans+Pro%3A700%2C900&amp;subset=latin" rel="stylesheet">
<script src="{{url('nec/js/modernizr.custom.24530.js')}}" type="text/javascript"></script>
<link rel="shortcut icon" href="{{url('nec/images/fav.png')}}">
<link href="{{url('nec/css/custom.css')}}" rel="stylesheet">
@stack('style')
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Scripts -->
<script>
    window.Laravel = '{!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!}';
</script>

<script type="text/javascript" src="//platform-api.sharethis.com/js/sharethis.js#property=5af23c5b65adf7001138984f&product=sticky-share-buttons"></script>